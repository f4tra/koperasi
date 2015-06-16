<?php 

class Captcha {
        public static function getRecaptcha($recaptchaURL, $referer) {
                $http = new HTTP(false);
                $captcha_js = $http->GET($recaptchaURL, $referer);
                //echo $captcha_js;
                $l = explode("\n",$captcha_js);
                 foreach ($l as $ln) {
                        if (is_int(strpos($ln, 'challenge'))) {
                                $r['challenge'] = substr($ln, strpos($ln, "'")+1, strrpos($ln, "'")-strpos($ln, "'")-1);
                        }
                        if (is_int(strpos($ln, 'server :'))) {
                                $r['server'] = substr($ln, strpos($ln, "'")+1, strrpos($ln, "'")-strpos($ln, "'")-1);
                        }
                }
                $r['filename'] = '/tmp/'.md5(time().rand(1000,9999)).'.jpg';
                //Logger::log("ReCaptcha Challenge: {$r['challenge']}");
                $http->GETFILE($r['server'].'image?c='.$r['challenge'], $r['filename'], $referer);
                Logger::log("ReCaptcha downloaded");
                return $r;
        }
        public static function deathByCaptcha($filename) {
                global $conf;
                Logger::log("DeathByCaptcha request verstuurt");
                require_once 'dbc_client.3.php';
                $c = new DeathByCaptcha_client($conf['deathbycaptcha']['login'], $conf['deathbycaptcha']['passw']);
                if ($r = $c->decode($filename, 120)) {
                        Logger::log("DeathByCaptcha solution: {$r[1]}");
                        return $r;
                } else {
                        Logger::log("DeathByCaptcha timeout");
                        return null;
                }
        }
        public static function deathByCaptchaNotCorrect($id) {
                global $conf;
                require_once 'dbc_client.3.php';
                $c = new DeathByCaptcha_client($conf['deathbycaptcha']['login'], $conf['deathbycaptcha']['passw']);
                Logger::log("DeathByCaptcha wrong solution for $id");
                $c->report($id);
        }
}  
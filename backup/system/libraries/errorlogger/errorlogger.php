<?php
  function writeerrorlog($level, $content, $filename) {
    require(BASEPATH."../application/config/config.php");
  
    if ($config['errorloglevel']>=$level) {
      file_put_contents($config['errorlogfilepath'].$filename, "ErrorLevel: ".$level." @ ".date("Y-m-d H:i:s").chr(13).chr(10).$content);
    }
  }
  
  
  function _addlog($level, $message) {
    // level error adalah tingkatan error, semakin kecil nilai semakin penting, minimal 1, maximal 999
    require(BASEPATH."../application/config/config.php");
    $filename = $config['errorlogfilepath']."applogger.txt";
    //$message = stripslashes($message);
	$message = str_replace('\r', '', $message);
	$message = str_replace('\n', '', $message);
	$message = str_replace('\t', '', $message);
    if ($config['errorloglevel']!=0 && ($level<=$config['errorloglevel'] || $level>=1000)) {
      if (file_exists($filename)===FALSE) {
        file_put_contents($filename, 'Application logger file'.chr(13).chr(10).'--------------------------------'.chr(13).chr(10));
      }
      if (is_writable($filename)) {
        $maxline = $config['errorlogmaxline'];
        $line = 0;
        $array = file($filename);
        $lcount = count($array);
        for ($i=0; $i<$lcount-$maxline+1; $i++)
          unset($array[0]);
        
        if (!$handle = fopen($filename, 'w+')) {
             echo "Cannot open file ($filename)";
             exit;
        }
        foreach($array as $line) fwrite($handle,$line); 
        
        if (fwrite($handle, '['.date('Y-m-d H:i:s').'] '.$message.chr(13).chr(10)) === FALSE) {
          echo "Cannot write to file ($filename)";
          exit;
        }
        
        fclose($handle);
        } else {
            echo "The file $filename is not writable";
      }
    }
  }
  
  function writeaudittrail($level, $message) {
  
  }
?>
<?php
/* 
	Created By Muhamad Jafar Sidik
	mailtype : html or text
	priority : Email Priority. 1 = highest. 5 = lowest. 3 = normal.
*/



$config['useragent']	= 'kasnet';
$config['protocol']		= 'smtp';
//$config['mailpath']		= '/usr/sbin/sendmail';
$config['smtp_host']	= 'mail2.links.co.id';
$config['smtp_user']	= 'inu@links.co.id';
$config['smtp_pass']	= 'lds';
$config['smtp_port']	= '587';
$config['smtp_timeout']	= '10';
$config['wordwrap'] 	= TRUE;
$config['wrapchars'] 	= '76';
$config['mailtype'] 	= 'text'; 
//$config['charset'] 		= 'utf-8';
$config['charset'] 		= 'iso-8859-1';
$config['validate'] 	= FALSE;
$config['priority'] 	= '1';
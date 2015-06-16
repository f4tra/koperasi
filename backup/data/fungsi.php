sdf
<?php 
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
mysql_connect('localhost','root','root') or die('not connect');
mysql_select_db('auf_pmt') or die('not selected db');


$content = "<?php\n\n\$data  =array(";
$query = mysql_query("select * from tr_sys_iso_uom");
while ($result = mysql_fetch_object($query) ) {
	$content .= "array(";
	$content .= "'id'=>".$result->id.",\n";
	$content .= "'code'=>'".$result->code."',\n";
	//$content .= '"name"=>"'.$result->name.'",';
	$content .= "'name'=>'".$result->name."',\n";
	$content .= "\n'active'=>'".$result->active."',\n";
	$content .= "'descr'=>'".$result->descr."',\n";
	$content .= "'parent'=>'".""."',\n";
	$content .= "),\n";
	
}
$content .="); \necho json_encode(\n\$data);";
$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/tester/data/uom.php","wb");
//echo $content;
fwrite($fp,$content);
fclose($fp);
/*while ($result = mysql_fetch_object($query) ) {
	$content .= "array(";
	$content .= "'id'=>".$result->id.",\n";
	$content .= "'code'=>'".$result->code."',\n";
	$content .= '"name"=>"'.$result->name.'",';
	//$content .= "'name'=>'".$result->name."',\n";
	$content .= "\n'active'=>'".$result->active."',\n";
	$content .= "'descr'=>'".$result->descr."'";
	$content .= "),\n";
}*/
?>
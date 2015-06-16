<?php

class converter
{
	var $skey 	= "a3r0";
	
	function encode($value){ 
 
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));
    }
 
    function decode($value){
 
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
	
	function safe_b64encode($string) {
 
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }	
	
	function cek_is_logged(){
		$token = $this->db->query("SELECT agent_token from agent where agent_id = ".$this->session->userdata['id']);
		if($this->session->userdata['token'] != "" && $this->session->userdata['id'] != ""){
			
		}	

		
	}
	function sqltotime($sqltime) 
	{ 
		date_default_timezone_set('Asia/Jakarta');
		$pot1	= explode(" ",$sqltime);
		$pot2	= explode("-",$pot1[0]);
		$pot3	= explode(":",$pot1[1]);
		
    	return mktime($pot3[0],$pot3[1],$pot3[2],$pot2[1],$pot2[2],$pot2[0]);
		//return "$pot3[0],$pot3[1],$pot3[2],$pot2[1],$pot2[2],$pot2[0]"; 
	}
	
	function setTanggalNama($data)
	{
		date_default_timezone_set('Asia/Jakarta');
		$day = date('l', strtotime($data));
		
		list($t,$b,$h) = split('[-]', $data);
		switch($b)
		{
			case"01"; $bln="Januari"; break;
			case"02"; $bln="Februari"; break;
			case"03"; $bln="Maret"; break;
			case"04"; $bln="April"; break;
			case"05"; $bln="Mei"; break;
			case"06"; $bln="Juni"; break;
			case"07"; $bln="Juli"; break;
			case"08"; $bln="Agustus"; break;
			case"09"; $bln="September"; break;
			case"10"; $bln="Oktober"; break;
			case"11"; $bln="November"; break;
			case"12"; $bln="Desember"; break;
		}
		switch($day)
		{
			case"Sunday";	$weekday="Minggu";	break;
			case"Monday";	$weekday="Senin";	break;
			case"Tuesday";	$weekday="Selasa";	break;
			case"Wednesday";$weekday="Rabu";	break;
			case"Thursday";	$weekday="Kamis";	break;
			case"Friday";	$weekday="Jumat";	break;
			case"Saturday";	$weekday="Sabtu";	break;
		}
		
		$tglIndo=" $weekday $h $bln $t";
		return $tglIndo;
	}
	
	function setTanggalNamaTime($data)
	{
		date_default_timezone_set('Asia/Jakarta');
		$arr = explode(' ',$data);
		$day = date('l', strtotime($arr[0]));
		
		list($t,$b,$h) = split('[-]', $arr[0]);
		switch($b)
		{
			case"01"; $bln="Januari"; break;
			case"02"; $bln="Februari"; break;
			case"03"; $bln="Maret"; break;
			case"04"; $bln="April"; break;
			case"05"; $bln="Mei"; break;
			case"06"; $bln="Juni"; break;
			case"07"; $bln="Juli"; break;
			case"08"; $bln="Agustus"; break;
			case"09"; $bln="September"; break;
			case"10"; $bln="Oktober"; break;
			case"11"; $bln="November"; break;
			case"12"; $bln="Desember"; break;
		}
		switch($day)
		{
			case"Sunday";	$weekday="Minggu";	break;
			case"Monday";	$weekday="Senin";	break;
			case"Tuesday";	$weekday="Selasa";	break;
			case"Wednesday";$weekday="Rabu";	break;
			case"Thursday";	$weekday="Kamis";	break;
			case"Friday";	$weekday="Jumat";	break;
			case"Saturday";	$weekday="Sabtu";	break;
		}
		
		$tglIndo=" $weekday $h $bln $t $arr[1]";
		return $tglIndo;
	}
	
	function code_to_city($code)
	{
		$query = $this->db->query("select concat(airport_code,' ( ',city,' ) ') as code_city from airport where airport_code='$code'");
		$q = $query->result();
		foreach ($q as $row)
		{
			return $row->code_city;
		}
	}
	
	function code_to_city_button($code)
	{
		$query = $this->db->query("select concat(city,', ',airport_code) as code_city from airport where airport_code='$code'");
		$q = $query->result();
		foreach ($q as $row)
		{
			return $row->code_city;
		}
	}
	
	# Convert an stdClass to Array.
	function object_to_array(stdClass $Class){
		# Typecast to (array) automatically converts stdClass -> array.
		$Class = (array)$Class;
		
		# Iterate through the former properties looking for any stdClass properties.
		# Recursively apply (array).
		foreach($Class as $key => $value){
			if(is_object($value)&&get_class($value)==='stdClass'){
				$Class[$key] = self::object_to_array($value);
			}
		}
		return $Class;
    }
        
    # Convert an Array to stdClass.
    function array_to_object(array $array){
		# Iterate through our array looking for array values.
		# If found recurvisely call itself.
		foreach($array as $key => $value){
			if(is_array($value)){
				$array[$key] = self::array_to_object($value);
			}
		}
		
		# Typecast to (object) will automatically convert array -> stdClass
		return (object)$array;
    }
	
	#convert id airlines to name airlines
	function id_to_name($code)
	{
		$query = $this->db->query("select airlines_img from airlines where airlines_id='".$code."'");
		$q = $query->result();
		foreach ($q as $row)
		{
			return $row->airlines_img;
		}
	}
	// $array = array variabel $key= key of array $value= value of each key
	function array_push_assoc($array, $key, $value){
		$array[$key] = $value;
		return $array;
	}
		#convert id airlines to Name airlines
	function id_to_name_airlines($code)
	{
		$ci = & get_instance();
		$ci->load->database('sistem', TRUE);
		$query = $ci->db->query("select airlines_name from airlines where airlines_id='".$code."'");
		$q = $query->result();
		foreach ($q as $row)
		{
			return $row->airlines_name;
		}
	}
	
	# Convert to Indonesian Month Name. Ex : $code = '01' 
    function month_indonesian($code){
		
		switch($code) {
			case 01:
				$bulan = "Januari";
			break;	
			case 02:
				$bulan = "Februari";
			break;	
			case 03:
				$bulan = "Maret";
			break;	
			case 04:
				$bulan = "April";
			break;	
			case 05:
				$bulan = "Mei";
			break;	
			case 06:
				$bulan = "Juni";
			break;	
			case 07:
				$bulan = "Juli";
			break;	
			case 08:
				$bulan = "Agustus";
			break;	
			case 09:
				$bulan = "September";
			break;	
			case 10:
				$bulan = "Oktober";
			break;	
			case 11:
				$bulan = "November";
			break;	
			case 12:
				$bulan = "Desember";
			break;	
		}
		# Typecast to (object) will automatically convert array -> stdClass
		return $bulan;
    }
	function ccy($from,$to,$value)
	{
		$ci = & get_instance();
		$ci->load->database('default', TRUE);
		$datSetting	= $ci->mgeneral->getWhere(array('general_setting_kelompok'=>"ccy",'general_setting_name'=>"bca"),'general_setting');
		foreach($datSetting as $d) {
			$upHarga		= $d->general_setting_nilai;
		}
		
		$cookie_file	= getcwd()."/cookie/bank/BCA-currency.tmp";
		$result	= $ci->curl->post("http://www.bca.co.id/id/biaya-limit/kurs_counter_bca/kurs_counter_bca_landing.jsp", "http://www.klikbca.com", "", $this->cookie_file);
		
		$html 	= $ci->domparser->str_get_html($result['result']);
		foreach ($html->find('table') as $table) {
			$data[] = $table->outertext;
		}
		
		$html2	= $ci->domparser->str_get_html($data['1']);
		foreach ($html2->find('tr') as $table2) {
			$data2[] = $table2->outertext;
		}
		
		for($a=2;$a<count($data2);$a++)
		{
			//echo htmlentities($data2[$a])."<br><Br>";
			$data3	= array();
			$html3	= $ci->domparser->str_get_html($data2[$a]);
			foreach ($html3->find('td') as $table3) {
				$data3[] = $table3->innertext;
			}
			
			$ccy[$data3[0]]=(number_format($data3[1], 0, '.', '')+$upHarga);
		}
		
		if($to=="IDR")
		{
			$convert	= $ccy[$from]*$value;
			return number_format($convert, 0, '.', '');
		}
		else
		{
			return 0;
		}
	}
}

?>

<?php

class parsing
{
	var $vars;
    function get_string_between($string, $start, $end)
    {
        $string = " " . $string; // init awal ex : "hello world"
        $ini = strpos($string, $start); // cari posisi ex strpost("hello world", "wo") -> exec : 6
        if ($ini == 0)
            return "";
        $ini += strlen($start); // ex ini = 6+ length dari wo (2) ->exec : 8
        $len = strpos($string, $end, $ini) - $ini; // length sekarang 
        return substr($string, $ini, $len);
    }

    function get_char_between($input, $start, $end)
    {
        $substr = substr($input, strlen($start) + strpos($input, $start), (strlen($input) - strpos($input, $end)) * (-1));
        return $substr;
    }

    function strip_only($str, $tags, $stripContent = false)
    {
        $content = '';
        if (!is_array($tags))
        {
            $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
            if (end($tags) == '')
                array_pop($tags);
        }
        foreach ($tags as $tag)
        {
            if ($stripContent)
                $content = '(.+</' . $tag . '[^>]*>|)';
            $str = preg_replace('#</?' . $tag . '[^>]*>' . $content . '#is', '', $str);
        }
        return $str;
    }
	
	function DaysBetween($start, $end) {
		$day 		= 86400;
		$format 	= 'Y-m-d';
		$sTime 		= strtotime($start);
		$eTime	 	= strtotime($end);
		$numDays 	= round(($eTime - $sTime) / $day) + 1;
		$days 		= array();

	 	for ($d = 0; $d < $numDays; $d++) {
			$days[] = date($format, ($sTime + ($d * $day)));
	 	}

	 	return $days;
	} 
	
	function post_data($vars) {
		$post = array();
		foreach ($vars as $key => $val)
			$post[] = urlencode($key) . '=' . urlencode($val);
		return join($post, '&');
	}
	
	function parse_date($date, $format) {
		$d = strptime($date, $format);
		return mktime(0, 0, 0, $d['tm_mon'] + 1, $d['tm_mday'], $d['tm_year'] + 1900);
		/*$d = strtotime($date, $format);
		return mktime(0, 0, 0, $d['tm_mon'] + 1, $d['tm_mday'], $d['tm_year'] + 1900);*/
	}
	
	function conv_obj($Data){
		 if(is_object($Data)){
			 foreach(get_object_vars($Data) as $key=>$val){
				 if(is_object($val)){
					 $ret[$key]=$this->conv_obj($val);
				 }else{
					 $ret[$key]=$val;
				 }
			 }
			 return $ret;
		 }elseif(is_array($Data)){
			 foreach($Data as $key=>$val){
				 if(is_object($val)){
					 $ret[$key]=$this->conv_obj($val);
				 }else{
					 $ret[$key]=$val;
				 }
			 }
			 return $ret;
		 }else{
			 return $Data;
		 }
	 }
	 
	 function array_extend($a, $b) {
		foreach($b as $k=>$v) {
			if( is_array($v) ) {
				if( !isset($a[$k]) ) {
					$a[$k] = $v;
				} else {
					$a[$k] = $this->array_extend($a[$k], $v);
				}
			} else {
				$a[$k] = $v;
			}
		}
		return $a;
	}
	
	function getkodebulan($nama)
	{
		switch($nama)
		{
			case"January";	$kode="01"; break;
			case"February"; $kode="02"; break;
			case"March";	$kode="03"; break;
			case"April";	$kode="04"; break;
			case"May";		$kode="05"; break;
			case"June";		$kode="06"; break;
			case"July";		$kode="07"; break;
			case"August";	$kode="08"; break;
			case"September";$kode="09"; break;
			case"October"; 	$kode="10"; break;
			case"November"; $kode="11"; break;
			case"December"; $kode="12"; break;
		}
		return $kode;
	}
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
	
}

?>

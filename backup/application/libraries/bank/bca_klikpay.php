<?php

class bca_klikpay
{
	
    function __construct()
    {
        $ci = & get_instance();
    }
	function getErrorText($kode)
	{
		$ci =& get_instance();
		$error	= $ci->mgeneral->getWhere(array('errorcode_code'=>$kode),"errorcode_list");
		return $error;
	}
}

?>

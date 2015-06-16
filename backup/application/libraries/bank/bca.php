<?php

class bca
{
	public $server_ip	= '202.78.200.97';
	public $cookie_file;
	
    function __construct()
    {
        $ci = & get_instance();
        $ci->load->library('curl');
        $ci->load->library('domparser');
        $ci->load->library('parsing');
		$ci->load->model('mgeneral','',TRUE);
		$ci->load->library('converter');
    }
	function getErrorText($kode)
	{
		$ci =& get_instance();
		$error	= $ci->mgeneral->getWhere(array('errorcode_code'=>$kode),"errorcode_list");
		return $error;
	}
    function login($bank_name,$account_no)
    {
		$ci =& get_instance();
		$ci->load->database('sistem', TRUE);
		
		$datUser	= $ci->mgeneral2->getWhere(array('b2b_account_number'=>$account_no,'b2b_bank_name'=>$bank_name),'b2b_bank_account');
		foreach($datUser as $dat) {
			$username	= $ci->converter->decode($dat->b2b_account_username);
			$pass		= $ci->converter->decode($dat->b2b_account_pin);
		}
		
        $this->cookie_file	= getcwd()."/cookie/bank/BCA.tmp";
		
		$resultP1	= $ci->curl->post("https://ibank.klikbca.com", "https://ibank.klikbca.com", "", $this->cookie_file);
        
		$post		 = "value%28actions%29=login&value%28user_id%29=".$username;
		$post		.= "&value%28user_ip%29=".$this->server_ip;
		$post 		.= "&value%28pswd%29=".$pass;
		$post 		.= "&value%28Submit%29=LOGIN";
		$resultP2	= $ci->curl->post("https://ibank.klikbca.com/authentication.do", "https://ibank.klikbca.com/", $post, $this->cookie_file); 
		
		$resultP3	= $ci->curl->post("https://ibank.klikbca.com/nav_bar_indo/menu_bar.htm", "https://ibank.klikbca.com/authentication.do", "", $this->cookie_file); 
	
		return $resultP3;
    }
	function logout()
	{
		$ci = & get_instance();
		$result	= $ci->curl->post("https://ibank.klikbca.com/authentication.do?value(actions)=logout", "https://ibank.klikbca.com/top.htm", "", $this->cookie_file);
	}
    function get_saldo($bank_name,$account_no,$account_holder)
    {
        $ci=&get_instance();
		$login = $this->login($bank_name,$account_no);
		
		if($login['error_no']=="0")
		{
			
			$resultP1	= $ci->curl->post("https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm", "https://ibank.klikbca.com/nav_bar_indo/menu_bar.htm", "", $this->cookie_file);
			
			$resultP2	= $ci->curl->post("https://ibank.klikbca.com/balanceinquiry.do", "https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm", "", $this->cookie_file);
			$html	= $ci->domparser->str_get_html($resultP2['result']);
			foreach ($html->find('div[align=right]') as $e)
			{
            	$data	= $e->innertext;
			}
				$dataP	= explode(".",trim($ci->domparser->remove_HTML($data)));
				$dataP2	= str_replace(",","",$dataP[0]);
				$saldo	= trim($dataP2);
				
				if($saldo){
					$result = array('error_no'			=> "0",
									'account_info'		=> array("bank"=> $bank_name,
																 "account_no"=> $account_no,
																 "account_holder"=> $account_holder),
									'saldo'				=>array("saldo_date"=> date('Y-m-d H:i:s'),
																"saldo_amount"=> $saldo));
				}else{
					$result	= array('error_no'=>'1003',
									'error_msg'=>'Data Saldo Gagal didapat');
				}
		}
		else
		{
			$result	= array('error_no'=>$login['error_no'],
							'error_msg'=>$login['error_msg']);
		}
		
		$this->logout();
		return $result;
    }
	
	function get_mutasi($bank_name,$account_no,$account_holder,$start_date,$end_date)
    {
        $ci=&get_instance();
		#Explode Tanggal
		list($tahunS, $bulanS, $tglS) = explode("-", $start_date);
		list($tahunE, $bulanE, $tglE) = explode("-", $end_date);
		
		$login = $this->login($bank_name,$account_no);
		
		if($login['error_no']=="0")
		{
			
			$resultP1	= $ci->curl->post("https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm", "https://ibank.klikbca.com/nav_bar_indo/menu_bar.htm", "", $this->cookie_file);
			
			$resultP2	= $ci->curl->post("https://ibank.klikbca.com/accountstmt.do?value(actions)=acct_stmt", "https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm", "", $this->cookie_file);
			
			$post  = "value%28D1%29=0&value%28r1%29=1&value%28startDt%29=".$tglS."&";
			$post .= "value%28startMt%29=".$bulanS."&";
			$post .= "value%28startYr%29=".$tahunS."&";
			$post .= "value%28endDt%29=".$tglE."&";
			$post .= "value%28endMt%29=".$bulanE."&";
			$post .= "value%28endYr%29=".$tahunE."&";
			$post .= "value%28fDt%29=&value%28tDt%29=&value%28submit1%29=Lihat+Mutasi+Rekening";
			
			$resultP3	= $ci->curl->post("https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview", "https://ibank.klikbca.com/accountstmt.do?value(actions)=acct_stmt", $post, $this->cookie_file);
			
			$html	= $ci->domparser->str_get_html($resultP3['result']);
			foreach ($html->find('table[border=1]') as $e)
			{
            	$data	= $e->innertext;
			}
			
			$html2	= $ci->domparser->str_get_html($data);
			$r=0;
			foreach ($html2->find('tr') as $f)
			{
            	if($r!=0)
				{
					//echo htmlentities($f->innertext);
					$html3	= $ci->domparser->str_get_html($f->innertext);
					$fMut	= array();
					foreach ($html3->find('font') as $g)
					{
						$fMut[]	= trim($ci->domparser->remove_HTML($g->innertext));
					}
					$rMut[]	= $fMut;
				}
				$r++;
			}
			
			foreach($rMut as $dm)
			{
				$mutasi[]	= array("mutasi_date"		=> $dm[0].'/'.date('Y'),
									"mutasi_note"		=> $dm[1],
									"mutasi_amount"		=> $dm[3],
									"mutasi_type"		=> $dm[4]);
			}
			
			if(count($rMut)!="0")
			{
				$result = array('error_no'			=> "0",
								'account_info'		=> array("bank"=> $bank_name,
															 "account_no"=> $account_no,
															 "account_holder"=> $account_holder),
								'mutasi'			=>$mutasi);
			}else{
				$result	= array('error_no'=>'1003',
								'error_msg'=>'Data Mutasi Gagal didapat');
			}
				
		}
		else
		{
			$result	= array('error_no'=>$login['error_no'],
							'error_msg'=>$login['error_msg']);
		}
		
		$this->logout();
		return $result;
    }
}

?>

<?php

class mandiri
{
	public $server_ip	= '202.78.200.97';
	public $cookie_file;
	
    function __construct()
    {
        $ci = & get_instance();
        $ci->load->library('curl');
        $ci->load->library('domparser');
        $ci->load->library('parsing');
		//$ci->load->model('mgeneral','',TRUE);
		$ci->load->library('converter');
    }
	function getErrorText($kode)
	{
		$ci =& get_instance();
		$error	= $ci->mgeneral->getWhere(array('errorcode_code'=>$kode),"errorcode_list");
		return $error;
	}
    function login($username,$pass)
    {
		$ci =& get_instance();
        $this->cookie_file	= getcwd()."/cookie/bank/MANDIRI.tmp";
		
		$resultP1	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/Login.do?action=form&lang=in_ID", "https://ib.bankmandiri.co.id/retail/Login.do?action=form&lang=in_ID", "", $this->cookie_file);
		
		$post		 = "action=result&userID=".$username."&password=".$pass."&image.x=85&image.y=14";
		$resultP2	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/Login.do", "https://ib.bankmandiri.co.id/retail/Login.do?action=form&lang=in_ID", $post, $this->cookie_file); 
		
	$resultP3	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/common/menu.jsp", "https://ib.bankmandiri.co.id/retail/Login.do?action=form&lang=in_ID", "", $this->cookie_file);
	
		return $resultP3;
    }
	function logout()
	{
		$ci = & get_instance();
		$result	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/Logout.do?action=result", "https://ib.bankmandiri.co.id/retail/common/banner.jsp", "", $this->cookie_file);
	}
    function get_saldo($bank_name,$account_no,$account_holder)
    {
        $ci=&get_instance();
		#Connect DB Sistem
		$ci->load->database('sistem', TRUE);
		$datUser	= $ci->mgeneral2->getWhere(array('b2b_account_number'=>$account_no,'b2b_bank_name'=>$bank_name),'b2b_bank_account');
		foreach($datUser as $dat) {
			$username	= $ci->converter->decode($dat->b2b_account_username);
			$pass		= $ci->converter->decode($dat->b2b_account_pin);
			$account_id		= $dat->b2b_account_id;
		}
		
		$login = $this->login($username,$pass);
		
		if($login['error_no']=="0")
		{
			
			$resultP1	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/AccountList.do?action=acclist", "https://ib.bankmandiri.co.id/retail/common/menu.jsp", "", $this->cookie_file);
			
			$resultP2	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/AccountDetail.do?action=result&ACCOUNTID=".$account_id."
", "https://ib.bankmandiri.co.id/retail/AccountList.do?action=acclist", "", $this->cookie_file);
			
			$html	= $ci->domparser->str_get_html($resultP2['result']);
			foreach ($html->find('table[cellspacing=1]') as $e)
			{
            	$data	= $e->innertext;
			}
			
			$html2	= $ci->domparser->str_get_html($data);
			$r=0;
			foreach ($html2->find('tr') as $f)
			{
            	if($r==4)
				{
					$html3	= $ci->domparser->str_get_html($f->innertext);
					$data	= array();
					foreach ($html3->find('td') as $g)
					{
						$row = htmlentities(trim($ci->domparser->remove_HTML($g->innertext)));
					}
				}
				$r++;
			}
			list($ex_1, $ex_2, $ex_3 ) = explode(";", $row);
			$dataP	= explode(",",trim($ex_3));
			$dataP2	= str_replace(".","",$dataP[0]);
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
		
		#Connect DB Sistem
		$ci->load->database('sistem', TRUE);
		$datUser	= $ci->mgeneral2->getWhere(array('b2b_account_number'=>$account_no,'b2b_bank_name'=>$bank_name),'b2b_bank_account');
		foreach($datUser as $dat) {
			$username	= $ci->converter->decode($dat->b2b_account_username);
			$pass		= $ci->converter->decode($dat->b2b_account_pin);
			$account_id		= $dat->b2b_account_id;
		}
		
		$login = $this->login($username,$pass);
		
		if($login['error_no']=="0")
		{
			
			$resultP1	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/AccountList.do?action=acclist", "https://ib.bankmandiri.co.id/retail/common/menu.jsp", "", $this->cookie_file);
			
			$resultP2	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/AccountDetail.do?action=result&ACCOUNTID=".$account_id."
", "https://ib.bankmandiri.co.id/retail/AccountList.do?action=acclist", "", $this->cookie_file);
			
			$resultP3	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/TrxHistoryInq.do?action=form", "https://ib.bankmandiri.co.id/retail/common/menu.jsp", "", $this->cookie_file);
			
			$post 	= "action=result&fromAccountID=".$account_id."";
			$post  .= "&searchType=R&fromDay=".$tglS."&fromMonth=".$bulanS."&fromYear=".$tahunS."";
			$post  .= "&toDay=".$tglE."&toMonth=".$bulanE."&toYear=".$tahunE."&sortType=Date&orderBy=ASC";
			$resultP4	= $ci->curl->post("https://ib.bankmandiri.co.id/retail/TrxHistoryInq.do", "https://ib.bankmandiri.co.id/retail/TrxHistoryInq.do?action=form", $post, $this->cookie_file);

			$html	= $ci->domparser->str_get_html($resultP4['result']);
			$dataT = array();
			foreach ($html->find('table[cellspacing=1]') as $e)
			{
				//$dr = trim($ci->domparser->remove_HTML($e->innertext));
					$da[] = $ci->domparser->get_td_array($e->innertext);
			}
			//print_r($da[0]);
			$r=0;
			foreach ($da[0] as $dd)
			{
				if($r!=0){
					if(trim($dd[2])){
						$amount = trim($dd[2]);
						$type	= "DB";
					}else{
						$amount = trim($dd[3]);
						$type	= "CR";
					}
					$mutasi[]	= array("mutasi_date"		=> trim($dd[0]),
										"mutasi_note"		=> trim($dd[1]),
										"mutasi_amount"		=> $amount,
										"mutasi_type"		=> $type);
				}
				$r++;
			}
			//print_r($mutasi);

			if(count($mutasi)!="0")
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

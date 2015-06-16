<?php

class mandiri_corp
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
    function login($username,$pass,$b2b_company_id)
    {
		$ci =& get_instance();
        $this->cookie_file	= getcwd()."/cookie/bank/MANDIRI_CORP.tmp";
		
		$resultP1	= $ci->curl->post("https://mib.bankmandiri.co.id/sme/common/login.do?action=logoutSME", "https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", "", $this->cookie_file);
		
		$post="corpId=".$b2b_company_id."&userName=".$username."&passwordEncryption=&language=en_US&password=abc492d07e8a1f3421e43f1af02565d4d3a35317&sessionId=";
		
		$resultP2	= $ci->curl->post("https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", "https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", $post, $this->cookie_file); 
		
		$resultP3	= $ci->curl->post("https://mib.bankmandiri.co.id/sme/common/login.do?action=topRequestSME", "https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", "", $this->cookie_file);
		
		$resultP4	= $ci->curl->post("https://mib.bankmandiri.co.id/sme/common/login.do?action=bottomRequestSME", "https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", "", $this->cookie_file);
		
		$resultP5	= $ci->curl->post("https://mib.bankmandiri.co.id/sme/common/login.do?action=menuWithNameRequest", "https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", "", $this->cookie_file);
		
		$resultP6	= $ci->curl->post("https://mib.bankmandiri.co.id/sme/common/login.do?action=mainRequestSME", "https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", "", $this->cookie_file);
			

		return $resultP6;
    }
	function logout()
	{
		$ci = & get_instance();
		$result	= $ci->curl->post("https://mib.bankmandiri.co.id/sme/common/login.do?action=logoutSME", "https://mib.bankmandiri.co.id/sme/common/login.do?action=loginSME", "", $this->cookie_file);
	}
	
	function get_mutasi($bank_name,$account_no,$account_holder,$start_date,$end_date)
    {
        $ci=&get_instance();
		# START : Tanggal Start dan End
		list($tahunS, $bulanS, $tglS) = explode("-", $start_date);
		list($tahunE, $bulanE, $tglE) = explode("-", $end_date);
		# END : Tanggal Start dan End
		
		# START : Connect DB Sistem
		$ci->load->database('sistem', TRUE);
		$datUser	= $ci->mgeneral2->getWhere(array('b2b_account_number'=>$account_no,'b2b_bank_name'=>$bank_name),'b2b_bank_account');
		foreach($datUser as $dat) {
			$username	= $ci->converter->decode($dat->b2b_account_username);
			$pass		= $ci->converter->decode($dat->b2b_account_pin);
			$account_id		= $dat->b2b_account_id;
			$b2b_company_id		= $dat->b2b_company_id;
		}
		# END : Connect DB Sistem
		
		# START : Login Web Mandiri
		$login = $this->login($username,$pass,$b2b_company_id);
		# END : Login Web Mandiri
		
		if($login['error_no']=="0")
		{
			# START : CURL Web Mandiri 
			#1. Form Pencarian Data Mutasi
			$resultP	= $ci->curl->post("https://mib.bankmandiri.co.id/corp/front/transactioninquiry.do?action=transactionByDateRequest&menuCode=MNU_GCME_040200", "https://mib.bankmandiri.co.id/sme/common/login.do?action=menuWithNameRequest", "", $this->cookie_file);
			#
			#2. Proses Cari Data Mutasi
			$post = "transferDateDay1=".$tglS."&transferDateMonth1=".$bulanS."&transferDateYear1=".$tahunS."&transferDateDay2=".$tglE."&transferDateMonth2=".$bulanE."&transferDateYear2=".$tahunE."&transactionType=%25&accountType=S&accountDisplay=".$account_id."&accountNumber=".$account_id."&accountNm=INNOVATECH+MEDIASKY&currDisplay=IDR&curr=IDR&frOrganizationUnit=12606&accountTypeCode=D&accountHierarchy=+&customFile=+&frOrganizationUnitNm=&screenState=TRX_DATE&accountHierarchy=&archiveFlag=N&checkDate=Y&timeLength=31&showTimeLength=31";
			$resultP2	= $ci->curl->post("https://mib.bankmandiri.co.id/corp/front/transactioninquiry.do?action=doCheckValidityAndShow&day1=".$tglS."&mon1=".$bulanS."&year1=".$tahunS."&day2=".$tglE."&mon2=".$bulanE."&year2=".$tahunE."&accountNumber=".$account_id."&type=show&accountNumber=".$account_id."&accountType=D&frOrganizationUnitNm=&currDisplay=IDR&day1=".$tglS."&mon1=".$bulanS."&year1=".$tahunS."&day2=".$tglE."&mon2=".$bulanE."&year2=".$tahunE."&trxFilter=%","https://mib.bankmandiri.co.id/corp/front/transactioninquiry.do?action=transactionByDateRequest&menuCode=MNU_GCME_040200", $post, $this->cookie_file);
			#	
			# END : CURL Web Mandiri
			
			# START : Parsing Data Mutasi
			$html	= $ci->domparser->str_get_html($resultP2['result']);
			foreach ($html->find('table[class=clsFormTrxStatus]') as $e)
			{
				$table	= $e->innertext;
			}
			$html2	= $ci->domparser->str_get_html($table);
			foreach ($html2->find('tr[class=clsEven]') as $ee)
			{
				#Star : untuk Jumlah Validasi
				$tr[]	= trim($ci->domparser->remove_HTML($ee->innertext));
				#End : untuk Jumlah Validasi
				$html3	= $ci->domparser->str_get_html($ee->innertext);
				$row	= array();
				foreach ($html3->find('td') as $g)
				{
					$row[] = trim($ci->domparser->remove_HTML($g->innertext));
				}
				
				$rmut[]	= $row; 
			}
				#Star : untuk Validasi Data Mutasi
				$jml = count($tr);
				$val1 = ($jml-2);
				$val = 0;
				#End : untuk Validasi Data Mutasi
			# END : Parsing Data Mutasi
			
			# START : Simpan to array Mutasi
			foreach($rmut as $dm)
			{
				if($val<$val1){
				$mutasi[]	= array("mutasi_date_time"		=> $dm[0],
									"mutasi_date"			=> $dm[1],
									"mutasi_note"			=> $dm[2],
									"mutasi_reference_no"	=> $dm[3],
									"mutasi_debit"			=> $dm[4],
									"mutasi_credit"			=> $dm[5],
									"mutasi_saldo"			=> $dm[6]);
				}
				$val++;
			}	
			# END : Simpan to array Mutasi
			
			# START : Ambil Data Validasi Pagination
			$pagination	= trim($ci->domparser->remove_HTML($ci->parsing->get_string_between($html, '<input type="text" name="valuePage" size="1" value="1">', '<input type="button" name="Go" value="Go" onclick="onClickGo()">')));
			$val_pag = $ci->parsing->get_string_between($pagination, 'Of&nbsp;', '&nbsp;');
			# END : Ambil Data Validasi Pagination
		
			if($val_pag>1){
				#START : PAGING CURL
				$loop = $val_pag-1;
				for($k=1;$k<=$loop;$k++){
				$kk =$k;
				$kkk =$kk+1;	
				$post_Pag = "valuePage=".$kk."&customFile=+&accountNm=".$account_id."+-+INNOVATECH+MEDIASKY&currencyReport=IDR&branch=KCP+Jkt+Melawai&periodFrom=".$tglS."+".$ci->converter->month_indonesian(date(''.$bulanS.''))."+".$tahunS."&periodTo=".$tglE."+".$ci->converter->month_indonesian(date(''.$bulanE.''))."+".$tahunE."&screenState=TRX_DATE&accountHierarchy=+&accountType=D&processAccountIndividually=&transferDateDay1=".$tglS."&transferDateMonth1=".$bulanS."&transferDateYear1=".$tahunS."&transferDateDay2=".$tglE."&transferDateMonth2=".$bulanE."&transferDateYear2=".$tahunE."&transactionType=%25&currentPage=".$kkk."&totalPage=".$val_pag."&accountNumber=".$account_id."&accountTypeCode=D&frOrganizationUnitNm=KCP+Jkt+Melawai&currDisplay=IDR&checkDate=Y&timeLength=31&balanceInquiryFlag=&balanceInquirySingleFlag=&balanceInquiryGroupBy=&balanceInquiryHierarchy=&balanceInquirySelectedBy=&balanceInquiryIsShowDate=&corpName=INNOVATECH+MEDIASKY";
				$resultP_Pag	= $ci->curl->post("https://mib.bankmandiri.co.id/corp/front/transactioninquiry.do?action=doCheckValidityAndShow&type=show&accountNumber=".$account_id."&accountType=D&frOrganizationUnitNm=KCP%20Jkt%20Melawai&currDisplay=IDR&day1=".$tglS."&mon1=".$bulanS."&year1=".$tahunS."&day2=".$tglE."&mon2=".$bulanE."&year2=".$tahunE."&trxFilter=%&pagingFlag=Y","https://mib.bankmandiri.co.id/corp/front/transactioninquiry.do?action=doCheckValidityAndShow&day1=".$tglS."&mon1=".$bulanS."&year1=".$tahunS."&day2=".$tglE."&mon2=".$bulanE."&year2=".$tahunE."&accountNumber=".$account_id."&type=show&accountNumber=".$account_id."&accountType=D&frOrganizationUnitNm=&currDisplay=IDR&day1=".$tglS."&mon1=".$bulanS."&year1=".$tahunS."&day2=".$tglE."&mon2=".$bulanE."&year2=".$tahunE."&trxFilter=%", $post_Pag, $this->cookie_file);
				//$test_page[] = $resultP_Pag;
					# START : Ambil Data Mutasi
					$html	= $ci->domparser->str_get_html($resultP_Pag['result']);
					foreach ($html->find('table[class=clsFormTrxStatus]') as $e)
					{
						$table	= $e->innertext;
					}
					$html2	= $ci->domparser->str_get_html($table);
					$tr=array();
					$rmut=array();
					foreach ($html2->find('tr[class=clsEven]') as $ee)
					{
						#Star : untuk Jumlah Validasi
						$tr[]	= trim($ci->domparser->remove_HTML($ee->innertext));
						#End : untuk Jumlah Validasi
						$html3	= $ci->domparser->str_get_html($ee->innertext);
						$row	= array();
						foreach ($html3->find('td') as $g)
						{
							$row[] = trim($ci->domparser->remove_HTML($g->innertext));
						}
						
						$rmut[]	= $row; 
					}
					#Star : untuk Validasi Data Mutasi
					$jml = count($tr);
					$val1 = ($jml-2);
					$val = 0;
					#End : untuk Validasi Data Mutasi
				# END : Ambil Data Mutasi
					
					foreach($rmut as $dm)
					{
						if($val<$val1){
						$mutasi[]	= array("mutasi_date_time"		=> $dm[0],
											"mutasi_date"			=> $dm[1],
											"mutasi_note"			=> $dm[2],
											"mutasi_reference_no"	=> $dm[3],
											"mutasi_debit"			=> $dm[4],
											"mutasi_credit"			=> $dm[5],
											"mutasi_saldo"			=> $dm[6]);
						}
						$val++;
					}	
					# END : Ambil Data Mutasi
				}
				#END :PAGING CURL
			}
					
				
			if(!empty($mutasi)){
				$result = array('error_no' 				=> "0",
								'account_info'			=> array("bank"				=> $bank_name,
																 "account_no"		=> $account_no,
																 "account_holder"	=> $account_holder),
								'mutasi'				=> $mutasi);
			}else{
					$result	= array('error_no'=>'1004',
									'error_msg'=>'Tidak Ada Data Mutasi');
				}
		}else{
			$result	= array('error_no'=>'1005',
							'error_msg'=>'Login Mandiri Gagal');
		}
		
		$this->logout();
		return $result;
    }
}

?>

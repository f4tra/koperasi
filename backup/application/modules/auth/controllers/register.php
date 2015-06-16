<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Register controller.
 * 
 * @package App
 * @category Controller
 * @author Muhamad Jafar Sidik
 */
class Register extends MY_Controller 
{
	private $ci;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mgeneral');
		$this->load->helper('rand_string');
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
		
	}
	function index()
	{
		//echo rand_string(12);
		// user is already logged in
        if ($this->auth->loggedin()) 
		{
            redirect($this->config->item('dashboard_uri'));
        }		
		else{
			redirect($this->config->item('dashboard_uri'));
		}
	}
	
	function execute(){
		
		$result		= array();	
		if(!isset($_POST['email'])){
			$result['retCode'] = '10';
			$result['retMsg'] = 'Invalid param.';
			$result['result'] = FALSE;
		}else{
			$date 		= date('Y-m-d');
			$email		= $this->input->post('email');
			$guser		= rand_string(6);
			$gp			= rand_string(6);
			$gpass_decod= $gp;
			$gpass		= $this->ci->passwordhash->HashPassword($gp);
			$name		= $this->input->post('name');
			$code = sha1(md5(rand_string(6)));
			$links = "http://bdsinu.no-ip.biz:8888/kaspoint/index.php/auth/active/verify/".base64_encode($email); // change your url
			$pesan = "Calon Pelanggan yang Terhormat,

						Terima kasih ".$name." telah melakukan Pendaftaran pada aplikasi Kaspoint PT.Links.co.id
						Silahkan lakukan aktifasi dengan Mengklik 
						".$links."
						Username : ".$guser."
						Password : ".$gpass_decod."
						-----------------------";	
						
			if(isset($_POST['email']))
			{
				$email = mysql_real_escape_string($_POST['email']);
				$check_for_email = $this->db->query("select * from t_user where email1 ='".$_POST['email']."'");
				if($check_for_email->num_rows())
				{
					$result['retCode'] = '20';
					$result['retMsg'] = 'Email Not Available';
					$result['result'] = true;
				}
				else
				{
					$data_user	= array(
						'ID_'			=>$code,
						'active'		=>0,
						'nick_name'		=>$name,
						'email1' 		=>$email,
						'username'		=>$guser,
						'password'		=>$gpass,				
						'reg_date'		=>$date,
						'nick_name'		=>$name,
						'active_login'	=>0,
						'role'			=>"cab483821c4eacfc41fee8c0ffe72216"
					);
					$save = $this->mgeneral->save($data_user,'t_user');
					/* if(!$save){
						$result['retCode'] = '001';
						$result['retMsg'] = 'Pendaftaran tidak sukses';
					}else{ */
						$this->email->from('inu@links.co.id','Sales - Kaspoint');
						$this->email->to($this->input->post('email'));
						$this->email->subject('Dealer Register');
						$this->email->message($pesan);
						$this->email->send();
						$result['username'] 	= $guser;
						$result['password'] 	= $gpass_decod;
						
						$result['retCode'] = '00';
						//$result['url']		= 'localhost/ppob/index.php/auth/login'; //change your url
						$result['retMsg'] = 'Success To Registrasi but not active your account.';
						$result['result'] = TRUE;
						$result['uri']		=$links;
					//}
				}
			}
			else{				
				$result['retCode'] 	= '01';
				$result['retMsg'] 	= 'Error Registration.';
				$result['result']	= TRUE;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	
	function cek_email(){
			$email = $this->input->post('email');
		if(isset($_POST['email']))//If a username has been submitted
		{
			$email = mysql_real_escape_string($_POST['email']);//Some clean up :)
			
			$check_for_email = $this->db->query("select * from t_user where email1 ='".$email."'");			
			//print_r($check_for_email->num_rows());
			if($check_for_email->num_rows())
			{
				echo '1';//If there is a  record match in the Database - Not Available
			}
			else
			{
				echo '0';//No Record Found - Username is available
			}
		}
		
	}
}

/* End of file register.php */
/* Location: ./application/modules/auth/controllers/register.php */
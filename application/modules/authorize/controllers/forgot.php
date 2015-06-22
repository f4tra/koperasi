<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Register controller.
 * 
 * @package App
 * @category Controller
 * @author Muhamad Jafar Sidik
 */
class Forgot extends MY_Controller 
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
			$gp			= rand_string(6);
			$gpass_decod= $gp;
			$gpass		= $this->ci->passwordhash->HashPassword($gp);
				
						
			if(isset($email))
			{
				$mail = mysql_real_escape_string($email);
				$check_for_email = $this->db->query("select * from t_user where email1 ='".$mail."'");
				if($check_for_email->num_rows() <= 0)
				{
					//$result['r'] = $check_for_email->num_rows();
					$result['retCode'] = '20';
					$result['retMsg'] = 'Email Not Available';
					$result['result'] = true;
				}
				else
				{
					$u = $check_for_email->row();
					$pesan = "Pelanggan yang Terhormat,

						Berikut password Baru anda
						Username : ".$u->username."
						Password : ".$gpass_decod."
						-----------------------";
					$data_user	= array('password'=>$gpass);
					$save = $this->mgeneral->update(array('email1'=>$mail),$data_user,'t_user');
					$this->email->from('inu@links.co.id','admin - PPOB');
					$this->email->to($email);
					$this->email->subject('Dealer Register');
					$this->email->message($pesan);
					$this->email->send();
					$result['retCode'] = '00';
					//$result['url']		= 'localhost/ppob/index.php/auth/login'; //change your url
					$result['retMsg'] = 'Change Password Sukses.';
					$result['result'] = TRUE;
					//$result['uri']		=$links;
					
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
	
	
}

/* End of file register.php */
/* Location: ./application/modules/auth/controllers/register.php */
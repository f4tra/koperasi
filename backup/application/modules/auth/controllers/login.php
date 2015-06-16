<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login controller.
 * 
 * @package App
 * @category Controller
 * @author Jafar Sidik
 */
class Login extends MY_Controller 
{
	private $ci;
	
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
		//$this->load->model("Mgeneraldealer");
	}
	function index()
	{
		
		/* $correct = 'admin';
		//$hash = $this->ci->passwordhash->HashPassword($correct);

		//print 'Hash: ' . $hash . "\n";
		$h ='$2a$08$QVrpOmh/M2ANSToTsu3yeu.znfVkduF16YmfklXLKZZ4jVMSgaFzS';
		$lop = $this->mgeneral->getWhere(array('username'=>'admin'),'tr_user');
		$g = $lop[0];
		//print_r($g);
		echo "<br />";
		print_r($h);
		$data = $this->ci->passwordhash->CheckPassword('admin', $g->passwd);	
         */
		
		if ($this->auth->loggedin()) 
		{			
			redirect($this->config->item('dashboard_uri'));
        }
		else
		{
			redirect($this->config->item('dashboard_uri'));
		}
		
	}
	function action(){
		if(!$this->input->is_ajax_request()) exit(show_error('Maaf Anda tidak diperbolehkan mengakses halaman ini',500));
		$this->load->language('auth');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$result = array();
		if(!isset($username) and !isset($password)){
			$result['rescode'] = '10';
			$result['message'] = 'Invalid param.';
			
		}else{
			$cek_user	= $this->mgeneral->GetByUsername($username,'tr_user');
			//print_r($cek_user);
			if($cek_user->num_rows() <=0){
				$result['retcode']	= '11';
				$result['message']	= 'User Not found';
			}
			else{
				$user = $cek_user->result();
				$user = $user[0];				
				$cek_p = $this->ci->passwordhash->CheckPassword($password, $user->password);				
				if($cek_p == true and $user->active == 1)
				{
					$remember = $this->input->post('remember') ? TRUE : FALSE;
					$this->auth->login($user->id, $remember);
					// Add session data
					$this->session->set_userdata(array(					
						'role'	=> $user->role_id,						
					));
					$result['retcode']	= '200';
					$result['url']		= site_url();
					$result['message']	= "Succes Login";					
				}
				else
				{
					$result['retcode']	= "12";
					$result['message']	= "Username Password not match";
				}
			}
		}	
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	}
	
}

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */
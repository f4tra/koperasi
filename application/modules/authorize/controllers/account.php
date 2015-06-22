<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login controller.
 * 
 * @package App
 * @category Controller
 * @author Jafar Sidik
 */
class Account extends Admin_Controller 
{
	private $ci;
	
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
	}
	function index()
	{
		$id			= $this->auth->userid();		
		$this->data['account']	= $this->mgeneral->getRow(array('id'=>$id),'auth_users');

		$this->template->build('account/index');
		
	}
	function action(){
		$result = array();
		$id = $this->auth->userid();
		$username = $this->input->post("username");
		$password = $this->input->post("password_c");
		$cek = $this->db->query("select count(*) username from auth_users where username='".$username."'")->row();
		//$result['code'] = $cek;
		if($username == null and $password == null){
			$result['rescode'] = '10';
			$result['message'] = 'Your Account has Updated.';
			
		}
		else if($username != null and $password == null and $cek->username  > 0){
			
			$result['rescode'] = "USD";
			$result['message'] = "username sudah digunakan.";
		}
		else if($username != null and $password == null and $cek->username <= 0){
			$data= array('username'=>$username);
			$this->mgeneral->update(array('id'=>$id),$data,"auth_users");
			$result['rescode'] = "USN";
			$result['message'] = "Your Username has Updated.";
		}
		else if($username != null and $password != null and $cek->username > 0){
			//$data= array('username'=>$username,'passwd'=>$this->ci->passwordhash->HashPassword($password));
			//$this->mgeneral->update(array('id'=>$id),$data,"tr_user");
			$result['rescode'] = 'UPN';
			$result['message'] = 'username sudah digunakan dan password tidak di save.';
			
		}
		else if($username != null and $password != null and $cek->username <= 0){
			$data= array('username'=>$username,'password'=>$this->ci->passwordhash->HashPassword($password));
			$this->mgeneral->update(array('id'=>$id),$data,"auth_users");
			$result['rescode'] = 'UPS';
			$result['message'] = 'username belum digunakan dan password  di save.';
		}
		else if($username == null and $password != null ){
			$data= array('password'=>$this->ci->passwordhash->HashPassword($password));
			$this->mgeneral->update(array('id'=>$id),$data,"auth_users");
			$result['rescode'] = 'PASS';
			$result['message'] = 'Change password.';
		}		
		echo json_encode($result);
	}
	function cek_username(){
		if(isset($_POST['username']))//If a username has been submitted
		{
			$username = mysql_real_escape_string($_POST['username']);//Some clean up :)
			$check_for_username = $this->db->query("select * from auth_users where username ='".$username."'");			
			if($check_for_username->num_rows())
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

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login controller.
 * 
 * @package App
 * @category Controller
 * @author Jafar Sidik
 */
class Profile extends Admin_Controller 
{
	private $ci;
	
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
		$this->template->set_js('js/bootstrap-datepicker')->set_css('css/datepicker3');
	}
	function index()
	{
		$id			= $this->auth->userid();
		$this->data['user']			= $this->mgeneral->getRow(array('id'=>$id),'auth_users');		
		$js = $this->load->file('assets/beckend/my_js/my_tables.js',true);		
		$this->template
			->set_title("Profile")			
			->set_js_script($js,'',true)
			->build('profile/profile');
		
	}
	function action(){
		$result = array();
		$id			= $this->auth->userid();
		$data =  array(				
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),				
				'email'=>$this->input->post('email')				
			);
		$result['code'] = 0;
		$this->mgeneral->update(array('id'=>$id),$data,"auth_users");
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	
}

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */
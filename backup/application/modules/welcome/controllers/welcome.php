<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->language('welcome');		
		//$this->load->helper('rand_string');
	}
	
	public function index()
	{
		
		// user is already logged in
        if ($this->auth->loggedin()) 
		{
			$id		= $this->auth->userid();
			$session=$this->db->query("select role_id from tr_user where id='".$id."'")->row();
							
			$sqlmenu1	=$this->db->query("
						SELECT b.role_id, b.gui_id,a.id,
						a.code,	a.name,a.icons, a.caption,b.active, a.parent_id, a.link FROM	tr_gui AS a
						INNER JOIN tr_role_gui AS b ON a.id = b.gui_id where a.parent_id='0' and b.active='1' and b.role_id='".$session->role_id."' ORDER BY a.id ASC")->result();
				
			$this->data['main_pages'] = $sqlmenu1;//$this->mgeneral->GetWhere(array('parent_id'=>0),'tr_gui');
			//$this->data['main_pages'] = $this->mgeneral->GetAll('tr_gui');
			$this->template->set_js('js/hightchart/highcharts');
			$this->template->build('dashboard');
			
		}
		else
		{
			$this->load->language('auth');
			$this->load->helper('form');
		
			$this->template
			->set_layout('login')
			->set_css('js/uniform/css/uniform.default.min')
			->set_css('css/animatecss/animate.min')
			->set_js('js/uniform/jquery.uniform.min',true)			
			->set_js('js/jquery-validate/jquery.validate.min')			
			->build('login');
		}
	}	
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Setup controller.
 * 
 * @package App
 * @category Controller
 * @author Muhamad jafar Sidik
 */
class Setup extends Admin_Controller 
{
	function __construct()
	{
		parent::__construct();
		
	}
	function index(){
		$this->template
		->build('index');
	}
	
}

/* End of file user.php */
/* Location: ./application/modules/auth/controllers/user.php */
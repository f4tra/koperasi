<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Error extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function error_404()
	{	
		//$this->data['request'] = $this->input->server();
		//print_r($this->data['request']);
		$this->template->build('404');
	}	
	
	
	
}

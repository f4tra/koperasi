<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Apps extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function execute($method = '',$id = '')
	{		
		$result = array();
		$html = "";
		$data =  array(
				"code"		=> 'calender',//$this->input->post('code'),
				"name"		=> "Caleder",//$this->input->post('name'),
				"descr"		=> $html,
				"active"	=> 1,							
				"uri"		=> 'marketplace/load/index',							
			);
			$this->mgeneral->save($data,"tj_marketplace");
			$result['code'] 	= "02";
			$result['message']	= "Install Success";
		
		echo json_encode($result);
	}	
	
}

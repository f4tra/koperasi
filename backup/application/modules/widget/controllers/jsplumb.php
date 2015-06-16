<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', 'On');					
   
/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Jsplumb extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index()
	{
		/*$this->data['variable'] =  array(
			'opened'=>'opened',
			'phone1'=>'phone1',
			'phone2'=>'phone2',
			'inperson'=>'inperson',
			'rejected'=>'rejected'
			);*/
		$this->data['variable'] = $this->mgeneral->getAll('gantt_tasks');
		$this->data['variable_2'] = $this->mgeneral->getAll('gantt_links');
		$this->template->build('jsplumb/index');
	}
	function load_data(){
		
	}
	function push(){
		$source = $this->input->post('source');
		$target = $this->input->post('target');
		$loop 	= $this->mgeneral->getRow(array('source'=>$source,'target'=>$target),'gantt_links');
		print_r($loop);
		if(empty($loop)){
			$data = array(
						'source'=>$source,
						'target'=>$target
					);
					$this->mgeneral->save($data,'gantt_links');
			
		}else{
			
		}
	}
	
	
}

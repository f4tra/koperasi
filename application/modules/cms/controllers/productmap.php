<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Node Maps controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Productmap extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
		$this->load->model('node_model');
	}	
	function index()
	{
		//$f = $this->node_model->get_list();
		//print_r($f);
		$this->data['e']  =  $this->mgeneral->getAll('tr_item');//$this->node_model->get_list();		
		$this->template->build('productmap/index');
	}
	function maps_push(){
			$id = $this->input->post('id');
		$data =  array(
			'gps_x'=>$this->input->post('gpsx'),
			'gps_y'=>$this->input->post('gpsy'),
			);
		$this->mgeneral->update(array('id' => $id),$data,'tr_item');
	}
	
}

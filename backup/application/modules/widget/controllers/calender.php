<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Calender extends Admin_Controller 
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
		$this->data['event_data'] = $this->mgeneral->getwhere(array('active'=>1),'tr_events');
		$this->template->build('calender/index');
	}
	function load_event(){
		//echo "<pre>";
		$year = date('Y'); 
   		$month = date('m');
   		//echo "<pre/>";
   		$data = $this->mgeneral->getall("tt_events");
   		foreach ($data as $key => $value) {
   			
   			$fetch['id'] = $value->id; 
   			$fetch['title'] = $value->name; 
   			$fetch['start'] = $value->start_date; 
   			$fetch['end'] = $value->end_date;    		
   			//$fetch['url'] = "google.com";    		
   			$fetch['allDay'] = false;    		
   			$fetch['color'] = 'red';    		
   			$rows[] = $fetch;
   		};
   		echo json_encode($rows);   		
   		//echo "</pre>";
	}
	function save_event(){
		$data= array(
			//'code'=>'tes',
			'name'		=>	$this->input->post('name'),
			'start_date'=>$this->input->post('start_date'),
			'end_date'=>$this->input->post('end_date'),
		);
		$r = $this->mgeneral->save($data,"tt_events");
		echo json_encode(array('id'=>$r));
		$this->mgeneral->update(array('name'=>$this->input->post('name')),array('active'=>1),"tr_events");
	}
	function update_event(){
		$data = array(
			//'name'		=>	$this->input->post('name'),
			'start_date'=>$this->input->post('start_date'),
			'end_date'=>$this->input->post('end_date'),
		);
		$this->mgeneral->update(array('id'=>$this->input->post('id')),$data,"tt_events");
	}
	
}

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
	function details($idx = ''){
		$this->data['idx'] =  $idx;
		$this->template->build('calender/details');	
	}
	function load_event($idx = ''){
		$year = date('Y'); 
   		$month = date('m');
   		$data = $this->mgeneral->getwhere(array("event_id"=>$idx),"tt_events");
   		foreach ($data as $key => $value) {   			
   		$warna = array("red","pink","blue","green");
		$rand_warna = shuffle($warna);		
   			$fetch['id'] = $value->id; 
   			$fetch['url'] = "apps/calender/details";
   			$fetch['title'] = $value->name; 
   			$fetch['start'] = $value->start_date; 
   			$fetch['end'] = $value->end_date;    		
   			$fetch['allDay'] = false;    		
   			$fetch['color'] = $warna[$rand_warna];    		
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
		$data= array(
			//'name'		=>	$this->input->post('name'),
			'start_date'=>$this->input->post('start_date'),
			'end_date'=>$this->input->post('end_date'),
		);
		$this->mgeneral->update(array('id'=>$this->input->post('id')),$data,"tt_events");
	}
	
}

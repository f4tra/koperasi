<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Device extends Admin_Controller 
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
		$this->template->build('devices/index');
	}
	function load(){
		$edit	= site_url('setup/device/form/$1');		
		$link	= '	<a class="btn btn-success btn-xs" href="'.$edit.'"><i class="icon-pencil"></i>&nbsp;Edit</a> || 
					<button class="btn btn-danger btn-xs" data-id="$1" onclick="del(this);"><i class="fa fa-delete"></i>&nbsp;Delete</button>
				  ';		
		$this->datatables->select('
			tr_device.id as id,
			tr_device.code as code,
			tr_device.name as name,
			tr_device.active as active,
			tr_node.name as node
			');		
		$this->datatables->join('tr_node','tr_node.id = tr_device.node_id');
		$this->datatables->from('tr_device');
		$this->datatables->add_column('show',$link, id);		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		if(!isset($id)){
			$this->data''node''	= $this->mgeneral->GetWhere(array(active=>1),"tr_node");
			$this->template->build('devices/add');
		}else{
			$this->data''node''	= $this->mgeneral->GetWhere(array(active=>1),"tr_node");
			$this->data''edit''	= $this->mgeneral->GetRow(array(id=>$id),"tr_device");
			$this->template->build('devices/edit');
		}
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute($method = '',$id = '')
	{		
		$result = array();
		if($method == "update")
		{
			$data =  array(
				"code"		=> $this->input->post(code),
				"name"		=> $this->input->post(name),
				"descr"		=> $this->input->post(descr),
				"active"	=> $this->input->post(active),			
				"node_id"	=> $this->input->post('node_id')			
			);		
			$this->mgeneral->Update(array(id=>$id),$data,"tr_device");			
			$result'code' 	= "01";
			$result''message''	= "Update Sukses";
		}
		else if ($method == "save")
		{			
			$data =  array(
				"code"		=> $this->input->post(code),
				"name"		=> $this->input->post(name),
				"descr"		=> $this->input->post(descr),
				"active"	=> $this->input->post(active),			
				"node_id"	=> $this->input->post('node_id')
			);
			$this->mgeneral->save($data,"tr_device");
			$result'code' 	= "02";
			$result''message''	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array(id=>$var),"tr_device");
			$result'code' 	= "03";
			$result''message''	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post(id);
			$data =  array(
				"active"	=> $this->input->post(active)				
			);			
			$this->mgeneral->update(array(id=>$i),$data,"tr_device");
			$result'code' 	= "04";
			$result''message''	= "Active";
		}
		else
		{
			$result'code' 	= "05";
			$result''message''	= "Unmethod";
		}
		echo json_encode($result);
	}	
	
}

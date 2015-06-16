<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Sop extends Admin_Controller 
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
		$uid 	= $this->auth->userid();
		$this->data['user'] =  $this->mgeneral->getRow(array('id'=>$uid),'tr_user');
		if($this->data['user']->id == 1){
			$query = $this->db->query("
			select
				a.id as id,
				a.code as code,
				a.name as name,
				a.active as active,
				a.descr as descr,
				b.name as role_id
			from tr_sop a
				left join tr_role b on b.id = a.role_id
			")->result();	
		}else{
			
		$query = $this->db->query("
			select
				a.id as id,
				a.code as code,
				a.name as name,
				a.active as active,
				a.descr as descr,
				b.name as role_id
			from tr_sop a
				left join tr_role b on b.id = a.role_id
			where role_id = '".$this->data['user']->role_id."'
			")->result();
		}
		$this->data['data'] = $query;
		$this->template->build('sop_view/index');
	}
	
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data['role_id']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_role");
		if(!isset($id)){
			$this->template->build('sop_view/add');
		}else{
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_sop");
			$this->template->build('sop_view/edit');
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
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),			
				"role_id"	=> $this->input->post('role_id')
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_sop");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{			
			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),			
				"role_id"	=> $this->input->post('role_id')
			);		
			$this->mgeneral->save($data,"tr_sop");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_sop");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_sop");
			$result['code'] 	= "04";
			$result['message']	= "Active";
		}
		else
		{
			$result['code'] 	= "05";
			$result['message']	= "Unmethod";
		}
		echo json_encode($result);
	}	
	
}

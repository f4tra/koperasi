<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Role management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Workgroup extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
	}	
	function index()
	{
		$this->template->build('workgroup/index');
	}
	function load(){
		$edit	= site_url('setup/workgroup/form/$1');		
		$link	= '	<a class="btn btn-warning btn-m" title="Edit" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('a.id as id,a.code,a.name,a.descr,a.active,b.name as parent');
		$this->datatables->from('tr_sys_workgroup a');			
		$this->datatables->join('tr_sys_workgroup b','b.id = a.parent_id','left');			
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	
	/*
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		if(!isset($id)){
			$this->data['workgroup']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_sys_workgroup");
			$this->template->build('workgroup/add');
		}else{
			$this->data['workgroup']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_sys_workgroup");
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_sys_workgroup");
			$this->template->build('workgroup/edit');
		}
	}
	/**
	 * View 
	 * 
	 * @param integer $id 
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
				"parent_id"	=> $this->input->post('parent_id'),		
				"active"	=> $this->input->post('active')
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_sys_workgroup");
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$data =  array(				
				"code"		=> $this->input->post('code'),		
				"name"		=> $this->input->post('name'),		
				"descr"		=> $this->input->post('descr'),		
				"parent_id"	=> $this->input->post('parent_id'),		
				"active"	=> $this->input->post('active')
			);						
			$this->mgeneral->Save($data,"tr_sys_workgroup");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->Delete(array('id'=>$var),"tr_sys_workgroup");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_sys_workgroup");
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


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
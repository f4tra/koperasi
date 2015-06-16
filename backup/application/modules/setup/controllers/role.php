<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Role management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Role extends Admin_Controller 
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
		$this->template->build('role-user/role-index');
	}
	function load(){
		$edit	= site_url('setup/role/edit/$1');		
		$link	= '
					<a  title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  
				  ';		
				
		$this->datatables->select('id,code,name,active');
		$this->datatables->from('tr_role');			
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	
	/**
	 * Add a new . 
	 */
	function add()
	{
		$this->template->build('role-user/role-add');
	}
	
	/**
	 * Edit 
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->data['edit']	= $this->mgeneral->getrow(array('id'=>$id),"tr_role");
		$this->template->build('role-user/role-edit');
	}
	/**
	 * View 
	 * 
	 * @param integer $id 
	 */
	function view($id)
	{
		$this->data['view']	= $this->mgeneral->GetWhere(array('id'=>$id),"tr_role");
		$this->template->build('role-user/role-views');
	}
	function execute($method = '',$id = '')
	{
		$result = array();
		if($method == "update")
		{
			$data =  array(				
				"code"		=> $this->input->post('code'),		
				"name"		=> $this->input->post('name'),		
				"descr"		=> $this->input->post('descr'),		
				"isrepp"		=> $this->input->post('isrepp'),		
				"active"		=> $this->input->post('active')		
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_role");
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$data =  array(				
				"code"		=> $this->input->post('code'),		
				"name"		=> $this->input->post('name'),		
				"descr"		=> $this->input->post('descr'),		
				"isrepp"		=> $this->input->post('isrepp'),		
				"active"		=> $this->input->post('active')		
			);			
			$this->mgeneral->Save($data,"tr_role");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->Delete(array('id'=>$var),"tr_role");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_role");
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
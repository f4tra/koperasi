<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Issuer extends Admin_Controller 
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
		$this->template->build('issuer/index');
	}
	function load(){
		$edit	= site_url('organization/issuer/form/$1');		
		$link	= '	<a title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			b.name as parent
			');		
		$this->datatables->from('tr_company a');		
		$this->datatables->join('tr_company b','b.id = a.parent_id','left');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();

	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data['user']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
		$this->data['issuer']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_company");
		if(!isset($id)){
			$this->template->build('issuer/add');
		}else{
			$this->data['edit']		= $this->mgeneral->GetRow(array('id'=>$id),"tr_company");
			
			$this->template->build('issuer/edit');
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
				"address1"	=> $this->input->post('address1'),
				"address2"	=> $this->input->post('address2'),
				"phone1"	=> $this->input->post('phone1'),
				"phone2"	=> $this->input->post('phone2'),
				"email1"	=> $this->input->post('email1'),
				"email2"	=> $this->input->post('email2'),
				"fax1"		=> $this->input->post('fax1'),
				"fax2"		=> $this->input->post('fax2'),
				"zip1"		=> $this->input->post('zip2'),
				"zip2"		=> $this->input->post('zip2'),
				"parent_id"	=> $this->input->post('parent'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),
				"pic_id"	=> $this->input->post('user')			
			);				
			
			
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_company");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{				
			
			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"address1"	=> $this->input->post('address1'),
				"address2"	=> $this->input->post('address2'),
				"phone1"	=> $this->input->post('phone1'),
				"phone2"	=> $this->input->post('phone2'),
				"email1"	=> $this->input->post('email1'),
				"email2"	=> $this->input->post('email2'),
				"fax1"		=> $this->input->post('fax1'),
				"fax2"		=> $this->input->post('fax2'),
				"zip1"		=> $this->input->post('zip2'),
				"zip2"		=> $this->input->post('zip2'),
				"parent_id"	=> $this->input->post('parent'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),
				"pic_id"	=> $this->input->post('user')			
			);		
			
			$this->mgeneral->save($data,"tr_company");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_company");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_company");
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

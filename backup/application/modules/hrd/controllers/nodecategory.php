<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Nodecategory extends Admin_Controller 
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
		$this->template->build('node-category/index');
	}
	function load(){
		$edit	= site_url('organization/nodecategory/form/$1');		
		$link	= '	<a class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button class="btn btn-danger btn-m" title="Edit" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,
			a.name as name,
			a.active as active,
			b.name as parent,
			c.name as type,
			d.name as g
		');		
		
		$this->datatables->from('tr_node_ctg a');
		$this->datatables->join('tr_node_ctg b','b.id = a.parent_id','left');
		$this->datatables->join('tr_node_type c','c.id = a.type_id','left');
		$this->datatables->join('tr_node_grp d','d.id = a.grp_id','left');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		if(!isset($id)){
			$this->data['node_type']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_type");
			$this->data['node_category']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_ctg");			
			$this->data['node_group']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_grp");			
			$this->template->build('node-category/add');
		}else{
			$this->data['node_type']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_type");
			$this->data['node_category']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_ctg");
			$this->data['node_group']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_grp");
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_node_ctg");
			$this->template->build('node-category/edit');
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
				"parent_id"	=> $this->input->post('parent_id'),
				"type_id"	=> $this->input->post('type_id'),
				"grp_id"	=> $this->input->post('group_id')

			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_node_ctg");			
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
				"parent_id"	=> $this->input->post('parent_id'),
				"type_id"	=> $this->input->post('type_id'),
				"grp_id"	=> $this->input->post('group_id')		
			);
			$this->mgeneral->save($data,"tr_node_ctg");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_node_ctg");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_node_ctg");
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

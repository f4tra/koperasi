<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Gander extends Admin_Controller 
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
		$this->template->build('gander/index');
	}
	function load(){
		$edit	= site_url('inventory/gander/form/$1');				
		$link	= '	<a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,
			a.name as name,
			a.active as active,
			a.descr as descr,			
			par.name as parent,			
			ctg.name as ctg,			
		');		
		
		$this->datatables->from('tr_item_spc a');
		$this->datatables->join('tr_item_spc par','par.id = a.parent_id','left');	
		$this->datatables->join('tr_item_spc_type t','t.id = a.type_id','left');	
		$this->datatables->join('tr_item_ctg ctg','ctg.id = a.ctg_id','left');	
		$this->datatables->where('a.type_id', 4);
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data['ctg_id']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_ctg");
		$this->data['parent']	= $this->mgeneral->GetWhere(array('type_id'=>4),"tr_item_spc");
		if(!isset($id)){
			$this->template->build('gander/add');
		}else{
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_item_spc");
			$this->template->build('gander/edit');
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
				"ctg_id"	=> $this->input->post('ctg_id'),
				"parent_id"	=> $this->input->post('parent_id'),							
				"type_id"	=> 4
			);		
			//print_r($data);
			//print_r($_POST);
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_item_spc");			
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
				"ctg_id"	=> $this->input->post('ctg_id'),			
				"parent_id"	=> $this->input->post('parent_id'),			
				"type_id"	=> 4			
			);
			$this->mgeneral->save($data,"tr_item_spc");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_item_spc");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_item_spc");
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

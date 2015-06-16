<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Itemtype extends Admin_Controller 
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
		$this->template->build('item-type/index');
	}
	function load(){
		$edit	= site_url('item/itemtype/form/$1');		
		$link	= '	<a class="btn btn-success btn-xs" href="'.$edit.'"><i class="icon-pencil"></i>&nbsp;Edit</a> || 
					<button class="btn btn-danger btn-xs" data-id="$1" onclick="del(this);"><i class="fa fa-delete"></i>&nbsp;Delete</button>
				  ';		
		$this->datatables->select('
			tr_item_type.id as id,
			tr_item_type.code as code,
			tr_item_type.name as name,
			tr_item_type.active as active,
			tr_item_category.name as category
			');		
		$this->datatables->join('tr_item_category','tr_item_category.id = tr_item_type.category_id');
		$this->datatables->from('tr_item_type');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		if(!isset($id)){
			$this->data['item_category']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_category");
			$this->template->build('item-type/add');
		}else{
			$this->data['item_category']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_category");
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_item_type");
			$this->template->build('item-type/edit');
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
				"category_id"	=> $this->input->post('category_id')			
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_item_type");			
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
				"category_id"	=> $this->input->post('category_id')
			);
			$this->mgeneral->save($data,"tr_item_type");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_item_type");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_item_type");
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

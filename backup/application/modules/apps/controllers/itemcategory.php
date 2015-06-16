<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Itemcategory extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();
		$this->load->library('upload');
		$this->load->helper('download');
		$this->load->helper('file');			
	}	
	function index()
	{
		$this->template->build('item_category/index');
			
	}
	function load(){
		$edit	= site_url('apps/itemcategory/form/$1');				
		$link	= '<a class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
				   <button class="btn btn-danger btn-m" title="Edit" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,
			a.name as name,
			a.active as active,
			b.name as parent,
			c.name as type,
			d.name as grp
		');		
		
		$this->datatables->from('tr_item_ctg a');
		$this->datatables->join('tr_item_ctg b','b.id = a.parent_id','left');
		$this->datatables->join('tr_item_type c','c.id = a.type_id','left');
		$this->datatables->join('tr_item_grp d','d.id = a.group_id','left');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		if(!isset($id)){
			$this->data['node_type']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_type");
			$this->data['node_category']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_ctg");			
			$this->data['node_group']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_grp");			
			$this->template->build('item_category/add');
		}else{
			$this->data['node_type']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_type");
			$this->data['node_category']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_ctg");
			$this->data['node_group']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_grp");
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_item_ctg");
			$this->template->build('item_category/edit');
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
			/*$config['upload_path'] = './uploader/product';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size']	= '10240';			
			$this->upload->initialize($config);		
			$this->upload->do_upload('userfile');*/

			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),
				"parent_id"	=> $this->input->post('parent_id'),
				"type_id"	=> $this->input->post('type_id'),
				"group_id"	=> $this->input->post('group_id'),				
				//"filename"  =>$_FILES['userfile']['name'],

			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_item_ctg");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{			
			/*$config['upload_path'] = './uploader/product';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size']	= '10240';			
			$this->upload->initialize($config);		
			$this->upload->do_upload('userfile');*/

			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),
				"parent_id"	=> $this->input->post('parent_id'),
				"type_id"	=> $this->input->post('type_id'),
				"group_id"	=> $this->input->post('group_id'),
				//"filename" =>$_FILES['userfile']['name'],	
			);
			$this->mgeneral->save($data,"tr_item_ctg");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			/*$file = $this->mgeneral->getRow(array('id' =>$var),'tr_item_ctg');
		
 			unlink("./uploader/product/$file->filename");*/
			$this->mgeneral->delete(array('id'=>$var),"tr_item_ctg");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_item_ctg");
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

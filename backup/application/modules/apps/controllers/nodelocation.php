<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Nodelocation extends Admin_Controller 
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
		$this->template->build('nodelocation/index');
	}
	function load(){
		$edit	= site_url('apps/nodelocation/form/$1');		
		$link	= '	<a title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.active as active,
			b.name as name,
			c.name as grp,
			d.name as ctg,
			e.name as type
			');		
		$this->datatables->from('tr_node a');		
		$this->datatables->join('tr_company b','b.id = a.company_id','left');
		$this->datatables->join('tr_node_grp c','c.id = a.grp_id','left');
		$this->datatables->join('tr_node_ctg d','d.id = a.ctg_id','left');
		$this->datatables->join('tr_node_type e','e.id = a.type_id','left');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();

	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		if(!isset($id)){
			$this->data['pic_id']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
			$this->data['company']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_company");
			$this->template->build('nodelocation/add');
		}else{
			$this->data['pic_id']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
			$this->data['company']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_company");
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_node");
			$this->template->build('nodelocation/edit');
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
				"company_id"=> $this->input->post('company_id'),
				"gps_x"		=> $this->input->post('gpsx'),
				"gps_y"		=> $this->input->post('gpsy'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),
				"pic_id"	=> $this->input->post('pic_id')							
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_node");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{			
			$data =  array(
				"code"		=> $this->input->post('code'),
				"company_id"=> $this->input->post('company_id'),
				"gps_x"		=> $this->input->post('gpsx'),
				"gps_y"		=> $this->input->post('gpsy'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),
				"pic_id"	=> $this->input->post('pic_id')			
			);
			$this->mgeneral->save($data,"tr_node");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_node");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_node");
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

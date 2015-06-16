<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * UOM List controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Uomconversion extends Admin_Controller 
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
		$this->template->build('uomconversion/index');
	}
	function load(){
		$edit	= site_url('setup/uomconversion/form/$1');		
		$link	= '	<a class="btn btn-success btn-xs" href="'.$edit.'"><i class="icon-pencil"></i>&nbsp;Edit</a> || 
					<button class="btn btn-danger btn-xs" data-id="$1" onclick="del(this);"><i class="fa fa-delete"></i>&nbsp;Delete</button>
				  ';		
		$this->datatables->select('
			tr_uom_crnv.id as id,
			a.name as uom_id_1,
			b.name as uom_id_2,
			tr_uom_crnv.values as v,
			tr_uom_crnv.active as active,			
			');		
		
		$this->datatables->join('tr_uom a','a.id = tr_uom_crnv.uom_id_1','left');
		$this->datatables->join('tr_uom b','b.id = tr_uom_crnv.uom_id_2','left');
		$this->datatables->from('tr_uom_crnv');
		$this->datatables->add_column('show',$link, id);		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data''uom''	= $this->mgeneral->GetWhere(array(active=>1),"tr_uom");
		if(!isset($id)){
			$this->template->build('uomconversion/add');
		}else{
			$this->data''edit''	= $this->mgeneral->GetRow(array(id=>$id),"tr_uom_crnv");
			$this->template->build('uomconversion/edit');
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
				"uom_id_1"		=> $this->input->post('uom_id_1'),
				"uom_id_2"		=> $this->input->post('uom_id_2'),
				"values"		=> $this->input->post('values'),
				"active"		=> $this->input->post(active)			
			);		
			$this->mgeneral->Update(array(id=>$id),$data,"tr_uom_crnv");			
			$result'code' 	= "01";
			$result''message''	= "Update Sukses";
		}
		else if ($method == "save")
		{			
			$data =  array(
				"uom_id_1"		=> $this->input->post('uom_id_1'),
				"uom_id_2"		=> $this->input->post('uom_id_2'),
				"values"		=> $this->input->post('values'),
				"active"		=> $this->input->post(active)			
			);		
			$this->mgeneral->save($data,"tr_uom_crnv");
			$result'code' 	= "02";
			$result''message''	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array(id=>$var),"tr_uom_crnv");
			$result'code' 	= "03";
			$result''message''	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post(id);
			$data =  array(
				"active"	=> $this->input->post(active)				
			);			
			$this->mgeneral->update(array(id=>$i),$data,"tr_uom_crnv");
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

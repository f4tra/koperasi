<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Salesarea extends Admin_Controller 
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
		$query = $this->db->query("
			select
				a.id as id,
				a.code as code,
				a.name as name,
				a.active as active,
				a.descr as descr,
				b.name as parent_id
			from tr_sales_area a
				left join tr_sales_area b on b.id = a.parent_id
			")->result();	
		
		$this->data['data'] = $query;
		$this->template->build('sales_area_view/index');
	}
	
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data['parent_id']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_sales_area");
		if(!isset($id)){
			$this->template->build('sales_area_view/add');
		}else{
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_sales_area");
			$this->template->build('sales_area_view/edit');
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
				"parent_id"	=> $this->input->post('parent_id')
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_sales_area");			
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
				"parent_id"	=> $this->input->post('parent_id')
			);		
			$this->mgeneral->save($data,"tr_sales_area");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_sales_area");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_sales_area");
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

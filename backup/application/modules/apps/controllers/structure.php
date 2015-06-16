<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Structure extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}
	/*function _remap($method)
	{
  		if (method_exists($this, $method))
  		{
    		$this->$method();
    		
  		}
  		else{
    		$this->index($method);
    		
  		}
	}*/	
	function index($idx='')
	{		
		$this->data['id'] = $idx;
		$this->template->build('structure/index');
	}
	
	function load($or_type = ''){
		$edit	= site_url('apps/structure/form/'.$or_type.'/$1');		
		$link	= '	<a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,
			a.name as name,
			a.active as active,
			b.name as parent_id,
			c.name as stc_id,
			d.name as div_id,
			a.descr as descr,			
			');		
		
		$this->datatables->from('tr_hr_org a');
		$this->datatables->join('tr_hr_org b','b.id = a.parent_id','left');
		$this->datatables->join('tr_hr_org c','c.id = a.stc_id','left');
		$this->datatables->join('tr_hr_org d','d.id = a.div_id','left');
		$this->datatables->add_column('show',$link, 'id');
		$this->datatables->where('a.or_type_id', $or_type);
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($or_type = '',  $id = null)
	{		
		$this->data['or_type']	= $or_type;
		$this->data['parent_id']= $this->mgeneral->GetWhere(array('or_type_id'=>$or_type),"tr_hr_org");
		$this->data['hr_div']	= $this->mgeneral->GetWhere(array('or_type_id'=>1),"tr_hr_org");
		$this->data['hr_stc']	= $this->mgeneral->GetWhere(array('or_type_id'=>2),"tr_hr_org");
		$this->data['hr_fnc']	= $this->mgeneral->GetWhere(array('or_type_id'=>3),"tr_hr_org");
		$this->data['pic']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");			
		if(!isset($id)){
			$this->template->build('structure/add');
		}else{
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_hr_org");
			$this->template->build('structure/edit');
		}
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute($type = '',$id = '')
	{
		
		$result = array();
		if($type == "update")
		{
			$data =  array(
			"code"		=> $this->input->post('code'),
			"name"		=> $this->input->post('name'),
			"descr"		=> $this->input->post('descr'),
			"active"	=> $this->input->post('active'),			
			"parent_id"	=> $this->input->post('parent_id'),
			"user_id"	=> $this->input->post('pic'),			
  			"stc_id" 	=> $this->input->post('stc_id'),
  			"div_id" 	=> $this->input->post('div_id'),
  			"fnc_id" 	=> $this->input->post('fnc_id'),
  			"wf_type_id"=> $this->input->post('wf_type_id'),
  			"p_left"	=> $this->input->post('p_left'),
  			"p_top"		=> $this->input->post('p_top'),
  			"p_width"	=> $this->input->post('p_width'),
  			//"or_type_id"=> $this->input->post('or_type_id'),
  			"link"		=> $this->input->post('link'),
  			"tab"		=> $this->input->post('tab'),
  			"durr"		=> $this->input->post('durr'),
  			"icons"		=> $this->input->post('icons'),
			);	
			//print_r($data);
			//print_r($_POST);
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_hr_org");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";

		}
		else if ($type == "save")
		{			
			$data =  array(
			"code"		=> $this->input->post('code'),
			"name"		=> $this->input->post('name'),
			"descr"		=> $this->input->post('descr'),
			"active"	=> $this->input->post('active'),			
			"parent_id"	=> $this->input->post('parent_id'),
			"user_id"	=> $this->input->post('pic'),			
  			"stc_id" 	=> $this->input->post('stc_id'),
  			"div_id" 	=> $this->input->post('div_id'),
  			"fnc_id" 	=> $this->input->post('fnc_id'),
  			"wf_type_id"=> $this->input->post('wf_type_id'),
  			"p_left"	=> $this->input->post('p_left'),
  			"p_top"		=> $this->input->post('p_top'),
  			"p_width"	=> $this->input->post('p_width'),
  			"or_type_id"=> $this->input->post('or_type_id'),
  			"link"		=> $this->input->post('link'),
  			"tab"		=> $this->input->post('tab'),
  			"durr"		=> $this->input->post('durr'),
  			"icons"		=> $this->input->post('icons'),
			);	
		$this->mgeneral->save($data,"tr_hr_org");
		$result['code'] 	= "02";
		$result['message']	= "Save Sukses";	
		}
		else if ($type=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_hr_org");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($type == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_hr_org");
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

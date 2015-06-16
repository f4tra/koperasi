<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Ajax extends Admin_Controller 
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
		//$this->template->build('workflows/index_pg');
	}


	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	/*function push_point(){
		$source = $this->input->post('source');
		$target = $this->input->post('target');
		$code = $this->input->post('code');
		$type = $this->input->post('type');
		$data = array(
				'from_id'=>ltrim($source,"c"),
				'to_id'=>ltrim($target,"c"),
				'code'=>$code,
				'reff_id'=>$type,
			);
		$this->mgeneral->save($data,'tr_wf_cnt');

	}*/
	function push(){
		$source = $this->input->post('source');
		$target = $this->input->post('target');
		$code = $this->input->post('code');
		$type = $this->input->post('type');
		$loop 	= $this->mgeneral->getRow(array('code'=>$code),'tr_wf_cnt');
		if(empty($loop)){
			$data = array(
				'from_id'=>$source,
				'to_id'=>$target,
				'code'=>$code,
				'group_id'=>$type,
			);
			$this->mgeneral->save($data,'tr_wf_cnt');
			$data_update = array('parent_id'=>$source);
			$this->mgeneral->update(array('id'=>$target),$data_update,"tr_wf");
		}else{
			
		}
	}
	function push_dragble(){
		$left = $this->input->post('p_left') / 10;
		$top = $this->input->post('p_top') / 10;
		$data =  array(
			'p_left'=>$left,
			'p_top'=>$top
		);
		$id = $this->input->post('id');
		$this->mgeneral->Update(array('id'=>$id),$data,"tr_wf");
	}
	function delete(){
		$result = array();
		$var = $this->input->post('data_id');
		$this->mgeneral->delete(array('id'=>$var),"tr_wf");
		$result['code'] 	= "03";
		$result['message']	= "Delete Sukses";
		echo json_encode($result);
	}
	function edit(){
		$result = array();
		$id = $this->input->post('id');
		$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"caption"	=> $this->input->post('caption'),				
				"link"		=> $this->input->post('link'),
				"descr"		=> $this->input->post('descr'),
				"parameter_a"=> $this->input->post('parameter_a'),
				"parameter_b"=> $this->input->post('parameter_b'),
				"parameter_c"=> $this->input->post('parameter_c'),
				"parameter_d"=> $this->input->post('parameter_d'),
				"parameter_e"=> $this->input->post('parameter_e'),	
			);
		$this->mgeneral->Update(array('id'=>$id),$data,"tr_wf");			
		$result['code'] 	= "01";
		$result['message']	= "Update Sukses";
		echo json_encode($result);
	}

	function push_con_update(){
		$var = $this->input->post('code');
		$data =  array(
			'name'=>$this->input->post('name'),
			'descr'=>$this->input->post('descr'),
		);
		$this->mgeneral->update(array('code'=>$var),$data,"tr_wf_cnt");
	}
	function push_con_del(){
		$var = $this->input->post('code');
		$this->mgeneral->delete(array('code'=>$var),"tr_wf_cnt");
	}
	/*
	* end method and funtion execute draw
	*/
	function load_pt(){
		$edit	= site_url('workflow/prosestype/form/$1');		
		$link	= '	<a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.icons as icons,
			a.code as code,
			a.name as name,
			a.active as active,
			b.name as parent_id,		
			');		
		
		$this->datatables->from('tr_wf_type a');
		$this->datatables->join('tr_wf_type b','b.id = a.parent_id','left');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
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
				"active"	=> $this->input->post('active'),			
				"parent_id"	=> $this->input->post('parent_id'),
				"caption"	=> $this->input->post('caption'),
				
			);
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_wf");			
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
				"link"		=> $this->input->post('link'),
				"parent_id"	=> $this->input->post('parent_id'),
				"caption"	=> $this->input->post('caption'),
				"icons"		=> $this->input->post('icon'),
				"or_type_id"=> $this->input->post('or_type_id'),
			
				"p_left"	=> 5,			
				"p_top"		=> 5,			
				"p_width"	=> 5,			
			);
			$r = $this->mgeneral->save($data,"tr_wf");
			$this->mgeneral->Update(array('id'=>$r),array('group_id'=>$r),"tr_wf");	
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method == "save_detail")
		{			
			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),			
				"group_id"	=> $this->input->post('group'),
				"parent_id"	=> $this->input->post('parent_id'),
				"caption"	=> $this->input->post('caption'),
				"icons"		=> $this->input->post('icon'),
				"or_type_id"=> $this->input->post('or_type_id'),
				
				"p_left"	=> 5,			
				"p_top"		=> 5,			
				"p_width"	=> 5,			
			);
			$this->mgeneral->save($data,"tr_wf");
		
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_wf");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_wf");
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
	function execute_pt($method = '',$id = '')
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
				"icons"		=> $this->input->post('icon'),
			);
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_wf_type");			
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
				"icons"		=> $this->input->post('icon'),			
			);
			$this->mgeneral->save($data,"tr_wf_type");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_wf_type");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_wf_type");
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

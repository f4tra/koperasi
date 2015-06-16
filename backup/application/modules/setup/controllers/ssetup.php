<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Ssetup extends Admin_Controller 
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
		$this->template->build('ssetup/index');
	}
	function load(){

		$edit	= site_url('setup/ssetup/form/$1');
		$treeview	= site_url('setup/ssetup/widget_a/$1');					
		$link	= '	<a title="Tree View" class="btn btn-purple btn-m" href="'.$treeview.'"><i class="fa fa-sitemap"></i></a> 
					<a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,
			a.name as name,
			a.active as active,
			a.durr as durr,
			a.descr as descr,
			b.name as parent_id,
			c.name as type_id,
			a.p_top as p_top,
			a.p_width as p_width,
			a.p_left as p_left
			');		
		
		$this->datatables->from('tr_wf_reff a');
		$this->datatables->join('tr_wf_reff b','b.id = a.parent_id','left');
		$this->datatables->join('tr_wf_type c','c.id = a.type_id','left');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		if(!isset($id)){
			$this->data['data']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_wf_reff");
			$this->data['type']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_wf_type");
			$this->template->build('ssetup/add');
		}else{
			$this->data['data']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_wf_reff");
			$this->data['type']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_wf_type");
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_wf_reff");
			$this->template->build('ssetup/edit');
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
				"p_left"	=> $this->input->post('left'),
				"p_top"		=> $this->input->post('top'),
				"p_width"	=> $this->input->post('width'),
				"coa_id"	=> $this->input->post('coa_id'),
				"durr"		=> $this->input->post('durr'),
				"user_id"	=> $this->input->post('user_id'),
			);		
			
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_wf_reff");			
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
				"p_left"	=> $this->input->post('left'),
				"p_top"		=> $this->input->post('top'),
				"p_width"	=> $this->input->post('width'),
				"coa_id"	=> $this->input->post('coa_id'),
				"durr"		=> $this->input->post('durr'),
				"user_id"	=> $this->input->post('user_id'),
			);		
			$this->mgeneral->save($data,"tr_wf_reff");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_wf_reff");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_wf_reff");
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
	function widget_a($id=''){
		$this->data['data']	= $this->mgeneral->GetWhere(array('parent_id'=>$id),"tr_wf_reff");
		$this->data['type']	= $this->mgeneral->GetRow(array('id'=>$this->data['data'][0]->type_id),"tr_wf_type");
			$this->data['cnt']	= $this->mgeneral->Getwhere(array('reff_id'=>$id),"tr_wf_cnt");
		$this->template->build('ssetup/widget_a');
	}

	function push(){
		$source = $this->input->post('source');
		$target = $this->input->post('target');
		$code = $this->input->post('code');
		$type = $this->input->post('type');
		$loop 	= $this->mgeneral->getRow(array('from_id'=>$source,'to_id'=>$target),'tr_wf_cnt');
		//print_r($loop);
		if(empty($loop)){
			$data = array(
				'from_id'=>$source,
				'to_id'=>$target,
				'code'=>$code,
				'reff_id'=>$type,
			);
			$this->mgeneral->save($data,'tr_wf_cnt');
			
		}else{
			
		}
	}
	function push_dragble(){
		$left = $this->input->post('p_left') / 10;
		$top = $this->input->post('p_top') / 10;
		$data =  array(
			'p_left'=>$left,
			'p_top'=>$top
			//'p_left'=>$this->input->post('p_top'),
		);
		$id = $this->input->post('id');
		$this->mgeneral->Update(array('id'=>$id),$data,"tr_wf_reff");
	}
	function push_con_del(){
		$var = $this->input->post('code');
		$this->mgeneral->delete(array('code'=>$var),"tr_wf_cnt");
	}
	function detail_chart($ids){
		$this->data['data']	= $this->mgeneral->GetWhere(array('parent_id'=>$ids),"tr_wf_reff");
		echo "<pre>";
		print_r($this->data['data']);
	}
	function connector($code =''){
		$this->data['data']	= $this->mgeneral->GetRow(array('code'=>$code),"tr_wf_cnt");
		print_r($this->data['data']);
	}
}

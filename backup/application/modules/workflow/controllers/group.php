<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Group extends Admin_Controller 
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
		$this->data['apps']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_apps");
		$this->data['data']	= $this->mgeneral->GetWhere(array('or_type_id'=>1),"tr_wf");
		$this->data['cnt']	= '';//$this->mgeneral->GetWhere(array('actor_id'=>1),"tr_wf_cnt");
		$this->template->build('workflows/index_pg');
	}
	function detail($idx){
		$this->data['apps']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_apps");
		$this->data['data']	= $this->mgeneral->GetWhere(array('group_id'=>$idx),"tr_wf");
		
		$this->data['cnt']	= $this->mgeneral->GetWhere(array('group_id'=>$idx),"tr_wf_cnt");
		$this->template->build('workflows/index_pg_detail');
	}
	function flowchart($idx){
		$this->data['apps']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_apps");
		$this->data['data']	= $this->mgeneral->GetWhere(array('group_id'=>$idx),"tr_fc");		
		$this->data['cnt']	= $this->mgeneral->GetWhere(array('group_id'=>$idx),"tr_fc_cnt");
		$this->template->build('workflows/flowchart');
	}	
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data['or_type_id'] =  1;
		$this->data['data']	= $this->mgeneral->GetWhere(array('active'=>1,'or_type_id'=>1),"tr_wf");
		if(!isset($id)){
			$this->template->build('workflows/add_pg');
		}else{
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_wf");
			$this->template->build('workflows/edit_pg');
		}
	}
	
	
}

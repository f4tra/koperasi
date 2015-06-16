<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Event extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index($idx ='')
	{		
		if($idx == '')
			$this->data['data']	= $this->mgeneral->GetWhere(array('or_type_id'=>4),"tr_wf");		
		else
			$this->data['data']	= $this->mgeneral->GetWhere(array('or_type_id'=>4,"parent_id"=>$idx),"tr_wf");		
		$this->data['cnt']	= $this->mgeneral->GetAll("tr_wf_cnt");
		$this->template->build('workflows/index_e');
	}	
	function details($idx ='')
	{		
		if($idx == '')
			$this->data['data']	= $this->mgeneral->GetWhere(array('or_type_id'=>5),"tr_wf");		
		else
			$this->data['data']	= $this->mgeneral->GetWhere(array('or_type_id'=>5,"parent_id"=>$idx),"tr_wf");		
		$this->data['cnt']	= $this->mgeneral->GetAll("tr_wf_cnt");
		$this->template->build('workflows/index_e_detail');
	}	
	
	
	
}

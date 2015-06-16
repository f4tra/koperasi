<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Proses extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index($idx= '')
	{		
		if($idx == '')
			$this->data['data']	= $this->mgeneral->GetWhere(array('or_type_id'=>3),"tr_wf");		
		else
			$this->data['data']	= $this->mgeneral->GetWhere(array('or_type_id'=>3,"group_id"=>$idx),"tr_wf");		
		$this->data['cnt']	= $this->mgeneral->GetAll("tr_wf_cnt");
		$this->template->build('workflows/index_p');
	}
}

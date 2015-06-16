<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Prosestype extends Admin_Controller 
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
		
		$this->data['uri'] =  'workflow/prosestype/form';		
		$this->template->build('workflows/index_pt');
	}	
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data['or_type_id'] =  1;
		$this->data['data']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_wf_type");
		if(!isset($id)){
			$this->template->build('workflows/add_pt');
		}else{
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_wf_type");
			$this->template->build('workflows/edit_pt');
		}
	}
	
	
}

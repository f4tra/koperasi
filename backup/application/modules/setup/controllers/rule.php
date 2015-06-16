<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Rule management controller
 * 
 * @package App
 * @category Controller
 * @author 
 */
class Rule extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();		
	}
	
	function index()
	{
		$this->template->build('screen-rules/rule-index');
	}
	function load(){
		$edit	= site_url('setup/rule/edit/$1');		
		$link	= '
					<a  title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  
				  ';		
		$this->datatables->select('
			tr_gui.name as name,
			tr_role.name as name_role,
			tr_role_gui.id as id,
			tr_role_gui.active as active
			');	
		
		$this->datatables->join('tr_role','tr_role.id = tr_role_gui.role_id');
		$this->datatables->join('tr_gui','tr_gui.id = tr_role_gui.gui_id');
		$this->datatables->from('tr_role_gui');
		
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Add a new . 
	 */
	function add()
	{
		$this->data['role']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_role");
		$this->data['gui']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_gui");		
		$this->template->build('screen-rules/rule-add');
	}
	
	/**
	 * Edit 
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->data['role']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_role");
		$this->data['gui']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_gui");	
		$this->data['edit']	= $this->mgeneral->getWhere(array('id'=>$id),"tr_role_gui");
		$this->template->build('screen-rules/rule-edit');
	}
	/**
	 * View 
	 * 
	 * @param integer $id 
	 */
	function view($id)
	{
		$this->data['parent']	= $this->mgeneral->getAll("tr_role_gui");
		$this->template->build('screen-rules/rule-add');
	}
	function execute($method = '',$id = '')
	{
		$result = array();
		if($method == "update")
		{
			$data =  array(
				"role_id"	=> $this->input->post('role_id'),
				"gui_id"	=> $this->input->post('gui_id'),				
				"active"	=> $this->input->post('active'),
				"name"	=> $this->input->post('name')

			);
			$this->mgeneral->update(array('id'=>$id),$data,"tr_role_gui");
			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$data =  array(
				"role_id"	=> $this->input->post('role_id'),
				"gui_id"	=> $this->input->post('gui_id'),
				"active"	=> $this->input->post('active'),
				"name"	=> $this->input->post('name'),
								
			);			
			$this->mgeneral->save($data,"tr_role_gui");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_role_gui");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_role_gui");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else
		{
			$result['code'] 	= "04";
			$result['message']	= "Unmethod";
		}
		echo json_encode($result);
	}	
	
}


/* End of file rule.php */
/* Location: ./application/modules/acl/controllers/rule.php */
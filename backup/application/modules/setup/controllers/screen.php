<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Screen controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Screen extends Admin_Controller 
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
		//$this->data['root'] = $this->mgeneral
		$this->template->build('screen-rules/screen-index');
	}
	function load(){
		$edit	= site_url('setup/screen/edit/$1');		
		$link	= '
					<a  title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  
				  ';		
		
		$this->datatables->select('
			t1.id as id,
			t1.code as code, 
			t1.name as name,
			t1.caption as caption,
			t1.link as link,
			t1.active as active,
			t2.name as parent

			');				
		$this->datatables->from('tr_gui t1');
		$this->datatables->join('tr_gui t2','t2.id = t1.parent_id','left');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	
	/**
	 * Add a new . 
	 */
	function add()
	{
		$this->data['parent']= $this->mgeneral->getAll("tr_gui");
		$this->template->build('screen-rules/screen-add');
	}
	
	/**
	 * Edit 
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		
		$this->data['edit']	= $this->mgeneral->getWhere(array('id'=>$id),"tr_gui");
		$this->data['parent']	= $this->db->query("select * from tr_gui where id<>$id")->result();
		$this->template->build('screen-rules/screen-edit');
	}
	/**
	 * View 
	 * 
	 * @param integer $id 
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
				"caption"	=> $this->input->post('caption'),
				"link"		=> $this->input->post('link'),
				"active"	=> $this->input->post('active'),
				"parent_id"	=> $this->input->post('parent'),
				"icons"		=> $this->input->post('icon')
				
			);
			$this->mgeneral->update(array('id'=>$id),$data,"tr_gui");
			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"caption"	=> $this->input->post('caption'),
				"link"		=> $this->input->post('link'),
				"active"	=> $this->input->post('active'),
				"parent_id"	=> $this->input->post('parent'),
				"icons"		=> $this->input->post('icon')				
			);			
			$this->mgeneral->save($data,"tr_gui");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method == "delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_gui");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_gui");
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


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
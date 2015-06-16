<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Component extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
		$this->load->helper('my');
	}	
	function index()
	{
		$this->template->build('component/index');
	}
	function load(){
		$edit	= site_url('object/component/form/$1');		
		$link	= '	<a  title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		
		$this->datatables->select('
			u.id as id,
			u.code as code,
			u.name as name,
			u.descr as descr,
			u.active as active,
			s.parent_id as parent_id,
			d.name as category
		');
		
		$this->datatables->from('component u');		
		$this->datatables->join('component s','u.id = s.id','left');		
		$this->datatables->join('component_def d','d.id = u.category_id','left');		
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	function form($id = '')
	{		
		$this->data['parent']	= $this->mgeneral->GetWhere(array('active'=>1),"component");
		$this->data['category']	= $this->mgeneral->GetWhere(array('active'=>1,'f'=>1),"component_def");
		if(empty($id)){
			$this->data['id']		= '';
			$this->data['code']		= '';
			$this->data['name'] 	= '';
			$this->data['descr']	= '';
			$this->data['parent_id']= '';
			$this->data['category_id']	= '';
			$this->data['tablename']	= '';
			$this->data['active'] 	= '';
			$this->data['method']	= "save";
			$this->template->build('object/component/form');
		}else{			
			$data	= $this->mgeneral->GetRow(array('id'=>$id),"component");
			$this->data['attribute']	= $this->mgeneral->GetWhere(array('parent_id'=>$id),"component");
			
			$this->data['id']		= $data->id;
			$this->data['code']		= $data->code;
			$this->data['name'] 	= $data->name;
			$this->data['descr']	= $data->descr;
			$this->data['parent_id']= $data->parent_id;
			$this->data['category_id']	= $data->category_id;
			$this->data['tablename']	= $data->tablename;
			$this->data['active'] 	= $data->active;
			$this->data['method']		= "update";
			$this->template->build('object/component/form');
		}
	}
	
	function execute()
	{		
		$result = array();
		$method =  $this->input->post("method");
		$id 	=  $this->input->post("id");
		if($method == "update")
		{
			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"parent_id"	=> $this->input->post('parent_id'),				
				"active"	=> $this->input->post('active'),
				"tablename"	=> $this->input->post('tablename'),
			);
			
			$this->mgeneral->update(array('id'=>$id),$data,"component");
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),
				"descr"		=> $this->input->post('descr'),
				"parent_id"	=> $this->input->post('parent_id'),				
				"active"	=> $this->input->post('active'),
				"category_id"=> $this->input->post('category_id'),
			);		
			
			$this->mgeneral->save($data,"component");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"component");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		elseif($method == "active")
		{
			
			$data =  array(	"active"	=> $this->input->post('active')	);
			
			$this->mgeneral->update(array('id'=>$id),$data,"component");
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
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
/* Location: ./application/modules/object/controllers/object.php */
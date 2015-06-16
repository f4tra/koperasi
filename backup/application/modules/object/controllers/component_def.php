<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Component_def extends Admin_Controller 
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
	function index($f = '')
	{
		$this->data['f'] = $f;
		$this->template->build('component_def/index');
	}
	function load($idx){
		$edit	= site_url('object/component_def/form/'.$idx.'/$1');		
		$link	= '	<a  title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		if($idx == 3){
			$this->datatables->select('
				u.id as id,
				u.code as code,
				u.name as name,
				u.descr as descr,
				u.active as active,
				u.f as f,
				s.parent_id as parent_id,
				f1.name as f1,
				f2.name as f2,
			');
			
			$this->datatables->from('component_def u');		
			$this->datatables->join('component_def s','u.id = s.id','left');		
			$this->datatables->join('component_def f1','f1.id = u.f1','left');		
			$this->datatables->join('component_def f2','f2.id = u.f2','left');		
			$this->datatables->where('u.f',$idx);		
			$this->datatables->add_column('show',$link, 'id');		
			echo  $this->datatables->generate();
		}else{

			$this->datatables->select('
				u.id as id,
				u.code as code,
				u.name as name,
				u.descr as descr,
				u.active as active,
				u.f as f,
				u.f1 as f1,
				u.f2 as f2,
				s.parent_id as parent_id,
			');
			
			$this->datatables->from('component_def u');		
			$this->datatables->join('component_def s','u.id = s.id','left');		
			//$this->datatables->join('object o','o.id = s.f1','left');		
			$this->datatables->where('u.f',$idx);		
			$this->datatables->add_column('show',$link, 'id');		
			echo  $this->datatables->generate();
		}
	}
	function form($f='',$id = '')
	{		
		$this->data['f']		= $f;
		$this->data['parent']	= $this->mgeneral->GetWhere(array('active'=>1,'f'=>$f),"component_def");
		$this->data['f1_def']		= $this->mgeneral->GetWhere(array('active'=>1,'f'=>1),"component_def");
		$this->data['f2_def']		= $this->mgeneral->GetWhere(array('active'=>1,'f'=>2),"component_def");
		if(empty($id)){
			$this->data['id']		= '';
			$this->data['code']		= '';
			$this->data['name'] 	= '';
			$this->data['descr']	= '';
			$this->data['f1']		= '';
			$this->data['f2']		= '';
			$this->data['parent_id']= '';
			$this->data['active'] 	= '';
			$this->data['method']	= "save";
			$this->template->build('object/component_def/form');
		}else{			
			$data	= $this->mgeneral->GetRow(array('id'=>$id),"component_def");
			$this->data['id']		= $data->id;
			$this->data['code']		= $data->code;
			$this->data['name'] 	= $data->name;
			$this->data['descr']	= $data->descr;
			$this->data['f1']		= $data->f1;
			$this->data['f2']		= $data->f2;
			$this->data['parent_id']= $data->parent_id;
			$this->data['active'] 	= $data->active;
			$this->data['method']		= "update";
			$this->template->build('object/component_def/form');
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
				"f1"		=> $this->input->post('f1'),				
				"f2"		=> $this->input->post('f2'),				
				"f"	=> $this->input->post('f'),
			);
			
			$this->mgeneral->update(array('id'=>$id),$data,"component_def");
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
				"f1"		=> $this->input->post('f1'),				
				"f2"		=> $this->input->post('f2'),
				"f"			=> $this->input->post('f'),
			);		
			
			$this->mgeneral->save($data,"component_def");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"component_def");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		elseif($method == "active")
		{
			
			$data =  array(	"active"	=> $this->input->post('active')	);
			
			$this->mgeneral->update(array('id'=>$id),$data,"Component_def");
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
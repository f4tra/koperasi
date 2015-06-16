<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class User extends Admin_Controller 
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
		$this->template->build('role-user/user-index');
	}
	function load(){
		$edit	= site_url('setup/user/edit/$1');		
		$link	= '
					<a  title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  
				  ';		
		
		$this->datatables->select('
			u.id as id,
			u.code as code,
			u.username as username,
			u.first_name as first_name,
			u.mid_name as mid_name,
			u.last_name as last_name,
			u.active as active,
			r.name as rolename
			');
		
		$this->datatables->from('tr_user u');
		$this->datatables->join('tr_role r','r.id = u.role_id');
		//$this->datatables->join('tr_sys_workgroup g','g.id = u.group_id');
		
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Add a new . 
	 */
	function add()
	{
		$this->data['node']		= $this->mgeneral->GetWhere(array('active'=>1),'tr_node');
		
		$this->data['divisi']	= $this->mgeneral->GetWhere(array('active'=>1),'tr_hr_org','id','asc');
		$this->data['role']		= $this->db->query("select * from tr_role")->result();
		$this->template->build('role-user/user-add');
	}
	
	/**
	 * Edit 
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->data['node']		= $this->mgeneral->GetWhere(array('active'=>1),'tr_node');
		
		$this->data['divisi']	= $this->mgeneral->GetWhere(array('active'=>1),'tr_hr_div','id','asc');
		$this->data['role']		= $this->db->query("select * from tr_role")->result();
		$this->data['edit']		= $this->mgeneral->GetRow(array('id'=>$id),"tr_user");
		$this->template->build('role-user/user-edit');
	}
	/**
	 * View 
	 * 
	 * @param integer $id 
	 */
	function view($id)
	{
		$this->data['view']	= $this->mgeneral->getWhere(array('id'=>$id),"tr_user");
		$this->template->build('role-user/user-views');
	}
	function execute($method = '',$id = '')
	{		
		$result = array();
		if($method == "update")
		{
			$data =  array(
				"code"			=> $this->input->post('code'),
				"first_name"	=> $this->input->post('first_name'),
				"mid_name"		=> $this->input->post('mid_name'),
				"last_name"		=> $this->input->post('last_name'),
				"nick_name"		=> $this->input->post('nick_name'),
				"username"		=> $this->input->post('username'),				
				"email1"		=> $this->input->post('email'),
				"role_id"		=> $this->input->post('role_id'),				
				"node_id"		=> $this->input->post('node_id'),
				
				"div_id"		=> $this->input->post('divisi'),
				"active"		=> $this->input->post('active'),
				
			);
			$data2 =  array(
				"code"			=> $this->input->post('code'),
				"first_name"	=> $this->input->post('first_name'),
				"mid_name"		=> $this->input->post('mid_name'),
				"last_name"		=> $this->input->post('last_name'),
				"nick_name"		=> $this->input->post('nick_name'),
				"username"		=> $this->input->post('username'),
				"password"		=> $this->ci->passwordhash->HashPassword($this->input->post('password')),
				"email1"		=> $this->input->post('email'),
				"role_id"		=> $this->input->post('role_id'),				
				"node_id"		=> $this->input->post('node_id'),
				"div_id"		=> $this->input->post('divisi'),
				"active"		=> $this->input->post('active'),
				
			);
			if($this->input->post('password') == null){			
				$this->mgeneral->update(array('id'=>$id),$data,"tr_user");
			}else{
				$this->mgeneral->update(array('id'=>$id),$data2,"tr_user");
			}
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$code = sha1(md5(rand_string(6)));
			$data =  array(
				"code"			=> $this->input->post('code'),
				"first_name"	=> $this->input->post('first_name'),
				"mid_name"		=> $this->input->post('mid_name'),
				"last_name"		=> $this->input->post('last_name'),
				"nick_name"		=> $this->input->post('nick_name'),
				"username"		=> $this->input->post('username'),
				"password"		=> $this->ci->passwordhash->HashPassword($this->input->post('password')),
				"email1"		=> $this->input->post('email'),
				"role_id"		=> $this->input->post('role_id'),				
				"node_id"		=> $this->input->post('node_id'),
				"grp_id"		=> $this->input->post('wgroup'),
				"div_id"		=> $this->input->post('divisi'),
				"active"		=> $this->input->post('active'),
				
			);
			
			$this->mgeneral->save($data,"tr_user");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_user");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_user");
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
	function GetAcount(){
		//$this->load->database("ppob_dealer",true);
		//$this->mgeneraldealer->getAll("t_account")
		 
		$post = $this->input->post('account');
		$this->load->model("mgeneraldealer");
		$list = $this->mgeneraldealer->getAll("t_account");
		echo "<select class='form-control' name='kota' id='kota'>";
		foreach($list as $l){
			
			echo "<option value='".$l->ID."'>".$l->name."</option></select>";
		}
	}
}


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
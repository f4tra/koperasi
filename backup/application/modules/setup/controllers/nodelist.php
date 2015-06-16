<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Nodelist extends Admin_Controller 
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
		$this->template->build('node-list/index');
	}
	function load(){
		$edit	= site_url('setup/nodelist/edit/$1');		
		$link	= '	<a class="btn btn-success btn-xs" href="'.$edit.'"><i class="icon-pencil"></i>&nbsp;Edit</a> || 
					<button class="btn btn-danger btn-xs" data-id="$1" onclick="del(this);"><i class="fa fa-delete"></i>&nbsp;Delete</button>
				  ';		
		$this->datatables->select('
			tr_node.id as id,
			tr_node.code as code,
			tr_node.name as name,
			tr_node.gps_x as gpsx,
			tr_node.gps_y as gpsy,
			tr_node.active as active,
			tr_node_type.name as node_type,
			tr_node_category.name as node_category
			');
		
		$this->datatables->join('tr_node_type','tr_node_type.id = tr_node.node_type_id');
		$this->datatables->join('tr_node_category','tr_node_category.id = tr_node.category_id');
		$this->datatables->from('tr_node');
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Add a new . 
	 */
	function add()
	{		
		$this->template->build('role-user/user-add');
	}
	
	/**
	 * Edit 
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->data['role']	= $this->db->query("select * from tr_role where id <>'1' and active='1'")->result();
		$this->data['edit']	= $this->mgeneral->getWhere(array('id'=>$id,),"tr_user");
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
				"nick_name"		=> $this->input->post('nick_name'),
				"username"		=> $this->input->post('username'),
				//"passwd"		=> $this->ci->passwordhash->HashPassword($this->input->post('password')),
				"email1"		=> $this->input->post('email'),
				"role_id"			=> $this->input->post('role')
				
			);
			$data2 =  array(
				"nick_name"		=> $this->input->post('nick_name'),
				"username"		=> $this->input->post('username'),
				"passwd"		=> $this->ci->passwordhash->HashPassword($this->input->post('password')),
				"email1"		=> $this->input->post('email'),
				"role_id"		=> $this->input->post('role')
				
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
				"nick_name"		=> $this->input->post('nick_name'),
				"username"		=> $this->input->post('username'),
				"passwd"		=> $this->ci->passwordhash->HashPassword($this->input->post('password')),
				"email1"		=> $this->input->post('email'),
				"role_id"		=> $this->input->post('role'),
				//"active_login"	=> 1,
				//"active"		=> 2,
				
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
			
			echo "<option value='".$l->ID."'>".$l->NAMA."</option></select>";
		}
	}
}

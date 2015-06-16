<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Input proses magic
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Pembayaran extends Admin_Controller 
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
		$uid 	= $this->auth->userid();
		$this->data['user'] =  $this->mgeneral->getRow(array('id'=>$uid),'tr_user');
		if($uid == 1 or $this->data['user']->role_id==10){
			$query = $this->db->query("
				select
					a.id as id,
					a.code as code,				
					a.status_id as status,
					a.create_date as create_date,
					p.name as role_id
				from tt_purchasing a	
					left join tr_role p on p.id=a.role_id						
				where a.type_id = 1 and a.status_id = 4 or a.status_id = 0 or a.status_id = 6
				")->result();	
		}else{
			$query = $this->db->query("
				select
					a.id as id,
					a.code as code,				
					a.status_id as status,
					a.create_date as create_date,
					p.name as role_id				
				from tt_purchasing a	
					left join tr_role p on p.id=a.role_id						
				where a.type_id =1 and a.status_id = 3 or status_id =0 and role_id = '".$this->data['user']->role_id."'
				")->result();	
		}
		$this->data['data'] = $query;
		
		$this->template->build('pembayaran_view/index');		
	}
	function form($idx = ''){
		$uid 	= $this->auth->userid();
		$user =  $this->mgeneral->getRow(array('id'=>$uid),'tr_user');
		$this->data['item'] = $this->mgeneral->getWhere(array('active'=>1),'tr_item');

		$this->data['purchasing'] = $this->mgeneral->getRow(array('id'=>$idx),'tt_purchasing');
		$this->data['purchasing_detail'] = $this->mgeneral->getWhere(array('purchasing_id'=>$idx),'tt_purchasing_detail');
		$this->data['purchasing_detail_jum'] = $this->db->query("select sum(price*qty) as total,qty from tt_purchasing_detail where purchasing_id='".$idx."'")->row();
		if(empty($idx)){
			$this->db->like('id');
			$this->db->from('tt_purchasing');
			$this->db->where(array('role_id'=>$user->role_id,'type_id'=>1));
			$no = $this->db->count_all_results();
			$code = '';
			$banyak_nol = max(0,6 - strlen($no));
			$a = $no+1;
			$code .=str_repeat('0', $banyak_nol).$a;				
			$this->data['code'] = $code;
			$this->template->build('pembayaran_view/add');				
		}else{
			$this->template->build('pembayaran_view/form_detail');				

		}
	}
	public function detail($idx='')
	{
		$this->data['purchasing'] = $this->mgeneral->getRow(array('id'=>$idx),'tt_purchasing');
		$this->data['purchasing_detail'] = $this->mgeneral->getWhere(array('purchasing_id'=>$idx),'tt_purchasing_detail');
		$this->data['purchasing_detail_jum'] = $this->db->query("select sum(price*qty) as total,qty from tt_purchasing_detail where purchasing_id='".$idx."'")->row();
		$this->template->build('pembayaran_view/detail');				
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute($method = '',$id = '')
	{		
		$result = array();
		$uid 	= $this->auth->userid();
		$user =  $this->mgeneral->getRow(array('id'=>$uid),'tr_user');
		if($method == "save")
		{			
			$data =  array(
				"code"			=> $this->input->post('code'),				
				"create_date"	=> date('Y-m-d'),
				"status_id"		=> 0,
				"role_id"		=> $user->role_id,
				"type_id"		=> 1,
			);		
			$this->mgeneral->save($data,"tt_purchasing");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method == "update")
		{			
			$data =  array(
				"tgl_pembayaran"	=> $this->input->post('start_date'),
				"status_id"	=> $this->input->post('status_id'),
				
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"tt_purchasing");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";

		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tt_purchasing");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		elseif($method == "save_detail")
		{			
			$data =  array(
				"code"			=> $this->input->post('code'),				
				"purchasing_id"	=> $this->input->post('purchasing_id'),				
				"item_id"	=> $this->input->post('item'),
				"name"	=> $this->input->post('name'),
				"qty"	=> $this->input->post('qty'),
				"pcs"	=> $this->input->post('pcs'),
				"price"	=> $this->input->post('price'),
			);		
			$this->mgeneral->save($data,"tt_purchasing_detail");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		elseif($method == "update_detail")
		{			
			$idx= $this->input->post('id');
			$data =  array(
				"code"			=> $this->input->post('code'),				
				"purchasing_id"	=> $this->input->post('purchasing_id'),				
				"item_id"	=> $this->input->post('item_update'),
				"name"	=> $this->input->post('name_update'),
				"qty"	=> $this->input->post('qty'),
				"pcs"	=> $this->input->post('pcs'),
				"price"	=> $this->input->post('price'),
			);	
			$this->mgeneral->update(array('id'=>$idx),$data,"tt_purchasing_detail");
			
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
			
			
		}
		else if ($method=="delete_detail")
		{
			$var = $this->input->post('id');
			$this->mgeneral->delete(array('id'=>$var),"tt_purchasing_detail");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "approve")
		{
			$i= $this->input->post('id');
			$data =  array(
				"status_id"	=> $this->input->post('status')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tt_purchasing");
			$result['code'] 	= "04";
			$result['message']	= "Succes";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tt_purchasing");
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
	function grap(){
		$idx= $this->input->post('id');
		$item = $this->mgeneral->getRow(array('id'=>$idx),'tr_item');
		echo $item->name;
		
		
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Input proses magic
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Konfirmasi extends Admin_Controller 
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
		/*left join tt_finance_detail b on b.id = a.finance_id*/
		$uid 	= $this->auth->userid();
		$this->data['user'] =  $this->mgeneral->getRow(array('id'=>$uid),'tr_user');
		if($uid == 1 ){
			$query = $this->db->query("
				select
					a.id as id,
					a.code as code,				
					a.status_id as status,
					a.create_date as create_date,
					p.name as role_id,				
					b.name as parent_id				
				from tt_purchasing a	
					left join tr_role p on p.id=a.role_id						
					left join tt_purchasing b on b.parent_id=a.id			
				where a.type_id =2 or  a.status_id = 1 or a.status_id = 0
				")->result();	
		}
		elseif($this->data['user']->role_id == 11 ){
			$query = $this->db->query("
				select
					a.id as id,
					a.code as code,				
					a.status_id as status,
					a.create_date as create_date,
					p.name as role_id				
				from tt_purchasing a	
					left join tr_role p on p.id=a.role_id						
				where a.type_id =1 and a.status_id = 6
				")->result();	
					//b.name as parent_id				
					//left join tt_purchasing b on b.parent_id=a.id			
		}else{
			$query = $this->db->query("
				select
					a.id as id,
					a.code as code,				
					a.status_id as status,
					a.create_date as create_date,
					p.name as role_id,				
					b.code as parent_id				
				from tt_purchasing a	
					left join tr_role p on p.id=a.role_id						
					left join tt_purchasing b on b.id=a.parent_id						
				where a.status_id = 5 or a.status_id =0 and a.type_id = 2 and a.role_id = '".$this->data['user']->role_id."'
				")->result();	
		}
		$this->data['data'] = $query;
		
		$this->template->build('po_view/index');		
	}
	function form($idx = ''){
		$uid 	= $this->auth->userid();
		$user =  $this->mgeneral->getRow(array('id'=>$uid),'tr_user');
		$this->data['item'] = $this->mgeneral->getWhere(array('active'=>1),'tr_item');
		$this->data['pengadaan'] = $this->mgeneral->getWhere(array('type_id'=>1,'role_id'=>$user->role_id),'tt_purchasing');
		$this->data['purchasing'] = $this->mgeneral->getRow(array('id'=>$idx),'tt_purchasing');
		$this->data['purchasing_detail'] = $this->mgeneral->getWhere(array('purchasing_id'=>$idx),'tt_purchasing_detail');
		$this->data['purchasing_detail_jum'] = $this->db->query("select sum(price*qty) as total,qty from tt_purchasing_detail where purchasing_id='".$idx."'")->row();
		if(empty($idx)){
			$this->db->like('id');
			$this->db->from('tt_purchasing');
			$this->db->where(array('role_id'=>$user->role_id,'type_id'=>2));
			$no = $this->db->count_all_results();
			$code = 'PRC-';
			$banyak_nol = max(0,6 - strlen($no));
			$a = $no+1;
			$code .=str_repeat('0', $banyak_nol).$a;				
			$this->data['code'] = $code;
			$this->template->build('po_view/add');				
		}else{
			$this->data['gudang'] = $this->mgeneral->getWhere(array('parent_id'=>0),'tr_wherehouse');
			$this->data['rak'] = $this->db->query("select * from tr_wherehouse where parent_id > 0")->result();
			$this->template->build('po_view/form_detail');				

		}
	}
	public function detail($idx='')
	{
		$this->data['purchasing'] = $this->mgeneral->getRow(array('id'=>$idx),'tt_purchasing');
		$this->data['purchasing_detail'] = $this->mgeneral->getWhere(array('purchasing_id'=>$idx),'tt_purchasing_detail');
		$this->data['purchasing_detail_jum'] = $this->db->query("select sum(price*qty) as total,qty from tt_purchasing_detail where purchasing_id='".$idx."'")->row();
		$this->template->build('po_view/detail');				
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
				"type_id"		=> 2,
				"parent_id"		=>$this->input->post('parent_id'),
			);		
			$this->mgeneral->save($data,"tt_purchasing");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method == "update")
		{			
			$data =  array(
				"tgl_simpan"		=> $this->input->post('start_date'),
				"status_id"			=> 7,//$this->input->post('start_date'),
			);
			$jum = $this->input->post('jum');
			$i=1;
			for($i=1; $i<=$jum; $i++) {
				$data_item=array(
					'item_id'=>$this->input->post('item_id_'.$i),
					'gudang_id'=>$this->input->post('gudang_'.$i),
					'rak_id'=>$this->input->post('rak_'.$i),
					'qty_id'=>$this->input->post('qty_'.$i)
				);
				$cek = $this->mgeneral->getRow(array('item_id'=>$this->input->post('item_id_'.$i)),'tt_item');				
				if(count($cek) <= 0){
					$this->mgeneral->save($data_item,'tt_item');					
				}else{
					$this->mgeneral->Update(array('item_id'=>$this->input->post('item_id_'.$i)),$data_item,"tt_item");		
				}
			}		
			//$result['post'] 	= $data_item;
			
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
				"check"	=> $this->input->post('check_sesuai'),
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

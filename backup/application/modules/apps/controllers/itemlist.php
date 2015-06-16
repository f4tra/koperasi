<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Itemlist extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
		$this->load->library('upload');
		$this->load->helper('download');
		$this->load->helper('file');		
		
	}	
	function index($idx = '',$idx1 = '')
	{
		$this->data['p1'] = $idx;
		$this->data['p2'] = $idx1;
		$this->template->build('item/index');
	}
	function load($idx = '',$idx1 = ''){
		$edit	= site_url('apps/itemlist/form/$1/'.$idx);		
		//$chart	= site_url('apps/itemlist/chart/$1');		
		$link	= '	
					<a title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			cpn.name as issuer_id,
			b.name as parent,
			c.name as grp,
			d.name as ctg,
			e.name as type,
			a.p1_id as p1_id,
			');		
		$this->datatables->from('tr_item a');		
		$this->datatables->join('tr_item b','b.id = a.parent_id','left');
		$this->datatables->join('tr_item_grp c','c.id = a.grp_id','left');
		$this->datatables->join('tr_item_ctg d','d.id = a.ctg_id','left');
		$this->datatables->join('tr_item_type e','e.id = a.type_id','left');
		$this->datatables->join('tr_company cpn','cpn.id = a.issuer_id','left');
		$this->datatables->where('a.p1_id',$idx);
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();

	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = '',$idx='')
	{		
		$uri_uom =  json_decode(file_get_contents(base_url().'data/uom.php'));
		$this->data['p1'] = $idx;
		//$this->data['p1']
		if($id == 0){
			$this->data['ctg']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_ctg");
			$this->data['grade']	= $this->mgeneral->GetWhere(array('type_id'=>1),"tr_item_spc");
			$this->data['jenis']	= $this->mgeneral->GetWhere(array('type_id'=>2),"tr_item_spc");
			$this->data['ukuran']	= $this->mgeneral->GetWhere(array('type_id'=>3),"tr_item_spc");
			$this->data['gander']	= $this->mgeneral->GetWhere(array('type_id'=>4),"tr_item_spc");
			$this->data['bahan']	= $this->mgeneral->GetWhere(array('type_id'=>5),"tr_item_spc");
			$this->data['issuer']	= $this->mgeneral->GetAll("tr_company");
			$this->data['uom']		= $uri_uom;
			
			$this->template->build('item/add');
		}else{
			$this->data['edit']		= $this->mgeneral->GetRow(array('id'=>$id),"tr_item");
			$this->data['ctg']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_ctg");	
			$this->data['grp_id']	= $this->mgeneral->getRow(array('id'=>$this->data['edit']->grp_id),'tr_item_grp');
			$this->data['uom']		= $uri_uom;
			$this->data['type_id']	= $this->mgeneral->getRow(array('id'=>$this->data['edit']->type_id),'tr_item_type');
			$this->data['grade']	= $this->mgeneral->GetWhere(array('type_id'=>1),"tr_item_spc");
			$this->data['jenis']	= $this->mgeneral->GetWhere(array('type_id'=>2),"tr_item_spc");
			$this->data['ukuran']	= $this->mgeneral->GetWhere(array('type_id'=>3),"tr_item_spc");
			$this->data['gander']	= $this->mgeneral->GetWhere(array('type_id'=>4),"tr_item_spc");
			$this->data['bahan']	= $this->mgeneral->GetWhere(array('type_id'=>5),"tr_item_spc");
			$this->data['issuer']	= $this->mgeneral->getall("tr_company");
			$this->data['issuer_data']	= $this->mgeneral->GetRow(array('id'=>$this->data['edit']->issuer_id),"tr_company");
			$this->data['price_history']	= $this->data['rows_price'] = $this->db->query("select t.id,t.code,u.nick_name,t.price1,t.price2,t.price3,price4,t.start_date,t.end_date,u.address1 from tt_item t left join tr_user u on u.id = t.owner_id where t.item_id='".$this->data['edit']->id."'")->result();
			//$this->data['price_history']	= $this->mgeneral->GetWhere(array('item_id'=>$this->data['edit']->id),"tt_item");
			$this->template->build('item/edit');
		}
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute($method = '',$id = '')
	{		
		$result = array();
		if($method == "update")
		{
			$ctg		= $this->mgeneral->GetRow(array('id'=>$this->input->post('ctg')),"tr_item_ctg");			
			$config['upload_path'] = './uploader/product';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size']	= '10240';			
			$this->upload->initialize($config);		
			$this->upload->do_upload('userfile');
			if(!empty($ctg)){
				$a = $ctg->group_id;
				$b = $ctg->type_id;
				$c = $ctg->id;
			}else{
				$a = "";
				$b = "";
				$c = "";
			}
			if($ctg != null){

				$data =  array(
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),
					"grp_id"	=> $a,
					"type_id"	=> $b,
					"ctg_id"	=> $c,					
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"gps_x"		=> $this->input->post('gpsx'),
					"gps_y"		=> $this->input->post('gpsy'),
					"active"	=> $this->input->post('active'),					
					"dim1"	=> $this->input->post('dim1'),
					"dim2"	=> $this->input->post('dim2'),
					"dim3"	=> $this->input->post('dim3'),
					"x_id"	=> $this->input->post('grade'),
					"y_id"	=> $this->input->post('jenis'),
					"z_id"	=> $this->input->post('ukuran'),
					"spc_4"	=> $this->input->post('bahan'),
					"spc_5"	=> $this->input->post('gander'),
					"issuer_id"	=> $this->input->post('issuer'),
					//"filename" =>$_FILES['userfile']['name'],
					
					
				);				
			}else{
				$data =  array(
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),
					"grp_id"	=> $a,
					"type_id"	=> $b,
					"ctg_id"	=> $c,					
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"gps_x"		=> $this->input->post('gpsx'),
					"gps_y"		=> $this->input->post('gpsy'),
					"active"	=> $this->input->post('active'),
					"dim1"	=> $this->input->post('dim1'),
					"dim2"	=> $this->input->post('dim2'),
					"dim3"	=> $this->input->post('dim3'),
					"x_id"	=> $this->input->post('grade'),
					"y_id"	=> $this->input->post('jenis'),
					"z_id"	=> $this->input->post('ukuran'),
					"spc_4"	=> $this->input->post('bahan'),
					"spc_5"	=> $this->input->post('gander'),
					"issuer_id"	=> $this->input->post('issuer'),
					//"filename" =>$_FILES['userfile']['name'],
					
				);
			}	
			
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_item");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{				
			$config['upload_path'] = './uploader/product';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size']	= '10240';			
			$this->upload->initialize($config);		
			$this->upload->do_upload('userfile');
			
			$ctg		= $this->mgeneral->GetRow(array('id'=>$this->input->post('ctg')),"tr_item_ctg");
			if($ctg != null){

				$data =  array(
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),
					"grp_id"	=> $ctg->group_id,
					"type_id"	=> $ctg->type_id,
					"ctg_id"	=> $ctg->id,					
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"gps_x"		=> $this->input->post('gpsx'),
					"gps_y"		=> $this->input->post('gpsy'),
					"active"	=> $this->input->post('active'),
					"dim1"	=> $this->input->post('dim1'),
					"dim2"	=> $this->input->post('dim2'),
					"dim3"	=> $this->input->post('dim3'),
					"x_id"	=> $this->input->post('grade'),
					"y_id"	=> $this->input->post('jenis'),
					"z_id"	=> $this->input->post('ukuran'),
					"spc_4"	=> $this->input->post('bahan'),
					"spc_5"	=> $this->input->post('gander'),
					"issuer_id"	=> $this->input->post('issuer'),
					"filename" =>$_FILES['userfile']['name'],
					"p1_id" =>$this->input->post('p1'),
				);				
			}else{
				$data =  array(
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),
					"grp_id"	=> 0,
					"type_id"	=> 0,
					"ctg_id"	=> 0,					
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"gps_x"		=> $this->input->post('gpsx'),
					"gps_y"		=> $this->input->post('gpsy'),
					"active"	=> $this->input->post('active'),
					"dim1"	=> $this->input->post('dim1'),
					"dim2"	=> $this->input->post('dim2'),
					"dim3"	=> $this->input->post('dim3'),
					"x_id"	=> $this->input->post('grade'),
					"y_id"	=> $this->input->post('jenis'),
					"z_id"	=> $this->input->post('ukuran'),
					"spc_4"	=> $this->input->post('bahan'),
					"spc_5"	=> $this->input->post('gander'),
					"issuer_id"	=> $this->input->post('issuer'),
					"filename" =>$_FILES['userfile']['name'],
					"p1_id" =>$this->input->post('p1'),			
				);
			}			
			
			$this->mgeneral->save($data,"tr_item");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$file = $this->mgeneral->getRow(array('id' =>$var),'tr_item');
		
 			unlink("./uploader/product/$file->filename");
			$this->mgeneral->delete(array('id'=>$var),"tr_item");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"p1_id"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_item");
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
	function chart($id =''){
		//$this->data['idx'] = $id;		
		$this->data['rows_price'] = $this->db->query("select tt.id,tt.price1,tt.price2,tt.price3,tt.price4,tt.start_date,tt.end_date,tr.name from tt_item tt left join tr_item tr on tt.item_id=tr.id where tt.item_id='".$id."'")->result();
		
		$this->template->build('item/chart');
	}
}

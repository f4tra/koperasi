<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Entities extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index($ipo_id='')
	{
		$this->data['ipo_id'] = $ipo_id;
		$this->template->build('entities/index');
	}
	function load($ipo_id =''){
		$edit	= site_url('apps/entities/form/'.$ipo_id.'/$1');		
		$link	= '	<a title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			b.name as parent,
			c.name as grp,
			d.name as ctg,
			e.name as type
			');		
		$this->datatables->from('tr_company a');		
		$this->datatables->join('tr_company b','b.id = a.parent_id','left');
		$this->datatables->join('tr_node_grp c','c.id = a.grp_id','left');
		$this->datatables->join('tr_node_ctg d','d.id = a.ctg_id','left');
		$this->datatables->join('tr_node_type e','e.id = a.type_id','left');
		$this->datatables->where('a.ipo_id',$ipo_id);
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();

	}
	/**
	 * Form Add and Update. 
	 */
	function form($ipo_id = '',$id = null)
	{		
		$this->data['ipo_id'] = $ipo_id;
		if(!isset($id)){
			$this->data['ctg']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_ctg");
			$this->data['company']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_company");
			$this->data['user']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
			$this->template->build('entities/add');
		}else{
			$this->data['ctg']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_node_ctg");
			$this->data['company']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_company");
			$this->data['user']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
			$this->data['edit']		= $this->mgeneral->GetRow(array('id'=>$id),"tr_company");
			$this->data['grp_id']	= $this->mgeneral->getRow(array('id'=>$this->data['edit']->grp_id),'tr_node_grp');
			$this->data['type_id']	= $this->mgeneral->getRow(array('id'=>$this->data['edit']->type_id),'tr_node_type');
			$this->template->build('entities/edit');
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
			$ctg		= $this->mgeneral->GetRow(array('id'=>$this->input->post('ctg')),"tr_node_ctg");			
			if(!empty($ctg)){
				$a = $ctg->grp_id;
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
					"address1"	=> $this->input->post('address1'),
					"address2"	=> $this->input->post('address2'),
					"phone1"	=> $this->input->post('phone1'),
					"phone2"	=> $this->input->post('phone2'),
					"email1"	=> $this->input->post('email1'),
					"email2"	=> $this->input->post('email2'),
					"fax1"		=> $this->input->post('fax1'),
					"fax2"		=> $this->input->post('fax2'),
					"zip1"		=> $this->input->post('zip2'),
					"zip2"		=> $this->input->post('zip2'),
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"active"	=> $this->input->post('active'),
					"pic_id"	=> $this->input->post('user'),
					"ipo_id"	=> $this->input->post('ipo_id')			
				);				
			}else{
				$data =  array(
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),
					"grp_id"	=> $a,
					"type_id"	=> $b,
					"ctg_id"	=> $c,
					"address1"	=> $this->input->post('address1'),
					"address2"	=> $this->input->post('address2'),
					"phone1"	=> $this->input->post('phone1'),
					"phone2"	=> $this->input->post('phone2'),
					"email1"	=> $this->input->post('email1'),
					"email2"	=> $this->input->post('email2'),
					"fax1"		=> $this->input->post('fax1'),
					"fax2"		=> $this->input->post('fax2'),
					"zip1"		=> $this->input->post('zip2'),
					"zip2"		=> $this->input->post('zip2'),
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"active"	=> $this->input->post('active'),
					"pic_id"	=> $this->input->post('user'),
					"ipo_id"	=> $this->input->post('ipo_id')					
				);
			}	
			
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_company");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{				
			
			$ctg		= $this->mgeneral->GetRow(array('id'=>$this->input->post('ctg')),"tr_node_ctg");			
			if($ctg != null){

				$data =  array(
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),
					"grp_id"	=> $ctg->grp_id,
					"type_id"	=> $ctg->type_id,
					"ctg_id"	=> $ctg->id,
					"address1"	=> $this->input->post('address1'),
					"address2"	=> $this->input->post('address2'),
					"phone1"	=> $this->input->post('phone1'),
					"phone2"	=> $this->input->post('phone2'),
					"email1"	=> $this->input->post('email1'),
					"email2"	=> $this->input->post('email2'),
					"fax1"		=> $this->input->post('fax1'),
					"fax2"		=> $this->input->post('fax2'),
					"zip1"		=> $this->input->post('zip2'),
					"zip2"		=> $this->input->post('zip2'),
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"active"	=> $this->input->post('active'),
					"pic_id"	=> $this->input->post('user'),
					"ipo_id"	=> $this->input->post('ipo_id')					
				);				
			}else{
				$data =  array(
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),
					"grp_id"	=> 0,
					"type_id"	=> 0,
					"ctg_id"	=> 0,
					"address1"	=> $this->input->post('address1'),
					"address2"	=> $this->input->post('address2'),
					"phone1"	=> $this->input->post('phone1'),
					"phone2"	=> $this->input->post('phone2'),
					"email1"	=> $this->input->post('email1'),
					"email2"	=> $this->input->post('email2'),
					"fax1"		=> $this->input->post('fax1'),
					"fax2"		=> $this->input->post('fax2'),
					"zip1"		=> $this->input->post('zip2'),
					"zip2"		=> $this->input->post('zip2'),
					"parent_id"	=> $this->input->post('parent'),
					"descr"		=> $this->input->post('descr'),
					"active"	=> $this->input->post('active'),
					"pic_id"	=> $this->input->post('user'),
					"ipo_id"	=> $this->input->post('ipo_id')					
				);
			}			
			
			$this->mgeneral->save($data,"tr_company");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_company");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_company");
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

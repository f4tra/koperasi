<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Pricehistory extends Admin_Controller 
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
			
		$this->template->build('pricehistory/index');
	}
	function price_history($id =''){
		$this->data['idx'] = $id;
		$sql_statement = "
			select a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			a.item_id as item_id,
			b.name as parent,
			c.name as grp,
			d.name as ctg,
			e.name as type,
			y.code as ycode,
			y.name as yname,
			x.code as xcode,
			x.name as xname,
			z.code as zcode,
			z.name as zname,
			i.name as issuer
			

			from tt_item a
			left join tr_item b on b.id = a.item_id
			left join tr_item_grp c on c.id = b.grp_id
			left join tr_item_ctg d on d.id = b.ctg_id
			left join tr_item_type e on e.id = b.type_id
			left join tr_item_spc y  on y.id = b.spc1_id
			left join tr_item_spc x  on x.id = b.spc2_id
			left join tr_item_spc z  on z.id = b.spc3_id
			left join tr_company i  on i.id = a.owner_id			
		
			where a.item_id ='".$id."'
		";	
		$this->data['data_rows'] = $this->db->query($sql_statement)->row();
		
		$this->data['rows_price'] = $this->db->query("select id,price1,price2,price3,price4,start_date,end_date from tr_item_price where item_id='".$this->data['data_rows']->item_id."'")->result();
		$this->template->build('pricehistory/form_parsing');
	}
	
	function load($idx = ''){
		$edit	= site_url('unitstock/pricehistory/form/$1');		
		$link	= '	<a title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';		
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			a.price1 as price1,
			a.price2 as price2,
			a.price3 as price3,
			a.price4 as price4,
			a.start_date as start_date,
			a.end_date as end_date,
			b.name as item_name,
			c.name as grp,
			d.name as ctg,
			e.name as type,
			
			');		
		$this->datatables->from('tr_item_price a');		
		$this->datatables->join('tr_item b','b.id = a.item_id','left');
		$this->datatables->join('tr_item_grp c','c.id = b.grp_id','left');
		$this->datatables->join('tr_item_ctg d','d.id = b.ctg_id','left');
		$this->datatables->join('tr_item_type e','e.id = b.type_id','left');
		//$sql= $this->db->query("select count(item_id) as c from tr_item_price where ='".$idx."'")->row();
		if(!empty($idx)){
			$this->datatables->where('a.item_id', $idx); 
			
		}
		$this->datatables->add_column('show',$link, 'id');		
		echo $this->datatables->generate();

	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		
		if(!isset($id)){
			$this->data['item']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item");
			$this->template->build('pricehistory/add');
		}else{
			$this->data['item']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item");			
			$this->data['edit']		= $this->mgeneral->GetRow(array('id'=>$id),"tr_item_price");
			
			$this->template->build('pricehistory/edit');
		}
	}
	function form_parsing($id =''){
		$this->data['idx'] = $id;
		$this->data['item']		= $this->mgeneral->GetRow(array('id'=>$id),"tr_item");
		$this->template->build('pricehistory/form_parsing_add');
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
			$data =  array(
					//"code"		=> $this->input->post('code'),
					//"name"		=> $this->input->post('name'),
					"price1"	=> $this->input->post('price1'),
					"price2"	=> $this->input->post('price2'),
					"price3"	=> $this->input->post('price3'),
					"price4"	=> $this->input->post('price4'),
					"item_id"	=> $this->input->post('item'),
					"descr"		=> $this->input->post('descr'),
					"start_date"=> $this->input->post('start_date'),
					"end_date"	=> $this->input->post('end_date'),
					"active"	=> $this->input->post('active')					
				);
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_item_price");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";

		}
		else if ($method == "save")
		{				
			$data =  array(
					//"code"		=> $this->input->post('code'),
					//"name"		=> $this->input->post('name'),
					"price1"	=> $this->input->post('price1'),
					"price2"	=> $this->input->post('price2'),
					"price3"	=> $this->input->post('price3'),
					"price4"	=> $this->input->post('price4'),
					"item_id"	=> $this->input->post('item'),
					"descr"		=> $this->input->post('descr'),
					"start_date"=> $this->input->post('start_date'),
					"end_date"=> $this->input->post('end_date'),
					"active"	=> $this->input->post('active')					
				);
			
			$this->mgeneral->save($data,"tr_item_price");	
			
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_item_price");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_item_price");
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

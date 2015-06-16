<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Pricingpolice extends Admin_Controller 
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
	function index()
	{
		$this->data['data'] = $this->db->query("
			select 
			t.id as id,
			t.status_id as status,
			t.code as code,
			t.qty_id as qty,
			i.name as name,
			g.name as gudang,
			r.name as rak
			from tt_item t
			left join tr_item i on i.id = t.item_id
			left join tr_wherehouse g on g.id = t.gudang_id
			left join tr_wherehouse r on r.id = t.rak_id
			")->result();
		$this->template->build('pricing_view/index');
	}
	function form($idx=''){
		$this->data['edit']=$this->mgeneral->getRow(array('id'=>$idx),'tt_item');
		$this->template->build('pricing_view/form');
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute($id = '')
	{		
		$result = array();
		$data =  array(
			"price1"		=> $this->input->post('price1'),
			"price2"		=> $this->input->post('price2'),
			"price3"		=> $this->input->post('price3'),
			"price4"		=> $this->input->post('price4'),
			);
		$this->mgeneral->update(array('id'=>$id),$data,'tt_item');
		$result['message'] = "Update Success";
		echo json_encode($result);
	}	
	function chart($id =''){
		//$this->data['idx'] = $id;		
		$this->data['rows_price'] = $this->db->query("select tt.id,tt.price1,tt.price2,tt.price3,tt.price4,tt.start_date,tt.end_date,tr.name from tt_item tt left join tr_item tr on tt.item_id=tr.id where tt.item_id='".$id."'")->result();
		
		$this->template->build('item/chart');
	}
}

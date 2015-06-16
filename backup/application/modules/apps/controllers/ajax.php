<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Ajax extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index($method='')
	{		
		$result = array();
		switch ($method) {
			case 'save':
				$ipo_id 	= $this->input->post('ipo_id');
				$type_id 	= $this->input->post('type_id');
				if($ipo_id == 1){
					if($type_id >1){
						$parent_id 	= 0;
						$prev_id 	= $this->input->post('prev');
						$previpo_id	= 0;
					}else{
						$parent_id 	= 0;
						$prev_id 	= 0;
						$previpo_id	= 0;
					}
				}elseif ($ipo_id > 1) {
					if($type_id >1){
						$parent_id 	= 0;
						$prev_id 	= $this->input->post('prev');
						$previpo_id	= 0;
					}else{
						$prev_id 	= $this->input->post('prev');
						$parent_id	= 0;
						$previpo_id	= $this->input->post('prev');
					}
				}
				$data = array(
					'code'		=>$this->input->post('code'),
					'start_date'=>$this->input->post('start_date'),
					'descr'		=>$this->input->post('descr'),
					'active'	=>$this->input->post('active'),
					'type_id'	=>$type_id,
					'ipo_id'	=>$ipo_id,
					'prev_id'	=>$prev_id,
					'previpo_id'=>$previpo_id,
					'parent_id'	=>$parent_id,
				);
				$this->mgeneral->save($data,"tt_input");
				$result['test'] = $data;
				$result['retcode'] = 01;
				$result['message'] = "Simpan Berhasil";
				break;
			case 'update':
				# code...
				break;
			case 'delete':
				$id = $this->input->post('data_id');
				$this->mgeneral->delete(array('id'=>$id),"tt_input");
				break;
			case 'detail':
				break;
			case 'save_boom':
				$data = array(
					'company_id'=>0,
					'item_id'	=>$this->input->post('item'),
					'parent_id'	=>$this->input->post('idx'),
					'active_id'	=>1,
					'price1'	=>$this->input->post('price1'),
					'price2'	=>$this->input->post('price2'),
					'price3'	=>$this->input->post('price3'),
					'price4'	=>$this->input->post('price4'),
					'ipo_id'	=>$this->input->post('ipo_id'),
					'type_id'	=>$this->input->post('type_id'),
				);
				$this->mgeneral->save($data,"tt_input");
				break;
			default:
				# code...
				break;
		}
		echo json_encode($result);
	}
	function load($ipo_id ='',$type_id = ''){
		
		$result = array();
		$edit	= site_url('apps/input/index/edit/'.$ipo_id.'/'.$type_id.'/$1');		
		$link	= '	<button data-id-print="$1" onclick="print(this);" class="btn btn-purple btn-xs"><i class="fa fa-book"></i></button> <a title="Edit" class="btn btn-warning btn-xs" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-xs" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>';
			
		if ($type_id == 1) {
			
			
			$array = array('input.ipo_id' => $ipo_id, 'input.type_id' => $type_id,'input.parent_id'=>0);
			$this->datatables->where($array);
			if($ipo_id == 1 and $type_id >1){
				$this->datatables->join('tt_input f','f.id = input.prev_id','left');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id ==1){
				$this->datatables->join('tt_input f','f.id = input.previpo_id','left');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id > 1){
				$this->datatables->join('tt_input f','f.id = input.prev_id','left');
				$codes = 'f.code as code_2,';
			}else{
				$codes = '';
			}
			$this->datatables->select("
				input.id as id,
				input.start_date as start_date,
				input.code as code_1,
				".$codes."
				input.qty as qty,
				input.active as active,
				input.prev_id as prev_id,
				");
			$this->datatables->from('tt_input input');
			$this->datatables->add_column('show',$link, 'id');
		}
		else if($type_id > 1){
			$array = array('input.ipo_id' => intval($ipo_id), 'input.type_id' => intval($type_id),'input.parent_id'=>0,'input.prev_id <>'=>0);
			$this->datatables->where($array);
			if($ipo_id == 1 and $type_id >1){
				$this->datatables->join('tt_input f','f.id = input.prev_id','');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id ==1){
				$this->datatables->join('tt_input f','f.id = input.previpo_id','');
				$codes = 'f.code as code_2,';				
			}elseif($ipo_id > 1 and $type_id > 1){
				$this->datatables->join('tt_input f','f.id = input.prev_id','');
				$codes = 'f.code as code_2,';
			}else{
				$codes = '';
			}
			$this->datatables->select("
				input.id as id,
				input.start_date as start_date,
				input.code as code_1,
				".$codes."
				input.qty as qty,
				input.active as active,
				input.prev_id as prev_id,
				");
			$this->datatables->from('tt_input input');
			$this->datatables->add_column('show',$link, 'id');	
		}		
		echo  $this->datatables->generate();
	}
	function boom($act='',$ipo_id='',$type_id=''){
		$result =  array();
		switch ($act) {
			case 'save':
				$item = $this->input->post('item');
				$data_item = $this->mgeneral->getRow(array('id'=>$item),"tr_item");
				if (!$data_item) {
					$qty1	= $data_item->qty;
					$price1	= $data_item->price1;
				}else{
					$qty	= 0;
					$price1	= 0;
				}
				if($type_id >1)
					$price4 = 0;
				else
					$price4 = 0;
				if($price1 <> 0)
					$price3 = $price1 / $qty1;
				else
					$price3 = 0;
				$qty = $this->input->post('qty');
				$price2 = $qty * $price3;
				if($price3 <>"")
					$price3 =intval($price3);
				
				$data = array(
					'company_id'=> $this->input->post('company_id'),
					'item_id'	=> $this->input->post('item'),
					'parent_id'	=> $this->input->post('idx'),
					'active'	=> 1,
					'price1'	=> $data_item->price1,
					'price2'	=> $price2,
					'price3'	=> $price3,
					'price4'	=> $price4,
					'qty'		=> $qty,
					'ipo_id'	=>$this->input->post('ipo_id'),
					'type_id'	=>$this->input->post('type_id'),
					'start_date'=>$this->input->post('start_data'),
					'descr'		=>$this->input->post('descr'),
				);
				
				$this->mgeneral->save($data,"tt_input");
				$result['code']= $data;
				$result['message']= "Update Sukses";
				break;
			case 'edit':
				# code...
				break;
			
			default:
				# code...
				break;
		}
		echo json_encode($result);
	}
}

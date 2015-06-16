<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Ajax_proses extends Admin_Controller 
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
					'customer_id'=>$this->input->post('custom_id'),
				);
				$this->mgeneral->save($data,"tt_proses");
				$result['test'] = $data;
				$result['retcode'] = 01;
				$result['message'] = "Simpan Berhasil";
				break;
			case 'update':
				# code...
				break;
			case 'delete':
				$id = $this->proses->post('data_id');
				$this->mgeneral->delete(array('id'=>$id),"tt_proses");
				break;
			case 'detail':
				break;
			case 'vload':
				_load();
				break;
			default:
				# code...
				break;
		}
		echo json_encode($result);
	}
	function load($ipo_id ='',$type_id = ''){
		
		$result = array();
		$edit	= site_url('apps/proses/index/edit/'.$ipo_id.'/'.$type_id.'/$1');		
		$link	= '	<button data-id-print="$1" onclick="print(this);" class="btn btn-purple bnt-xs"><i class="fa fa-book"></i></button> <a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>';
			
		if ($type_id == 1) {
			
			
			$array = array('proses.ipo_id' => $ipo_id, 'proses.type_id' => $type_id,'proses.parent_id'=>0);
			$this->datatables->where($array);
			if($ipo_id == 1 and $type_id >1){
				$this->datatables->join('tt_proses f','f.id = proses.prev_id','left');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id ==1){
				$this->datatables->join('tt_proses f','f.id = proses.previpo_id','left');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id > 1){
				$this->datatables->join('tt_proses f','f.id = proses.prev_id','left');
				$codes = 'f.code as code_2,';
			}else{
				$codes = '';
			}
			$this->datatables->select("
				proses.id as id,
				proses.start_date as start_date,
				proses.code as code_1,
				".$codes."
				proses.qty as qty,
				proses.active as active,
				proses.prev_id as prev_id,
				");
			$this->datatables->from('tt_proses proses');
			$this->datatables->add_column('show',$link, 'id');
		}
		else if($type_id > 1){
			$array = array('proses.ipo_id' => intval($ipo_id), 'proses.type_id' => intval($type_id),'proses.parent_id'=>0,'proses.prev_id <>'=>0);
			$this->datatables->where($array);
			if($ipo_id == 1 and $type_id >1){
				$this->datatables->join('tt_proses f','f.id = proses.prev_id','');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id ==1){
				$this->datatables->join('tt_proses f','f.id = proses.previpo_id','');
				$codes = 'f.code as code_2,';				
			}elseif($ipo_id > 1 and $type_id > 1){
				$this->datatables->join('tt_proses f','f.id = proses.prev_id','');
				$codes = 'f.code as code_2,';
			}else{
				$codes = '';
			}
			$this->datatables->select("
				proses.id as id,
				proses.start_date as start_date,
				proses.code as code_1,
				".$codes."
				proses.qty as qty,
				proses.active as active,
				proses.prev_id as prev_id,
				");
			$this->datatables->from('tt_proses proses');
			$this->datatables->add_column('show',$link, 'id');	
		}		
		echo  $this->datatables->generate();
	}
}

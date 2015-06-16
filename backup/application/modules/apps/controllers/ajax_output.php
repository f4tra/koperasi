<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Ajax_output extends Admin_Controller 
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
					'active'	=>$this->input->post('active'),
					'descr'		=>$this->input->post('descr'),
					'type_id'	=>$type_id,
					'ipo_id'	=>$ipo_id,
					'prev_id'	=>$prev_id,
					'previpo_id'=>$previpo_id,
					'parent_id'	=>$parent_id,
				);
				$this->mgeneral->save($data,"tt_output");
				$result['test'] = $data;
				$result['retcode'] = 01;
				$result['message'] = "Simpan Berhasil";
				break;
			case 'update':
				# code...
				break;
			case 'delete':
				$id = $this->input->post('data_id');
				$this->mgeneral->delete(array('id'=>$id),"tt_output");
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
		$edit	= site_url('apps/output/index/edit/'.$ipo_id.'/'.$type_id.'/$1');		
		$link	= '	<button data-id-print="$1" onclick="print(this);" class="btn btn-purple bnt-xs"><i class="fa fa-book"></i></button> <a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>';
			
		if ($type_id == 1) {
			
			
			$array = array('output.ipo_id' => $ipo_id, 'output.type_id' => $type_id,'output.parent_id'=>0);
			$this->datatables->where($array);
			if($ipo_id == 1 and $type_id >1){
				$this->datatables->join('tt_output f','f.id = output.prev_id','left');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id ==1){
				$this->datatables->join('tt_output f','f.id = output.previpo_id','left');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id > 1){
				$this->datatables->join('tt_output f','f.id = output.prev_id','left');
				$codes = 'f.code as code_2,';
			}else{
				$codes = '';
			}
			$this->datatables->select("
				output.id as id,
				output.start_date as start_date,
				output.code as code_1,
				".$codes."
				output.qty as qty,
				output.active as active,
				output.prev_id as prev_id,
				");
			$this->datatables->from('tt_output output');
			$this->datatables->add_column('show',$link, 'id');
		}
		else if($type_id > 1){
			$array = array('output.ipo_id' => intval($ipo_id), 'output.type_id' => intval($type_id),'output.parent_id'=>0,'output.prev_id <>'=>0);
			$this->datatables->where($array);
			if($ipo_id == 1 and $type_id >1){
				$this->datatables->join('tt_output f','f.id = output.prev_id','');				
				$codes = 'f.code as code_2,';
			}elseif($ipo_id > 1 and $type_id ==1){
				$this->datatables->join('tt_output f','f.id = output.previpo_id','');
				$codes = 'f.code as code_2,';				
			}elseif($ipo_id > 1 and $type_id > 1){
				$this->datatables->join('tt_output f','f.id = output.prev_id','');
				$codes = 'f.code as code_2,';
			}else{
				$codes = '';
			}
			$this->datatables->select("
				output.id as id,
				output.start_date as start_date,
				output.code as code_1,
				".$codes."
				output.qty as qty,
				output.active as active,
				output.prev_id as prev_id,
				");
			$this->datatables->from('tt_output output');
			$this->datatables->add_column('show',$link, 'id');	
		}		
		echo  $this->datatables->generate();
	}
}

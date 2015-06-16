<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Input proses magic
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Output extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index($act = '',$ipo_id='',$type_id='',$id_edit='')
	{		
		switch ($type_id) {
			case 1:
				$type_name = "Intruksi Pesanan";
				break;
			case 2:
				$type_name = "Rencana";
				break;
			case 3:
				$type_name = "Pesanan";
				break;
			default:
				# code...
				break;
		}
		$type_id1 = $type_id-1;
		switch ($type_id1) {
			case 1:
				$type_name_one = "Pesanan Penjualan";
				break;
			case 2:
				$type_name_one = "Persiapan Pesanan";
				break;
			case 3:
				$type_name_one = "Kirim Pesanan";
				break;
			case 0:
				$type_name_one = "Persediaan";
				break;
			default:
				# code...
				break;
		}
		
		if(isset($type_name_one))$typename = $type_name_one; else $typename = '';
		if(isset($type_name)) $typename_first = $type_name; else $typename_first = '';
		$this->data['type_name']	= $typename_first;
		$this->data['type_name_one']= $typename;
		$this->data['type_id']		= $type_id;
		$this->data['type_id1']		= '';//$type_id1;
		$this->data['ipo_id'] 		= $ipo_id;
		//$this->data['ipo_id1'] 		= $ipo_id1;
		switch ($act) {
			case 'list':				
				$this->template->build('output/index');
				break;
			case 'add':
				$this->db->like('id');
				$this->db->from('tt_output');
				$this->db->where(array('ipo_id'=>$ipo_id,'type_id'=>$type_id));
				$no = $this->db->count_all_results();
				$code = '';
				$banyak_nol = max(0,6 - strlen($no));
				$a = $no+1;
				$code .=str_repeat('0', $banyak_nol).$a;				
				$this->data['code'] = $code;
				$this->template->build('output/add');
				break;
			case 'edit':
				$this->data['edit'] = $this->mgeneral->mgeneral->getRow(array('id'=>$id_edit),"tt_output");
				$this->template->build('output/edit');
				break;
			default:
				# code...
				break;
		}
		
	}
	
}

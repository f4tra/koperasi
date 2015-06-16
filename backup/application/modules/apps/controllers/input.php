<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Input proses magic
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Input extends Admin_Controller 
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
		
		switch ($ipo_id) {
			case 1:
				switch ($type_id) {
					case 1:
						$type_name = "Permohonan";
						break;
					case 2:
						$type_name = "Persetujuan";
						break;
					case 3:
						$type_name = "Pembelian";
						break;
					default:
						# code...
						break;
				}
				$type_id1 = $type_id-1;
		 		$ipo_id1 = $ipo_id-1;	
				switch ($type_id1) {
					case 1:
						$type_name_one = "Permohonan";
						break;
					case 2:
						$type_name_one = "Persetujuan";
						break;
					case 3:
						$type_name_one = "Pembelian";
						break;
					default:
						# code...
						break;
				}
				break;
			case 2:
				switch ($type_id) {
					case 1:
						$type_name = "Penerimaan";
						break;
					case 2:
						$type_name = "Pengeluaran";
						break;
					default:
						# code...
						break;
				}
				$type_id1 =$type_id-1;
		 		$ipo_id1 = $ipo_id-1;
		 		switch ($type_id1) {
					case 1:
						$type_name_one = "Penerimaan";
						break;
					case 2:
						$type_name_one = "Pengeluaran";
						break;
					case 0:
						$type_name_one = "pembelian";
						break;
					default:
						# code...
						break;
				}	
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
		$this->data['type_id1']		= $type_id1;
		$this->data['ipo_id'] 		= $ipo_id;
		$this->data['ipo_id1'] 		= $ipo_id1;
		switch ($act) {
			case 'list':				
				$this->template->build('input/index');
				break;
			case 'add':
				$this->db->like('id');
				$this->db->from('tt_input');
				$this->db->where(array('ipo_id'=>$ipo_id,'type_id'=>$type_id));
				$no = $this->db->count_all_results();
				$code = '';
				$banyak_nol = max(0,6 - strlen($no));
				$a = $no+1;
				$code .=str_repeat('0', $banyak_nol).$a;				
				$this->data['code'] = $code;
				$this->template->build('input/add');
				break;
			case 'edit':
				$this->data['idx'] =  $id_edit;
				$this->data['item'] = $this->mgeneral->getWhere(array('ipo_id'=>$ipo_id,'parent_id'=>$id_edit),"tr_item");
				$this->data['edit'] = $this->mgeneral->mgeneral->getRow(array('id'=>$id_edit),"tt_input");
				//print_r($this->data['edit']);
				$this->template->build('input/edit');
				break;
			default:
				# code...
				break;
		}
		
	}
	/*function jeff(){
		try{
			echo "jeff";
		}catch(){

		}
	}*/
}

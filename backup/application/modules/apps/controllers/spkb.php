<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Input proses magic
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Spkb extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index($act = '',$type_id='',$item='',/*$qty = ''*/,$id_edit='')
	{		
		$result =  array();
		/*if($qty <>'')
			$qty_val = intval($qty);
		else
			$qty_val = 0;*/
		switch ($act) {
			case 'add':
				# code...
				break;
			case 'edit':

				break;
			case 'save':
				$descr 	=  $this->input->post("descr");
				$qty 	=  $this->input->post("qty");
				$item_id=  $this->input->post("item_id");
				$lctnid3 =  $this->input->post("TxtLctnId3");
				$lctnid2 =  $this->input->post("TxtLctnId2");
				$lctnid1 =  $this->input->post("TxtLctnId1");
				if($qty <> 0){
					$qty = $qty;
					$qty1 = $qty;
					$qty2 = -1 *($qty);
				}
				$totalrs4 = 0;
				$totalrs3 = 0;
				$query = $this->mgeneral->getrow(array('loc_id'=>$lctnid1,'item_id'=>$item_id),"tt_item_loc");
				$totalrs3 = $query->qty;
				$totalrs4 = $totalrs4 + $totalrs3;
				if($totalrs4 < $qty){
					$result['code'] = 001;
					$result['message'] = "<h2> Maaf Jumlah Pengeluaran Lebih Besar Daripada Persediaan !</h2>";
				}else{				
					$data_1 = array(
						'item_id'=>$item_id,
						'loc_id'=>$lctnid1,
						'from_id'=>$lctnid1,
						'descr'=>$descr,
						'type_id'=>2,
					);
					$data_2 = array(
						'item_id'		=>$item_id,
						'loc_id'		=>$lctnid1,
						'to_companyid'	=>$lctnid1,
						'descr'			=>$descr,
						'qty_comp'		=>$qty1,
						'type_id'		=>3,
					);
					$this->mgeneral->save($data_2,'tt_item_loc');
				}
				break;
			case 'update':
				# code...
				break;
			default:
				# code...
				break;
		}
		
	}
}

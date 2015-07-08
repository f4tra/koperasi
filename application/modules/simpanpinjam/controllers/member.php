<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Menu controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Member extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->helper('tree');
	}	
	function index()
	{
		/*Load Parsing*/
		$js = $this->load->file('assets/beckend/my_js/my_tables.js',true);		
		$this->template			
			->set_js_script($js,'',true)
			->build('members/index');
	}
	function load(){		
		$this->datatables->select('
			t1.id as id,
			t1.nik as nik, 
			t1.fullname as fullname,			
			t1.active as active,
			t2.name as unit_name
		');				
		$this->datatables->from('tr_member t1');		
		$this->datatables->join('tr_unit t2','t2.id = t1.id_unit','left');		
		$this->datatables->add_column('show','', 'id');				
		echo  $this->datatables->generate();
	}
	
	/**
	 * Add a new . 
	 */
	function add()
	{
		$this->data['tr_unit'] 		= $this->mgeneral->getAll("tr_unit");		
		$this->template->build('members/add');	
	}
	
	/**
	 * Edit 
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->data['parsing']	= $this->mgeneral->getRow(array('id'=>$id),"tr_member");		
		$this->data['tr_unit'] 		= $this->mgeneral->getAll("tr_unit");		
		$this->template->build('members/edit');
		
	}
	/**
	 * View 
	 * 
	 * @param integer $id 
	 */
	
	function execute($method = '')
	{
		$result = array();
		if($method == "update")
		{
			$data =  array(
				"nik"		=> $this->input->post('nik'),
				"fullname"	=> $this->input->post('fullname'),
				"id_unit"	=> $this->input->post('unit'),
				"active"	=> $this->input->post('active')
			);
			$id = $this->input->post('id');			
			$this->mgeneral->update(array('id'=>$id),$data,"tr_member");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$data =  array(
				"nik"		=> $this->input->post('nik'),
				"fullname"	=> $this->input->post('fullname'),
				"id_unit"	=> $this->input->post('unit'),
				"active"	=> $this->input->post('active')
			);			
			$this->mgeneral->save($data,"tr_member");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method == "delete")
		{
			if($var = $this->input->post('data_id')){
				$this->mgeneral->delete(array('id'=>$var),"tr_member");
				$result['code'] 	= "03";
				$result['message']	= "Delete Sukses";
			}else{
				$result['code'] 	= "03";
				$result['message']	= "Not Parsing";
			}
		}
		else if ($method == "active")
		{
			if($i= $this->input->post('id')){
				$data =  array(
					"active"	=> $this->input->post('active')				
				);			

				$this->mgeneral->update(array('id'=>$i),$data,"tr_member");
				$result['code'] 	= "04";
				$result['message']	= "Active";
			}else{
				$result['code'] 	= "04";
				$result['message']	= "Not Parsing";
			}
		}
		else
		{
			$result['code'] 	= "05";
			$result['message']	= "Unmethod";
		}
		echo json_encode($result);
	}
	
}


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
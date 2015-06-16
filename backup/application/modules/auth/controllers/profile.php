<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login controller.
 * 
 * @package App
 * @category Controller
 * @author Jafar Sidik
 */
class Profile extends Admin_Controller 
{
	private $ci;
	
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
		$this->template->set_js('js/bootstrap-datepicker')->set_css('css/datepicker3');
	}
	function index()
	{
		$id			= $this->auth->userid();
		$account 	= $this->db->query("select * from t_user where ID_='".$id."'")->row();
		$this->data['agama']		= $this->mgeneral->getAll('tr_religion');
		$this->data['tr_crm_area'] 	= $this->mgeneral->getAll('tr_crm_area');
		$this->data['tr_province'] 	= $this->mgeneral->getAll('tr_province');
		$this->data['user']			= $account;
		$this->template->build('profile');
		
	}
	function action(){
		$result = array();
		$id = $this->input->post('user_id');
		$data =  array(
				'mid_name'=>$this->input->post('middle_name'),
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'nick_name'=>$this->input->post('nick_name'),
				'mother_name'=>$this->input->post('nama_ibu'),
				'sex_type_id'=>$this->input->post('jk'),
				'phone1'=>$this->input->post('phone'),
				'cust_type_id'=>$this->input->post('js'),
				'birthplace'=>$this->input->post('lahir'),
				'birthdate'=>$this->input->post('tgl_lahir'),
				'ethnic_id'=>$this->input->post('sb'),
				'religion_id'=>$this->input->post('agama'),
				'province_id1'=>$this->input->post('propinsi'),
				'district_id1'=>$this->input->post('kota'),
				'ym'=>$this->input->post('ym'),
				'zip1'=>$this->input->post('zipcode'),
				'address1'=>$this->input->post('address'),
				'descr'=>$this->input->post('descr')
				
			);
		$this->mgeneral->update(array('ID_'=>$id),$data,"t_user");
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	function get_kab(){
		$post = $this->input->post('propinsi');
		$list = $this->mgeneral->getWhere(array('PROVINCE_ID'=>$post),'tr_district');
		echo "<select class='form-control' name='kota' id='kota'>";
		foreach($list as $l){
			
			echo "<option value='".$l->ID."'>".$l->NAMA."</option></select>";
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */
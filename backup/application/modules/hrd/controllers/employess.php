<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Employess extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();

		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
		$this->load->library('upload');		
		$this->load->library('html2pdf');
	}
	/*function test_upload(){
		$this->template->build('test');		
	}
	function upload(){
			$config['upload_path'] = './uploader/';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size']	= '10240';			
			$this->upload->initialize($config);		
			$this->upload->do_upload('foto');
			$this->upload->do_upload('kk');
		
		
			//$this->mgeneral->save($data,"tr_user");
			echo "<pre>";
			$h = $this->upload->data();
			print_R($h['file_name']);
			//print_r($this->upload->display_errors());

	}*/
	function index()
	{
		$this->template->build('employess/index');
	}
	function load(){
		$edit	= site_url('hrd/employess/form/$1');		
		$link	= '<button data-id-print="$1" onclick="print(this);" class="btn btn-purple bnt-xs"><i class="fa fa-book"></i></button> <a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
				   <button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';
		$this->datatables->select('
			u.id as id,
			u.code as code,
			u.username as username,
			u.first_name as first_name,
			u.mid_name as mid_name,
			u.last_name as last_name,
			u.active as active,			
			u.phone1 as phone1,			
			f.name as fname,
			d.name as dname
			');
		
		$this->datatables->from('tr_user u');
		$this->datatables->join('tr_hr_org f','f.id = u.fnc_id','left');
		$this->datatables->join('tr_hr_org d','d.id = u.div_id','left');	
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	function load_education_type($id =''){
		$edit	= site_url('hrd/employess/form_education/'.$id.'/$1');		
		$link	= '	<a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del_edu(this);"><i class="fa fa-trash-o"></i></button>
				  ';
		$this->datatables->select('
			edu.id as id,
			edu.START_DATE as start_date,
			edu.END_DATE as end_date,		
			edu.NAME as name			
		');
		$education_type		= json_decode(file_get_contents(base_url()."data/json_data.php?type=education_type"));
		$this->datatables->from('TT_HR_EDUCATION edu');
		$this->datatables->where('USER_ID', $id);
		//$this->datatables->join('$education_type tp','tp.id = edu.TYPE_ID','left');
		$this->datatables->join('tr_user user','user.id = edu.USER_ID','left');		
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	function load_job_history($id){
		$edit	= site_url('organization/employess/form_job/'.$id.'/$1');		
		$link	= '	<a title="Edit" class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a> 
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del_job(this);"><i class="fa fa-trash-o"></i></button>
				  ';
		$this->datatables->select('
			job.id as id,
			job.START_DATE as start_date,
			job.END_DATE as end_date,
			job.COMPANY_NAME as name_company,
			job.PERFORMANCE as tugas			
			');
		
		$this->datatables->from('TT_HR_JOBHISTORY job');
		$this->datatables->where('USER_ID', $id);		
		$this->datatables->join('tr_user user','user.id = job.USER_ID','left');		
		$this->datatables->add_column('show',$link, 'id');		
		echo  $this->datatables->generate();
	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$uri_religion 						= json_decode(file_get_contents(base_url()."data/religion.php"));
		$uri_marital_status 				= json_decode(file_get_contents(base_url()."data/json_data.php?type=marital_status"));
		$traditional 						= json_decode(file_get_contents(base_url()."data/json_data.php?type=traditional"));
		$blood_type 						= json_decode(file_get_contents(base_url()."data/json_data.php?type=blood_type"));
		$province 							= json_decode(file_get_contents(base_url()."data/json_data.php?type=province"));
		$district 							= json_decode(file_get_contents(base_url()."data/json_data.php?type=district"));
		$education_type						= json_decode(file_get_contents(base_url()."data/json_data.php?type=education_type"));
		$this->data['role'] 				= $this->mgeneral->GetAll('tr_role');
		$this->data['divisi']				= $this->mgeneral->GetWhere(array('or_type_id'=>1),"tr_hr_org");
		$this->data['struktur']				= $this->mgeneral->GetWhere(array('or_type_id'=>2),"tr_hr_org");
		$this->data['fungsi']				= $this->mgeneral->GetWhere(array('or_type_id'=>3),"tr_hr_org");
		$this->data['tr_hr_grp']			= $this->mgeneral->GetAll("tr_hr_grp");
		$this->data['tr_hr_marital_status']	= $uri_marital_status;
		$this->data['agama']				= $uri_religion;
		$this->data['tr_hr_traditional']	= $traditional;
		$this->data['tr_hr_blood_type']		= $blood_type;
		$this->data['TR_SYS_AREA_PROVINCE']	= $province;
		$this->data['TR_SYS_AREA_DISTRICT']	= $district;			
		$this->data['TR_HR_EDUCATION_TYPE']	= $education_type;
		if(!isset($id)){
			$this->template->build('employess/add');
		}else{
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_user");
			$this->template->build('employess/edit');
		}
	}
	function form_education($user_id,$id = null){
		$education_type		= json_decode(file_get_contents(base_url()."data/json_data.php?type=education_type"));
		if(!isset($id)){			
			$this->data['TR_HR_EDUCATION_TYPE']		= $education_type;
			$this->data['user_id']		= $user_id;			
			$this->template->build('employess/add_education');
		}else{
			$this->data['TR_HR_EDUCATION_TYPE']		= $education_type;
			$this->data['user_id']		= $user_id;	
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"TT_HR_EDUCATION");
			$this->template->build('employess/edit_education');
		}
	}
	function form_job($user_id,$id = null){
		if(!isset($id)){						
			$this->data['user_id']		= $user_id;			
			$this->template->build('employess/add_job');
		}else{			
			$this->data['user_id']		= $user_id;	
			$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"TT_HR_JOBHISTORY");
			$this->template->build('employess/edit_job');
		}
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute_hr_edu($method = '',$id=''){
		$result = array();
		if($method == "update")
		{
			$data =  array(
				'TYPE_ID'=>$this->input->post('education_type'),
				'code'=>$this->input->post('code'),
				'name'=>$this->input->post('name'),
				'COMPANY_NAME'=>$this->input->post('company_name'),
				'START_DATE'=>$this->input->post('startdate'),
				'END_DATE'=>$this->input->post('enddate'),
				'DESCRIPTION'=>$this->input->post('descr'),
				'ACHIEVEMENT'=>$this->input->post('achievement'),
				'active'=>$this->input->post('active'),
				'USER_ID'=>$this->input->post('user_id'),
			);
			$this->mgeneral->Update(array('id'=>$id),$data,"TT_HR_EDUCATION");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		elseif($method == "save"){
			$data =  array(
				'TYPE_ID'=>$this->input->post('education_type'),
				'code'=>$this->input->post('code'),
				'name'=>$this->input->post('name'),
				'COMPANY_NAME'=>$this->input->post('company_name'),
				'START_DATE'=>$this->input->post('startdate'),
				'END_DATE'=>$this->input->post('enddate'),
				'DESCRIPTION'=>$this->input->post('descr'),
				'ACHIEVEMENT'=>$this->input->post('achievement'),
				'active'=>$this->input->post('active'),
				'USER_ID'=>$this->input->post('user_id'),
			);			
			$this->mgeneral->save($data,"TT_HR_EDUCATION");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		elseif($method == "delete"){
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"TT_HR_EDUCATION");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else
		{
			$result['code'] 	= "05";
			$result['message']	= "Unmethod";
		}
		echo json_encode($result);
	}
	function execute_hr_job($method = '',$id=''){
		$result = array();
		if($method == "update")
		{
			$data =  array(				
				'code'=>$this->input->post('code'),
				'name'=>$this->input->post('name'),
				'descr'=>$this->input->post('descr'),
				'COMPANY_NAME'=>$this->input->post('company_name'),
				'USER_ID'=>$this->input->post('user_id'),
				'START_DATE'=>$this->input->post('startdate'),
				'END_DATE'=>$this->input->post('enddate'),
				'PERFORMANCE'=>$this->input->post('PERFORMANCE'),
				'TECHNOLOGY'=>$this->input->post('TECHNOLOGY'),
				'ACHIEVEMENT'=>$this->input->post('achievement'),
				'active'=>$this->input->post('active'),
			);		
			$this->mgeneral->Update(array('id'=>$id),$data,"TT_HR_JOBHISTORY");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		elseif($method == "save"){
			$data =  array(				
				'code'=>$this->input->post('code'),
				'name'=>$this->input->post('name'),
				'descr'=>$this->input->post('descr'),
				'COMPANY_NAME'=>$this->input->post('company_name'),
				'USER_ID'=>$this->input->post('user_id'),
				'START_DATE'=>$this->input->post('startdate'),
				'END_DATE'=>$this->input->post('enddate'),
				'PERFORMANCE'=>$this->input->post('PERFORMANCE'),
				'TECHNOLOGY'=>$this->input->post('TECHNOLOGY'),
				'ACHIEVEMENT'=>$this->input->post('achievement'),
				'active'=>$this->input->post('active'),
			);			
			$this->mgeneral->save($data,"TT_HR_JOBHISTORY");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		elseif($method == "delete"){
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"TT_HR_JOBHISTORY");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else
		{
			$result['code'] 	= "05";
			$result['message']	= "Unmethod";
		}
		echo json_encode($result);
	}
	function execute($method = '',$id = '')
	{		
		
		$result = array();
		if($method == "update")
		{
			$config['upload_path'] = './uploader/';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size']	= '10240';			
			$this->upload->initialize($config);		
			$this->upload->do_upload('foto');
			$this->upload->do_upload('kk');
			$this->upload->do_upload('ktp');
			
			$data =  array(
				"first_name"	=> $this->input->post('txtNama1'),
				"mid_name"		=> $this->input->post('txtNama2'),
				"last_name"		=> $this->input->post('txtNama3'),
				"phone1"		=> $this->input->post('txtPhone1'),
				"phone1"		=> $this->input->post('txtPhone1'),
				"email1"		=> $this->input->post('txtEmail1'),
				"weight"		=> $this->input->post('txtWeight'),
				"height"		=> $this->input->post('txtHeight'),
				"mother_name"	=> $this->input->post('txtMother'),
				"nick_name"		=> $this->input->post('txtNickName'),
				"birthplace"	=> $this->input->post('txtBirthPlace'),
				"birthdate"			=> $this->input->post('txtBirth'),
				"sex_id"			=> $this->input->post('TxtSex'),
				"religion_id"			=> $this->input->post('TxtReligion'),
				"marital_id"			=> $this->input->post('TxtMarital'),
				"ethnic_id"			=> $this->input->post('TxtEthnic'),
				"blood_id"			=> $this->input->post('TxtBlood'),
				
				"address1"			=> $this->input->post('txtAddress1'),
				"Adr1RT"			=> $this->input->post('txtAdr1RT'),
				"Adr1RW"			=> $this->input->post('txtAdr1RW'),
				"Adr1LRH"			=> $this->input->post('txtAdr1LRH'),
				"Adr1KCM"			=> $this->input->post('txtAdr1KCM'),
				"zip1"			=> $this->input->post('txtZip1'),
				"dtc1_id"			=> $this->input->post('txtDstr1'),
				"prv1_id"			=> $this->input->post('txtProv1'),
				"address2"			=> $this->input->post('txtAddress2'),
				"Adr2RT"			=> $this->input->post('txtAdr2RT'),
				"Adr2RW"			=> $this->input->post('txtAdr2RW'),
				"Adr2LRH"			=> $this->input->post('txtAdr2LRH'),
				"Adr2KCM"			=> $this->input->post('txtAdr2KCM'),
				"zip2"			=> $this->input->post('txtZip2'),
				"prv2_id"			=> $this->input->post('txtProv2'),
				"dtc2_id"			=> $this->input->post('txtDstr2'),
				"status_addr"			=> $this->input->post('TxtStatAddr'),
				"start_date"			=> $this->input->post('txtStartDate'),
				"end_date"			=> $this->input->post('txtEndDate'),
				"card_id"			=> $this->input->post('txtCard'),
				"card_exp"			=> $this->input->post('txtCardExp'),
				"div_id"			=> $this->input->post('txtDivId'),
				"stc_id"			=> $this->input->post('txtStrucId'),
				"fnc_id"			=> $this->input->post('txtFuncId'),				
				"code"				=> $this->input->post('txtCode'),
				"edu_type_id"		=> $this->input->post('TxtEdu'),
				"username"			=> $this->input->post('txtUserName2'),
				"password"			=> $this->ci->passwordhash->HashPassword($this->input->post('txtPass2')),//$this->input->post('txtPass2'),
				"descr"			=> $this->input->post('TxtDesc'),
				"active"			=> $this->input->post('TxtRem'),
				"role_id"			=> $this->input->post('role'),
			
				"filename1"			=> $_FILES['foto']['name'],
				"filename2"			=> $_FILES['ktp']['name'],
				"filename3"			=> $_FILES['kk']['name']					
			);
			$this->mgeneral->Update(array('id'=>$id),$data,"tr_user");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{			
			$config['upload_path'] = './uploader/';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size']	= '10240';			
			$this->upload->initialize($config);		
			$this->upload->do_upload('foto');
			$this->upload->do_upload('kk');
			$this->upload->do_upload('ktp');
			
			$data =  array(
				"first_name"	=> $this->input->post('txtNama1'),
				"mid_name"		=> $this->input->post('txtNama2'),
				"last_name"		=> $this->input->post('txtNama3'),
				"phone1"		=> $this->input->post('txtPhone1'),
				"phone1"		=> $this->input->post('txtPhone1'),
				"email1"		=> $this->input->post('txtEmail1'),
				"weight"		=> $this->input->post('txtWeight'),
				"height"		=> $this->input->post('txtHeight'),
				"mother_name"	=> $this->input->post('txtMother'),
				"nick_name"		=> $this->input->post('txtNickName'),
				"birthplace"	=> $this->input->post('txtBirthPlace'),
				"birthdate"			=> $this->input->post('txtBirth'),
				"sex_id"			=> $this->input->post('TxtSex'),
				"religion_id"			=> $this->input->post('TxtReligion'),
				"marital_id"			=> $this->input->post('TxtMarital'),
				"ethnic_id"			=> $this->input->post('TxtEthnic'),
				"blood_id"			=> $this->input->post('TxtBlood'),
				
				"address1"			=> $this->input->post('txtAddress1'),
				"Adr1RT"			=> $this->input->post('txtAdr1RT'),
				"Adr1RW"			=> $this->input->post('txtAdr1RW'),
				"Adr1LRH"			=> $this->input->post('txtAdr1LRH'),
				"Adr1KCM"			=> $this->input->post('txtAdr1KCM'),
				"zip1"			=> $this->input->post('txtZip1'),
				"dtc1_id"			=> $this->input->post('txtDstr1'),
				"prv1_id"			=> $this->input->post('txtProv1'),
				"address2"			=> $this->input->post('txtAddress2'),
				"Adr2RT"			=> $this->input->post('txtAdr2RT'),
				"Adr2RW"			=> $this->input->post('txtAdr2RW'),
				"Adr2LRH"			=> $this->input->post('txtAdr2LRH'),
				"Adr2KCM"			=> $this->input->post('txtAdr2KCM'),
				"zip2"			=> $this->input->post('txtZip2'),
				"prv2_id"			=> $this->input->post('txtProv2'),
				"dtc2_id"			=> $this->input->post('txtDstr2'),
				"status_addr"			=> $this->input->post('TxtStatAddr'),
				"start_date"			=> $this->input->post('txtStartDate'),
				"end_date"			=> $this->input->post('txtEndDate'),
				"card_id"			=> $this->input->post('txtCard'),
				"card_exp"			=> $this->input->post('txtCardExp'),
				"div_id"			=> $this->input->post('txtDivId'),
				"stc_id"			=> $this->input->post('txtStrucId'),
				"fnc_id"			=> $this->input->post('txtFuncId'),				
				"code"				=> $this->input->post('txtCode'),
				"edu_type_id"		=> $this->input->post('TxtEdu'),
				"username"			=> $this->input->post('txtUserName2'),
				"password"			=> $this->ci->passwordhash->HashPassword($this->input->post('txtPass2')),//$this->input->post('txtPass2'),
				"descr"			=> $this->input->post('TxtDesc'),
				"active"			=> $this->input->post('TxtRem'),
				"role_id"			=> $this->input->post('role'),
				"filename1"			=> $_FILES['foto']['name'],
				"filename2"			=> $_FILES['ktp']['name'],
				"filename3"			=> $_FILES['kk']['name']					
			);
			
			$this->mgeneral->save($data,"tr_user");
			
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tr_user");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tr_user");
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
	function convert_to_pdf($id=  ''){
		$data['data'] = $this->db->query('
			select 
			u.id as id,
			u.code as code,
			u.username as username,
			u.first_name as first_name,
			u.mid_name as mid_name,
			u.last_name as last_name,
			u.active as active,			
			u.phone1 as phone1,			
			u.photoid as photoid,
			u.email1 as email1,
			u.weight as weight,
			u.height as height,
			u.birthplace,
			u.birthdate,
			u.sex_type_id,
			u.marital_id,
			u.ethnic_id,
			u.blood_type_id,
			u.mother_name,
			u.nick_name,
			u.address1,
			u.Adr1RT,
			u.Adr1RW,
			u.Adr1LRH,	 
			u.Adr1KCM,
			u.Adr2RT,	 
			u.Adr2RW,	 
			u.Adr2LRH,	 
			u.Adr2KCM,	 
			u.start_join as start_join,	 
			u.end_join as end_join,	 
			u.card_id as card_id,	 
			u.card_exp as card_exp,	 
			prov.name as provinsi1,
			u.province_id2,	 
			district.name as district_id1,	 
			u.district_id2,	 
			u.zip1,	 
			u.zip2,	 
			u.status_addr,	 
			f.name as fucntional,
			d.name as divisi,
			s.name as stuctural,
			r.name as religion
			from tr_user u
			left join tr_hr_fnc f on f.id = u.func_id
			left join tr_hr_div d on d.id = u.divisi_id
			left join tr_hr_stc s on s.id = u.struc_id
			left join tr_hr_religion r on r.id = u.struc_id
			left join TR_SYS_AREA_PROVINCE prov on r.id = u.province_id1
			left join TR_SYS_AREA_PROVINCE district on r.id = u.district_id1
			where u.id ="'.$id.'"
		')->row();
		$data['data_pendidikan'] = $this->db->query('
			select
			pendidikan.START_DATE as START_DATE,
			pendidikan.END_DATE as END_DATE,
			pendidikan.COMPANY_NAME as COMPANY_NAME,
			type.name as type_name
			from TT_HR_EDUCATION pendidikan
			left join TR_HR_EDUCATION_TYPE type on type.id = pendidikan.TYPE_ID
			where pendidikan.USER_ID = "'.$id.'"
			')->result();
		$data['data_pekerjaan'] = $this->db->query('
			select
			job.START_DATE as START_DATE,
			job.END_DATE as END_DATE,
			job.COMPANY_NAME as COMPANY_NAME,
			job.PERFORMANCE as PERFORMANCE			
			from TT_HR_JOBHISTORY job
			
			where job.USER_ID = "'.$id.'"
			')->result();
		echo $this->load->view('layout_pdf', $data, true);
		exit();
		//Set folder to save PDF to
		$this->html2pdf->folder('./docs/');

		//Set the filename to save/download as
		$this->html2pdf->filename($data['data']->username.'.pdf');

		//Set the paper defaults
		$this->html2pdf->paper('a4', 'portrait');
		//$this->data['edit']	= $this->mgeneral->GetRow(array('id'=>$id),"tr_user");
		
		//Load html view
		$this->html2pdf->html($this->load->view('layout_pdf', $data,true));
		$this->html2pdf->create('save');	
	}
}

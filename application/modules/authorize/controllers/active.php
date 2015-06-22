<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Active controller.
 * 
 * @package App
 * @category Controller
 * @author Muhamad Jafar Sidik
 */
class Active extends MY_Controller 
{
	private $ci;
	
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->ci->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
		$this->load->helper('rand_string');
	}
	
	/**
	 * Display Pages. 
	 */
	 
	function index()
	{		
		show_error('Silahkan masukan url dengan benar');
	}
	function verify($email = ''){
		$this->load->model("mgeneraldealer");
		$decode = base64_decode($email);
		
		if(!isset($decode) or $decode == ''){
			show_error('Silahkan masukan url dengan benar');
		}else{			
			$data_user = array('active_login'=>'1');
			$sel		= $this->mgeneral->getWhere(array('email1'=>$decode),'t_user');
			
			/* $data_account = array(
				"ID_"		=>$sel[0]->ID_,
				"active"	=>0,
				"name"		=>$sel[0]->nick_name,
				"secret_key"	=>$this->ci->passwordhash->HashPassword($sel[0]->ID_),
				"pin"		=>rand_string(6),
				"account_id"=>$sel[0]->ID_
			); */
			$this->mgeneral->update(array('email1'=>$decode), $data_user,'t_user');
			
			//$this->mgeneraldealer->save($data_account,"t_account");
			$this->template
			->set_layout('aktivasi')
			->build('active');
			
		}
	}
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Global Query Model.
 * 
 * @package App
 * @category Model
 * @author Muhamad Jafar Sidik
 */

class Mgeneral extends CI_Model
{
	function __construct(){
		parent::__construct();
		
	}
	
	#Get By Username
	#ex akses : $this->mgeneral->GetByUsername($username,'nama_tabel');
	function GetByUsername($username = null,$table){
		$result = 'invalid input';
		if($username!=null){
			$this->db->where('username',$username);
			//$this->db->or_where('email1',$username);
			return $this->db->get($table);
		}
	}
	
	#Get All Record
	#ex akses : $this->mgeneral->getAll('nama_tabel');
	function GetAll($tabel, $order_field="", $order_tipe=""){
		if($order_field!="" && $order_tipe!=""){ 
			$this->db->order_by($order_field,$order_tipe);
		}
		return $this->db->get($tabel)->result();
	}
	
	#Get Where Record
	#ex akses : $this->mgeneral->getWhere(array('field1'=>'data','field2'=>'data'),'nama_tabel');
	function GetWhere($where,$tabel,$order_field="",$order_tipe=""){
		$this->db->where($where);
		if($order_field!=""){ $this->db->order_by($order_field,$order_tipe); }
		return $this->db->get($tabel)->result();
	}
	
	#Get Where one row Record
	#ex akses : $this->mgeneral->GetRow(array('field1'=>'data','field2'=>'data'),'nama_tabel');
	function GetRow($where,$tabel,$order_field="",$order_tipe=""){
		$this->db->where($where);
		if($order_field!=""){ $this->db->order_by($order_field,$order_tipe); }
		return $this->db->get($tabel)->row();
	}
	
	#Get Like Record
	#ex akses : $this->mgeneral->getLike(array('field1'=>'data','field2'=>'data'),'nama_tabel');
	function GetLike($where,$tabel){
		$this->db->like($where);
		return $this->db->get($tabel)->result();
	}
	
	#Insert Record
	#ex akses : $this->mgeneral->Save(array_data_insert,nama_tabel);
	function Save($varData,$tabel){
		$this->db->insert($tabel, $varData);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}
	
	#Update Record
	#ex akses : $this->mgeneral->Update(array('field1'=>'data','field2'=>'data'),array_data_update,nama_tabel);
	function Update($where, $data, $tabel){
		$this->db->where($where);
		$this->db->update($tabel, $data);
	}
	
	#fungsi hapus data
	#ex akses : $this->mgeneral->delete(array('field1'=>'data','field2'=>'data'),nama_tabel);
	function Delete($where,$tabel){
		$this->db->where($where);
		$this->db->delete($tabel);
	}
	
}

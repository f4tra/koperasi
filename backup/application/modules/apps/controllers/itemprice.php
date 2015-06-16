<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Itemprice extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
		$this->load->library('upload');
		$this->load->helper('download');
		$this->load->helper('file');		
	}	
	function index()
	{
		$this->template->build('item_price/index');
	}
	function load(){	
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			a.item_id as item_id,
			a.price1 as price1,
			a.price2 as price2,
			a.price3 as price3,
			a.price4 as price4,
			b.name as item,			
			');
			
		$this->datatables->from('tt_item a');		
		$this->datatables->join('tr_item b','b.id = a.item_id','left');
		
		
		//$this->datatables->join('tt_item_doc mou','mou.id = a.mou_id','left');
		/*$this->datatables->add_column('detail',$detail, 'a.item_id');		
		$this->datatables->add_column('show',$link, 'a.id');	*/	
		echo  $this->datatables->generate();

	}
	/**
	 * Form Add and Update. 
	 */
	function form($id = null)
	{		
		$this->data['item']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item");
		if(!isset($id)){
			$this->template->build('item_price/add');
		}else{
			$this->data['edit']		= $this->mgeneral->GetRow(array('id'=>$id),"tt_item");
			
			$this->data['item']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item");			
			$this->template->build('item_price/edit');
		}
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute($method = '',$id = '')
	{		
		$result = array();
		if($method == "update")
		{
			$data =  array(
					"item_id"	=> $this->input->post('item'),					
					//"status_id"	=> $this->input->post('status'),					
					"start_date"=> $this->input->post('start_date'),				
					"end_date"	=> $this->input->post('end_date'),				
					"code"		=> $this->input->post('code'),
					"name"		=> $this->input->post('name'),					
					"descr"		=> $this->input->post('descr'),
					"active"	=> $this->input->post('active'),				
					"price1"	=> $this->input->post('price1'),				
					"price2"	=> $this->input->post('price2'),				
					"price3"	=> $this->input->post('price3'),				
					"price4"	=> $this->input->post('price4'),
				);
			//$data_item =  array('status_id'=>$this->input->post('status'));
			//$this->mgeneral->Update(array('id'=>$this->input->post('item')),$data_item,"tr_item");			
			$this->mgeneral->Update(array('id'=>$id),$data,"tt_item");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{				
			$data =  array(
				"code"		=> $this->input->post('code'),
				"name"		=> $this->input->post('name'),					
				"item_id"	=> $this->input->post('item'),					
				"descr"		=> $this->input->post('descr'),
				"active"	=> $this->input->post('active'),								
				"price1"	=> $this->input->post('price1'),				
				"price2"	=> $this->input->post('price2'),				
				"price3"	=> $this->input->post('price3'),				
				"price4"	=> $this->input->post('price4'),				
				"start_date"=> $this->input->post('start_date'),				
				"end_date"	=> $this->input->post('end_date'),				
			);
			$this->mgeneral->save($data,"tt_item");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method=="delete")
		{
			$var = $this->input->post('data_id');
			$this->mgeneral->delete(array('id'=>$var),"tt_item");
			$result['code'] 	= "03";
			$result['message']	= "Delete Sukses";
		}
		else if ($method == "active")
		{
			$i= $this->input->post('id');
			$data =  array(
				"active"	=> $this->input->post('active')				
			);			
			$this->mgeneral->update(array('id'=>$i),$data,"tt_item");
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
	function upload($idx =''){
		$this->data['idx'] 		= $idx;	
		$this->template->build('item_price/upload');
	}
	function action_upload($idx){
		$config['upload_path'] = './uploader/product';
		$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config['max_size']	= '10240';			
		$this->upload->initialize($config);		
		$this->upload->do_upload('userfile');
		//$r = $this->upload->data();
		chmod($_FILES['userfile']['name'], 0777);
		$data = array(
			'filename' =>$_FILES['userfile']['name'] ,//$r['file_name'],						
			'tt_item' =>$idx,//$this->input->post('tt_item'),
		);
		$this->mgeneral->save($data,'tt_item_doc');		
	}
	function download($id){
		$file = $this->mgeneral->getRow(array('id' =>$id),'tt_item_doc');
		$data = file_get_contents("./uploader/product/".$file->name.""); // Read the file's contents
		force_download($file->name, $data);
	}
	function remove_file(){
		$id =  $this->input->post('data_id');
		$file = $this->mgeneral->getRow(array('filename' =>$id),'tt_item_doc');
		
 		//unlink(base_url("uploader/product/").$file->filename);		
		$this->mgeneral->delete(array('filename' =>$file->filename),'tt_item_doc');		
	}
	function viewimage($idx=''){
		$ds          = DIRECTORY_SEPARATOR; 
		$loop = $this->mgeneral->getwhere(array('tt_item'=>$idx),'tt_item_doc');
		//print_r($loop);
		$storeFolder = './uploader/product/';  
		
		$result  = array();
		foreach ($loop as $key => $value) {
			$obj['name'] = $value->filename;
            $obj['size'] = filesize($storeFolder.$value->filename);
            $result[] = $obj;
		}
    	//header('Content-type: text/json');              //3
    	//header('Content-type: application/json');
    	echo json_encode($result);
	}
}

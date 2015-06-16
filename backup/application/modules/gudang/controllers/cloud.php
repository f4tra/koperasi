<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Cloud extends Admin_Controller 
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
		$this->template->build('index');
	} 
	function upload(){
		//for($i=0; $i < $_POST; $i++){
		//mkdir("./uploader/dir", 7777,true);
		//chmod("/var/www/html/workflow", 7777);
		//mkdir("./uploader/dir", 7777,true);
		$config['upload_path'] = './uploader/product';
		$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|docx|xml|zip|rar";
		$config['max_size']	= '10240';			
		$this->upload->initialize($config);		
		$this->upload->do_upload('userfile');
		//$r = $this->upload->data();
		/*$data = array(
			'filename' =>$_FILES['userfile']['name'] ,//$r['file_name'],
			'type_id' =>$this->input->post('type_id'),
			'item_id' =>$this->input->post('item_id'),
		);*/
		//$this->mgeneral->save($data,'tt_item_doc');
		//print_r($r);
		print_r($_FILES['userfile']);
		//}
	}
	function remove(){
		$id =  $this->input->post('data_id');
		$file = $this->mgeneral->getRow(array('file' =>$id),'tt_item_doc');
		
 		//unlink("./uploader/product/$id");		
 		//unlink("./uploader/product/$file->name");		
		//$this->mgeneral->delete(array('id' =>$id),'tt_item_doc');		
	}
	function view(){
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = 'uploader/product/';  
		$result  = array();
 		$files = scandir($storeFolder);                 //1
    	if ( false!==$files ) {
        	foreach ( $files as $file ) {
            	if ( '.'!=$file && '..'!=$file) {       //2
                	$obj['name'] = $file;
                	$obj['size'] = filesize($storeFolder.$ds.$file);
                	$result[] = $obj;
            	}
        	}
    	}
    	header('Content-type: text/json');              //3
    	header('Content-type: application/json');
    	echo json_encode($result);
	}
	function load(){
		/*$grap	= site_url('unitstock/pricehistory/chart/$1');		
		$price	= site_url('unitstock/pricehistory/price_history/$1');		
		$detail	= '<a title="Price History"class="btn btn-success btn-m" href="'.$grap.'"><i class="fa fa-bar-chart-o"></i></a>
					<a title="Price History"class="btn btn-purple btn-m" href="'.$price.'"><i class="fa fa-tag"></i></a>';
		$edit	= site_url('unitstock/productavailable/form/$1');		
		$link	= '<a title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
				   <button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';	*/	
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			a.item_id as item_id,
			b.name as item,			
			cmp.name as issuer,
			i.nick_name as owner,
			st.code as status_code,
			st.name as status_name,
			');		/*
			mou.code as mou,
			mou.id as mou_id,*/
		$this->datatables->from('tt_item a');		
		$this->datatables->join('tr_item b','b.id = a.item_id','left');
		$this->datatables->join('tr_status st','st.id = a.status_id','left');
		$this->datatables->join('tr_company cmp','cmp.id = b.issuer_id','left');
		$this->datatables->join('tr_user i','i.id = a.owner_id','left');
		
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
		if(!isset($id)){
			$this->data['owner_id']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");			
			$this->data['user']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
			$this->data['item']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item");
			$this->template->build('productavailable/add');
		}else{
			$this->data['edit']		= $this->mgeneral->GetRow(array('id'=>$id),"tt_item");
			
			
			$this->data['user']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
			$this->data['status']	= $this->mgeneral->GetWhere(array('type_id'=>1),"tr_status");
			$this->data['item']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_item");			
			$this->data['item_reff']= $this->mgeneral->GetRow(array('id'=>$this->data['edit']->item_id),"tr_item");			
			$this->data['grp']		= $this->mgeneral->GetRow(array('id'=>$this->data['item_reff']->grp_id),"tr_item_grp");
			$this->data['type']		= $this->mgeneral->GetRow(array('id'=>$this->data['item_reff']->type_id),"tr_item_type");
			$this->data['ctg']		= $this->mgeneral->GetRow(array('id'=>$this->data['item_reff']->ctg_id),"tr_item_ctg");
			$this->data['wing']		= $this->mgeneral->GetRow(array('id'=>$this->data['item_reff']->spc1_id),"tr_item_spc");
			$this->data['floor']	= $this->mgeneral->GetRow(array('id'=>$this->data['item_reff']->spc2_id),"tr_item_spc");
			$this->data['tower']	= $this->mgeneral->GetRow(array('id'=>$this->data['item_reff']->spc3_id),"tr_item_spc");
			$this->data['user']		= $this->mgeneral->GetWhere(array('active'=>1),"tr_user");
			
			$this->template->build('productavailable/edit');
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
					"owner_id"	=> $this->input->post('owner'),					
					"seller_id"	=> $this->input->post('seller'),				
					"buyer"	=> $this->input->post('buyer'),				
					"status_id"	=> $this->input->post('status'),				
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
					"owner_id"	=> $this->input->post('owner_id'),					
					"descr"		=> $this->input->post('descr'),
					"active"	=> $this->input->post('active'),				
					"seller_id"	=> $this->input->post('seller_id'),				
					"price1"	=> $this->input->post('price1'),				
					"price2"	=> $this->input->post('price2'),				
					"price3"	=> $this->input->post('price3'),				
					"price4"	=> $this->input->post('price4'),				
					"start_date"=> $this->input->post('start_date'),				
					"end_date"	=> $this->input->post('end_date'),				
				);
					
			//$data_item =  array('status_id'=>$this->input->post('status'));
			//$this->mgeneral->Update(array('id'=>$this->input->post('item')),$data_item,"tr_item");			
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
	/*function upload($idx =''){
		$this->data['idx'] 		= $idx;
		$this->data['type_id']	= $this->mgeneral->GetWhere(array('active'=>1),"tr_item_doc_type");			
		$this->template->build('productavailable/upload');
	}*/
	function action_upload(){
		$config['upload_path'] = './uploader/product';
		$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config['max_size']	= '10240';			
		$this->upload->initialize($config);		
		$this->upload->do_upload('userfile');
		//$r = $this->upload->data();
		$data = array(
			'filename' =>$_FILES['userfile']['name'] ,//$r['file_name'],
			'type_id' =>$this->input->post('type_id'),
			'item_id' =>$this->input->post('item_id'),
		);
		$this->mgeneral->save($data,'tt_item_doc');
		//print_r($r);
		print_r($_FILES['userfile']['name']);
	}
	function download($id){
		$file = $this->mgeneral->getRow(array('id' =>$id),'tt_item_doc');
		$data = file_get_contents("./uploader/product/".$file->name.""); // Read the file's contents
		force_download($file->name, $data);
	}
	function remove_file(){
		$id =  $this->input->post('data_id');
		$file = $this->mgeneral->getRow(array('id' =>$id),'tt_item_doc');
		
 		unlink("./uploader/product/$file->name");		
		$this->mgeneral->delete(array('id' =>$id),'tt_item_doc');		
	}
	function price_history($id =''){
		$this->data['idx'] = $id;		
		$this->data['rows_price'] = $this->db->query("select id,price1,price2,price3,price4,start_date,end_date from tt_item where item_id='".$id."'")->result();
		$this->template->build('productavailable/price');
	}
	function load_price($idx = ''){
		/*$edit	= site_url('unitstock/pricehistory/form/$1');		
		$link	= '	<a title="Edit"class="btn btn-warning btn-m" href="'.$edit.'"><i class="fa fa-pencil"></i></a>
					<button title="Delete" class="btn btn-danger btn-m" data-id="$1" onclick="del(this);"><i class="fa fa-trash-o"></i></button>
				  ';	*/	
		$this->datatables->select('
			a.id as id,
			a.code as code,			
			a.name as name,			
			a.active as active,
			a.price1 as price1,
			a.price2 as price2,
			a.price3 as price3,
			a.price4 as price4,
			a.start_date as start_date,
			a.end_date as end_date,
			b.name as item_name,
			c.name as grp,
			d.name as ctg,
			e.name as type,
			
			');		
		$this->datatables->from('tt_item a');		
		$this->datatables->join('tr_item b','b.id = a.item_id','left');
		$this->datatables->join('tr_item_grp c','c.id = b.grp_id','left');
		$this->datatables->join('tr_item_ctg d','d.id = b.ctg_id','left');
		$this->datatables->join('tr_item_type e','e.id = b.type_id','left');
		$this->datatables->where('a.item_id', $idx); 
		$this->datatables->add_column('show','', 'id');		
		echo $this->datatables->generate();
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Soh extends Admin_Controller 
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
		$this->load->library('ciqrcode');
	}	
	function index()
	{
		//header("Content-Type: image/png");
//$params['data'] = 'This is a text to encode become QR Code';
//$params['size'] = '134';

		$this->data['data'] = $this->db->query("
			select 
			t.id as id,
			t.status_id as status,
			t.code as code,
			t.qty_id as qty,
			i.name as name,
			g.name as gudang,
			r.name as rak
			from tt_item t
			left join tr_item i on i.id = t.item_id
			left join tr_wherehouse g on g.id = t.gudang_id
			left join tr_wherehouse r on r.id = t.rak_id
			")->result();
		$this->template->build('soh_view/index');
	}
	function cloud($idx = ''){
		$this->data['cloud'] = $idx;
		$this->template->build('soh_view/cloud');
	}
	function upload($idx){
		
		$config['upload_path'] = './uploader/product';
		$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|docx|xml|zip|rar";
		$config['max_size']	= '10240';			
		$this->upload->initialize($config);		
		$this->upload->do_upload('userfile');
		//$r = $this->upload->data();
		$data = array(
			'filename' =>$_FILES['userfile']['name'] ,//$r['file_name'],
			'type_id' =>$this->input->post('type_id'),
			'tt_item' =>$idx
		);
		$this->mgeneral->save($data,'tt_item_doc');
		//print_r($r);
		print_r($_FILES['userfile']);
		//}
	}
	function view($idx){
		$files = $this->mgeneral->getWhere(array('tt_item'=>$idx),'tt_item_doc');
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = 'uploader/product/';  
		$result  = array();
 		//$files = scandir($storeFolder);                 //1
    	foreach ($files as $file ) {
            	if ( '.'!=$file->filename && '..'!=$file->filename) {       //2
                	$obj['name'] = $file->filename;
                	$obj['size'] = filesize($storeFolder.$ds.$file->filename);
                	$result[] = $obj;
            	}
        }
    	
    	header('Content-type: text/json');              //3
    	header('Content-type: application/json');
    	echo json_encode($result);
	}
	function remove(){
		$filename =  $this->input->post('data_id');
 		unlink("./uploader/product/".$filename);		
		$this->mgeneral->delete(array('filename' =>$filename),'tt_item_doc');		
		
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function form($idx=''){
		$this->data['edit']=$this->mgeneral->getRow(array('id'=>$idx),'tt_item');
		$this->data['item']=$this->mgeneral->getRow(array('id'=>$this->data['edit']->item_id),'tr_item');
		$this->template->build('soh_view/form');
	}
	/**
	 * Function execute add, delete, update, active.
	 * Response json object
	 */
	function execute($id = '')
	{		
		$result = array();
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = 'uploader/product/';
		$params['data'] =  $this->input->post('code');
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'qr_code/'.$this->input->post('code').".png";
		$this->ciqrcode->generate($params);
		$data =  array(
			"code"		=> $this->input->post('code'),
			"name"		=> $this->input->post('name'),
			"descr"		=> $this->input->post('descr'),
			);
		$this->mgeneral->update(array('id'=>$id),$data,'tt_item');
		$result['message'] = "Update Success";
		echo json_encode($result);
	}
}

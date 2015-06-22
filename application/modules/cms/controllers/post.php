<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Menu controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Post extends Admin_Controller 
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
		
		//$this->template->build('menu/menu-index');
		/*Load Parsing*/
		$js = $this->load->file('assets/beckend/my_js/my_tables.js',true);		
		$this->template
			->set_title("Menu")			
			->set_js_script($js,'',true)
			->build('post/post-index');
	}
	function load(){		
		$this->datatables->select('*');				
		$this->datatables->from('tt_posts p');
		$this->datatables->join('auth_users u','p.post_author = u.id','left');		
		$this->datatables->add_column('show','', 'id');				
		echo  $this->datatables->generate();
	}
	
	/**
	 * Add a new . 
	 */
	function add()
	{
		
		$this->template->build('post/post-add');	
	}
	
	/**
	 * Edit 
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->data['parsing']	= $this->mgeneral->getRow(array('id'=>$id),"tt_posts");		
		$this->template->build('post/post-edit');
		
	}
	function comment($id)
	{
		$this->data['parsing']	= $this->mgeneral->getRow(array('id'=>$id),"tt_posts");		
		$this->data['comment']	= $this->mgeneral->getWhere(array('id'=>$id),"tt_comment");		
		$this->template->build('post/post-edit');
		
	}
	/**
	 * View 
	 * 
	 * @param integer $id 
	 */
	
	function execute($method = '')
	{
		$result = array();
		$date = date('Y-m-d H:i:s');
		if($method == "update")
		{
			$data =  array(
				"post_title"	=> $this->input->post('title'),
				"post_content"	=> $this->input->post('post_content'),
				"post_status"	=> $this->input->post('post_status'),
				"comment_status"=> $this->input->post('comment_status'),
				"post_modified"	=> $date,				
				"post_type"		=> "post",
				
			);			
			
			$id = $this->input->post('id');			
			$this->mgeneral->update(array('id'=>$id),$data,"tt_posts");			
			$result['code'] 	= "01";
			$result['message']	= "Update Sukses";
		}
		else if ($method == "save")
		{
			$data =  array(
				"post_title"	=> $this->input->post('title'),
				"post_content"	=> $this->input->post('post_content'),
				"post_status"	=> $this->input->post('post_status'),
				"comment_status"=> $this->input->post('comment_status'),
				"post_date"		=> $date,
				"post_modified"	=> $date,				
				"post_author"	=> $this->auth->userid(),
				"post_type"		=> "post",
				
			);			
			$this->mgeneral->save($data,"tt_posts");
			$result['code'] 	= "02";
			$result['message']	= "Save Sukses";
		}
		else if ($method == "delete")
		{
			if($var = $this->input->post('data_id')){
				$this->mgeneral->delete(array('id'=>$var),"tt_posts");
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
					"post_status"=> $this->input->post('active')				
				);			

				$this->mgeneral->update(array('id'=>$i),$data,"tt_posts");
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Role management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Uom extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
	}	
	function index()
	{
		$uri = file_get_contents(base_url()."data/json_data.php?type=uom");
		$this->data['data'] = json_decode($uri);
		/*print_r($this->data['data']);
		exit();*/
		$this->template->build('uom/index');
	}
	
	
}


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
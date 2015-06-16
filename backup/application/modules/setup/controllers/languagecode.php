<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Role management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Languagecode extends Admin_Controller 
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
		$uri = file_get_contents(base_url()."data/json_data.php?type=language");
		$this->data['data'] = json_decode($uri);
		
		$this->template->build('languagecode/index');
	}
	
	
	
}


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
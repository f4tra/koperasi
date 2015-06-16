<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Role management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Countrycode extends Admin_Controller 
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
		$uri = file_get_contents(base_url()."data/json_data.php?type=country");
		$this->data['data'] = json_decode($uri);
		$this->template->build('countrycode/index');
	}
	
	
	
}


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
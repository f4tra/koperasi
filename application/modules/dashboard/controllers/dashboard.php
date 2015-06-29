<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Menu controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Dashboard extends Admin_Controller 
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
			->build('index');
	}
	
	
	
}


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */
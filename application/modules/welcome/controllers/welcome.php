<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Show welcome message.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Welcome extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->language('welcome');
		$this->load->model('blog');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *  - or -
	 *		http://example.com/index.php/welcome/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		if ($this->auth->loggedin()) 
        {
        	/*$js =  'jQuery(document).ready(function() {		
				App.setPage("index");  //Set current page

			App.init(); //Initialise plugins and elements
		});';
        	$this->template
        	->set_css('js/fullcalendar/fullcalendar.min')
        	->set_css('js/jquery-todo/css/styles')
        	->set_css('js/gritter/css/jquery.gritter')
        	->set_js('js/jQuery-BlockUI/jquery.blockUI.min',true)
        	->set_js('js/sparklines/jquery.sparkline.min',true)
        	->set_js('js/jquery-easing/jquery.easing.min',true)
        	->set_js('js/easypiechart/jquery.easypiechart.min',true)
        	->set_js('js/flot/jquery.flot.min',true)
        	->set_js('js/flot/jquery.flot.time.min',true)
        	->set_js('js/flot/jquery.flot.selection.min',true)
        	->set_js('js/flot/jquery.flot.resize.min',true)
        	->set_js('js/flot/jquery.flot.pie.min',true)
        	->set_js('js/flot/jquery.flot.stack.min',true)
        	->set_js('js/flot/jquery.flot.crosshair.min',true)
        	->set_js('js/jquery-todo/js/paddystodolist',true)
        	->set_js('js/timeago/jquery.timeago.min',true)
        	->set_js('js/fullcalendar/fullcalendar.min',true)
        	->set_js('js/script',true)
        	->set_js_script($js,'',true)
        	->build('dashboard');*/
             $this->template
            ->build('blank'); 
        }else{
        	$this->data['posted'] =  $this->blog->getAll();
        	$this->template->load_module_partial('sidebar', 'welcome/hmvc/sidebar_partial')
			->build('welcome_message');	

        }
		
	}
	
	/**
	 * Show Twitter Bootstrap demo pages.
	 * 
	 * @param string @page Page name ('starter', 'marketing', 'fluid')
	 * @see http://twitter.github.com/bootstrap/index.html 
	 */
	public function bootstrap_demo($page = 'starter')
	{
		if ($page == 'fluid')
		{
			$this->template->set_layout('fluid')
				->load_module_partial('sidebar', 'welcome/hmvc/sidebar_partial');
		}
		$this->template->build('bootstrap_' . $page);
	}
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
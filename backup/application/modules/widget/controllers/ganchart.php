<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', 'On');					
    require_once ('./dhtmljeff/connector/gantt_connector.php');
    require_once ('./dhtmljeff/connector/db_phpci.php');

    DataProcessor::$action_param ="dhx_editor_status"; 
/**
 * User management controller
 * 
 * @package App
 * @category Controller
 * @author Jeff
 */
class Ganchart extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		$this->ci =& get_instance();		
	}	
	function index()
	{
		$this->template->build('ganchart/index');
	}
	function store(){
		$this->load->database();
      //data feed
      $gantt = new JSONGanttConnector($this->db, "PHPCI");
      //$gantt->mix("open", 1);
      $gantt->enable_order("sortorder");
      //$gantt->render_links("gantt_links", "id", "source,target,type");
      //$gantt->render_table("gantt_tasks","id","start_date,text,duration,progress,sortorder,parent","");
      $gantt->render_table("tt_event","id","start_date,duration,descr,parent_id");

	}
	
}

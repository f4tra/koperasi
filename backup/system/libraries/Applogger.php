<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * AdoDB Class
 *
 * @package    CodeIgniter
 * @subpackage    Libraries
 * @category    AdoDB
 * @author    Kepler Gelotte
 */
require_once( BASEPATH.'libraries/errorlogger/errorlogger.php'); 

class CI_AppLogger {
		
		function CI_AppLogger()
    {
      
    }
	
    function addapplog($level, $message) {
      _addlog($level, $message);
    }
    
    function addlog($level, $message) {
      $this->addapplog($level, $message);
    }
    
}
// END AdoDB Class
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Global Query Model.
 * 
 * @package App
 * @category Model
 * @author Muhamad Jafar Sidik
 */

class Blog extends CI_Model
{
	function __construct(){
		parent::__construct();
		
	}
	
	public function getAll(){
		
		return $this->mgeneral->getwhere(array('post_status'=>0),"tt_posts");		

	}
	
}

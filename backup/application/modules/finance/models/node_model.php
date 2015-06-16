<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node_model extends MY_Model 
{	
	function get_list()
	{
		$this->db->select('
			tr_node.id as id,			
			tr_node.code as code,
			tr_node.gps_x as gpsx,
			tr_node.gps_y as gpsy,
			tr_company.name  as name,
			')
			->join('tr_company','tr_company.id = tr_node.company_id','left');
			
		return $this->db->get('tr_node')->result();
	}
	
	
}

/* End of file acl_rule_model.php */
/* Location: ./application/modules/acl/models/acl_rule_model.php */
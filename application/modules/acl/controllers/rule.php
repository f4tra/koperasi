<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Rule management controller
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Rule extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		
		$this->load->library(array('form_validation'));
		$this->load->model('acl/role_model');
		$this->load->model('acl/rule_model');
		$this->load->language('acl/role');
		$this->load->language('acl/rule');
		//$this->template->set_css_f('css/simple-lists');
		
		$this->data['redirect'] = urldecode($this->input->get_post('redirect'));
		
		$this->data['role_tree'] = $this->role_model->get_tree();
		
		$this->data['isAjax'] = FALSE;
	}
	
	function index()
	{
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;		

		/*Load Parsing*/
		$js = $this->load->file('assets/beckend/my_js/acl_tree.js',true);		
		$this->template
		->set_title(lang('rule_page_name'))
		->set_css('js/fuelux-tree/fuelux.min')
		->set_css('css/simple-lists')
		->set_js('js/fuelux-tree/fuelux.tree-sampledata',true)
		->set_js('js/fuelux-tree/fuelux.tree.min',true)
		->set_js_script($js,'',true)
		->build('acl/rule-tree', $this->data);
	}
	
	function edit($role_id)
	{
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;
		if (!is_numeric($role_id) || $role_id < 1)
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));
		
		$this->load->model('acl/resource_model');
		$this->data['resources'] = $this->resource_model->get_tree();
		$this->data['role'] = $this->role_model->get_by_id($role_id);
		if ($this->data['role'])
		{
			if ($this->input->post('save-btn')) 
			{
				// Get attributes from posts.
				$attributes = array();
				$fields = array(
					'id',
					'rule_resource'
				);
				foreach ($fields as $field)
				{
					if ($this->input->post($field))
						$attributes[$field] = $this->input->post($field);
				}

				if (isset($attributes['id']))
				{
					$this->rule_model->update($attributes['id'], $attributes);			// Update rules
					$this->template->set_flashdata('info', lang('rule_updated'));
				}

				redirect($this->data['redirect']);
			}
			
			$rules = $this->rule_model->get_by_id($role_id);
			
			$this->load->library('Beam/Acl');
			$this->acl->build();
			$this->data['acl'] = $this->acl;
			
			$this->data['rules'] = array();
			foreach($rules as $rule)
				$this->data['rules'][$rule->resource_id] = $rule;

			// Load view			
			$this->template
			->set_title(lang('rule_page_name'))
			->set_css('js/fuelux-tree/fuelux.min')
			->set_css('css/simple-lists')
			->set_js('js/fuelux-tree/fuelux.tree-sampledata',true)
			->set_js('js/fuelux-tree/fuelux.tree.min',true)
			->set_js_script($js,'',true)
			->build('acl/rule-edit', $this->data);
		}
		else
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));
	}
	
	function _send_message_redirect($type, $message)
	{
		$this->template->set_flashdata($type, $message);
		redirect('acl/rule');
	}
	function ajax_tree(){
		$data = $this->role_model->get_tree();
		print_r(json_encode($data));
	}
}


/* End of file rule.php */
/* Location: ./application/modules/acl/controllers/rule.php */
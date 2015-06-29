<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Authorize extends MY_Controller 
{
	function index()
	{        
		// user is already logged in
        if ($this->auth->loggedin()) 
		{
            redirect($this->config->item('dashboard_uri'));
        }
		
		$this->load->language('auth');
		$type = base64_decode($this->input->post('type'));
        
        switch ($type) {
            case 'login':
                // form submitted
                if ($this->input->post('username') && $this->input->post('password')) 
                {
                    $remember = $this->input->post('remember') ? TRUE : FALSE;
                    
                    // get user from database
                    $user = $this->user_model->get_by_username($this->input->post('username'));
                    if ($user && $this->user_model->check_password($this->input->post('password'), $user->password))
                    {
                        // mark user as logged in
                        $this->auth->login($user->id, $remember);
                        
                        // Add session data
                        $this->session->set_userdata(array(
                            'lang'      => $user->lang,
                            'role_id'   => $user->role_id,
                            'role_name' => $user->role_name
                        ));
                        
                        redirect($this->config->item('dashboard_uri'));
                    }
                    else{
                        $this->template->add_message ('danger', lang('login_attempt_failed'));
                    }
                }
                
                if ($this->input->post('username'))
                    $this->data['username'] = $this->input->post('username');
                if ($this->input->post('remember'))
                    $this->data['remember'] = $this->input->post('remember');

                break;
            case 'register':
                break;
            case 'forgot':
                break;
            default:
                
                break;
        }
        //$this->template->add_message ('danger', lang('login_attempt_failed'));
        
        // show login form
        $this->load->helper('form');
		$this->template->set_layout('login')
        ->build('vauth');
	}
    function login_is_ajax(){
        // user is already logged in
        if(!$this->input->is_ajax_request()) show_404('pages' ,900 );
        $result =  array();
        if ($this->auth->loggedin()) 
        {
            redirect($this->config->item('dashboard_uri'));
        }
        
        $this->load->language('auth');
        // form submitted
        if ($this->input->post('username') && $this->input->post('password')) 
        {
            $remember = $this->input->post('remember') ? TRUE : FALSE;
            
            // get user from database
            $user = $this->user_model->get_by_username($this->input->post('username'));
            if ($user && $this->user_model->check_password($this->input->post('password'), $user->password))
            {
                // mark user as logged in
                $this->auth->login($user->id, $remember);
                
                // Add session data
                $this->session->set_userdata(array(
                    'lang'      => $user->lang,
                    'role_id'   => $user->role_id,
                    'role_name' => $user->role_name
                ));
                $result['rescode'] = 0;
                $result['message'] = "Login Success";
                //redirect($this->config->item('dashboard_uri'));
            }
            else{
                //$this->template->add_message ('danger', lang('login_attempt_failed'));
                $result['rescode'] = 1;
                $result['message'] = "Username and Password Not Match";
            }
        }
        
        if ($this->input->post('username'))
            $this->data['username'] = $this->input->post('username');
        if ($this->input->post('remember'))
            $this->data['remember'] = $this->input->post('remember');
        echo json_encode($result);
    }
}

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */
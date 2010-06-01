<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* This class is used to manage authentification in the TC forum
*/
class Auth
{

    var $CI; // Needed to access the Code Igniter object
    
    function Auth()
    {
        $this->CI =& get_instance();
        log_message('debug', 'Auth class loaded');
    }

	/**
	* Take a validated login and password, check the user can login, and redirect to the proper page
	*/
	function login($login, $md5Password) 
	{
		$this->CI->load->model('users_model');
		$valid = $this->CI->users_model->validate($login, $md5Password);
		if ($valid) // if the user's credentials are valid ...
		{
			$data = array(
				'username' => $login,
				'is_logged_in' => TRUE
			);
			$this->CI->session->set_userdata($data);
			redirect('forum/forum/forums');
		}
		else {
			redirect('login/index');
		}
	}
  
	/**
	* Checks the user session is valid
	*/
    function check ()
    {
        if (!$this->CI->session->userdata('username') OR !$this->CI->session->userdata('is_logged_in') == TRUE) 
		{
			redirect('login/index');
		}
	}
  
	/** 
	* Destroys the session and redirect the user to the login page
	*/
    function logout ()
    {
        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('is_logged_in');
        $this->CI->session->sess_destroy();
		redirect('login/index');
    }
}
?> 
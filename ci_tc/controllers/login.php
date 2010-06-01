<?php
class Login extends Controller{

	function index(){
		$data['main_menu'] = 'vide';
		$data['right_menu'] = 'vide';
		$data['main_header'] = 'includes/navigation_login';
		$data['main_content'] = 'login/login_form';
		$this->load->view('includes/template', $data);
	}
	
	function login_user() {
		// TODO: validate login/password (check it is not null, invalid chars were entered etc).
		// TODO: check the input was not null
		$login = $this->input->post('username');
		$md5Password = md5($this->input->post('password'));
		
		$this->auth->login($login, $md5Password);
	}
	
	function signup(){
		$data['main_content'] = 'login/signup_form';
		$this->load->view('includes/template', $data);
	}
	
	function create_member(){
		$this->load->library('form_validation');
		
		//$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		//$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_lenght[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_lenght[4]|max_lenght[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
			//$this->load->view('signup_form');
			$data['main_content'] = 'signup_form';
			$this->load->view('includes/template', $data);
		}
		else {
			$this->load->model('users_model');
			if ($query = $this->users_model->createUser())
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			}
			else {
				$this->load->view('signup_form');
			}
		}
	}
	
}
?>
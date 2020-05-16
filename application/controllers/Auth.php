<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Account_model');
		$this->load->model('Verification_model');
	}

	public function index() {
		$this->load->view('home');
	}

    public function signin() {
        if ($this->session->has_userdata('username')) {
			redirect('home');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == false){
				$this->load->view('signin');
			}
			else{
				$data = [
					'username' => $this->input->post('username', true),
					'password' => md5($this->input->post('password', true))
				];
				if ($this->Account_model->checkAccount($data)) {
					$account = $this->Account_model->getAccount($data['username']);
					$this->session->set_userdata('username', $account['username']);
					$this->session->set_userdata('role', $account['role']);
					$this->session->set_userdata('is_verified', $account['is_verified']);
					$this->session->set_userdata('profile_picture', $account['profile_picture']);
					if($this->session->userdata('is_verified') == 0){
						$this->session->set_userdata('verification_status', $this->Verification_model->getVerificationStatus($account['username']));
						echo $this->session->userdata('verification_status');
					}
					redirect('home');
				} else {
					$this->session->set_flashdata('error_message', 'Wrong username or password!');
					redirect('auth/signin');
				}
			}
		}
    }

    public function signup() {
        if ($this->session->has_userdata('username')) {
			redirect('home');
		} else {
			$this->form_validation->set_rules('first_name', 'First name','required');
			$this->form_validation->set_rules('username', 'Username','required');
			$this->form_validation->set_rules('email', 'Email','required');
			$this->form_validation->set_rules('password', 'Password','required');
			if ($this->form_validation->run() == false){
				$this->load->view('signup');
			}
			else{
				$data = [
					'first_name' => $this->input->post('first_name', true),
					'last_name' => $this->input->post('last_name', true),
					'username' => $this->input->post('username', true),
					'email' => $this->input->post('email', true),
					'password' => md5($this->input->post('password', true)),
					'profile_picture' => 'default_profile_picture.png',
					'is_verified' => 0,
					'role' => 'user',
					'account_time_created' => date('Y-m-d H:i:s')
				];
				if ($this->Account_model->createAccount($data)) {
					$this->session->set_flashdata('success_message', 'You can signin now!');
					redirect('auth/signin');
				} else {
					$this->session->set_flashdata('error_message', 'Signup failed!');
					redirect('auth/signup');
				}
			}
		}
    }

    public function signout() {
        $this->session->sess_destroy();
        redirect('home');
    }

	public function check_username(){
		$this->form_validation->set_rules('username', 'Username','required');
		if ($this->form_validation->run() == false){
			show_404();
		}
		else{
			if($this->Account_model->checkUsername($this->input->post('username', true))) {
				echo true;
			}else{
				echo false;
			}
		}
	}

	public function must_signin(){
		$this->session->set_flashdata('error_message', 'You have to sign in first!');
		redirect('auth/signin');
	}
}

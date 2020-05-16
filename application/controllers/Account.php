<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Account_model');
		$this->load->model('Question_model');
		$this->load->model('Verification_model');
	}

	public function settings()
	{
		if ($this->session->has_userdata('username')) {
			$data['account'] = $this->Account_model->getAccount($this->session->userdata('username'));
            $this->load->view('header_session');
            $this->load->view('search_box');
			$this->load->view('account_settings', $data);
		} else {
            redirect('home');
		}
	}

	public function upload_profile(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$config['upload_path']          = './assets/img/';
			$config['allowed_types']        = 'jpg|png';

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('profile_picture'))
			{
				$this->session->set_flashdata('error_message', 'Upload profile picture failed!');
				redirect('account/settings');
			}
			else
			{
				$file_name = array('profile_picture' =>$this->upload->data('file_name'));
				if($this->Account_model->changeProfilePicture($this->session->userdata('username'), $file_name)){
					$this->session->set_userdata('profile_picture', $file_name['profile_picture']);
					$this->session->set_flashdata('success_message', 'Change profile picture success!');
					redirect('account/settings');
				}
				$this->session->set_flashdata('error_message', 'Change profile picture failed!');
				redirect('account/settings');
			}
		}
		
	}

	public function upload_verification(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$config['upload_path']          = './assets/documents/';
			$config['allowed_types']        = 'pdf';

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('verification_document'))
			{
				$this->session->set_flashdata('error_message', 'Upload verification document failed!');
				redirect('account/settings');
			}
			else
			{
				$file_name = array('profile_picture' =>$this->upload->data('file_name'));
				$data = [
					'username' => $this->session->userdata('username'),
					'document' =>$this->upload->data('file_name'),
					'verification_status' => 'pending',
					'verification_time_submited' => date('Y-m-d H:i:s')
				];
				if($this->Verification_model->createVerification($data)){
					$this->session->set_userdata('verification_status', 'pending');
					$this->session->set_flashdata('success_message', 'Submit verification file success!');
					redirect('account/settings');
				}
				$this->session->set_flashdata('error_message', 'Submit verification file failed!');
				redirect('account/settings');
			}
		}
	}

	public function edit() {
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'First name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'account_time_edited' => date('Y-m-d H:i:s')
			];
			$check = [
				'username' => $this->session->userdata('username'),
				'password' => md5($this->input->post('password'))
			];
			if($this->Account_model->checkAccount($check)){
				if($this->Account_model->editAccount($check['username'], $data)) {
					$this->session->set_flashdata('success_message', 'Edit account success!');
					redirect('account/settings');
				}else{
					$this->session->set_flashdata('error_message', 'Edit account failed!');
					redirect('account/settings');
				}
			}else{
				$this->session->set_flashdata('error_message', 'Wrong password!');
				redirect('account/settings');
			}
		}
	}

	public function delete(){
		if($this->session->has_userdata('username')){
			$username = $this->session->userdata('username');
			if($this->Account_model->deleteAccount($username)) {
				redirect('auth/signout');
			}else{
				$this->session->set_flashdata('error_message', 'Delete account failed!');
				redirect('account/settings');
			}
		}else{
			show_404();
		}
		
	}

	public function my_question(){
		if ($this->session->has_userdata('username')) {
			$this->load->view('header_session');
			$this->load->view('search_box');
			$this->load->view('my_question');
		} else {
            show_404();
		}
	}

	public function json_my_question(){
		if ($this->session->has_userdata('username')) {
			$json = array('data' => $this->Question_model->getQuestionByUsername($this->session->userdata('username')));
			echo json_encode($json);
		}else{
			show_404();
		}
	}

	public function verification_request(){
		if ($this->session->userdata('role') == 'admin') {
			$this->load->view('header_session');
			$this->load->view('search_box');
			$this->load->view('verification_request');
		} else {
            redirect('home');
		}
	}

	public function json_verification_request(){
		if($this->session->userdata('role') == "admin"){
			$json = array('data' => $this->Verification_model->getVerificationRequest());
			echo json_encode($json);
		}else{
			show_404();
		}
		
	}

	public function accept_verification(){
		$this->form_validation->set_rules('verification_id', 'Verification ID', 'required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$verification_id = $this->input->post('verification_id');
			if($this->Verification_model->acceptVerification($verification_id)){
				$this->session->set_flashdata('success_message', 'Accept verification success!');
				redirect('account/verification_request');
			}else{
				$this->session->set_flashdata('error_message', 'Accept verification failed!');
				redirect('account/verification_request');
			}
		}	
	}
	public function decline_verification(){
		$this->form_validation->set_rules('verification_id', 'Verification ID', 'required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$verification_id = $this->input->post('verification_id');
			if($this->Verification_model->declineVerification($verification_id)){
				$this->session->set_flashdata('success_message', 'Decline verification success!');
				redirect('account/verification_request');
			}else{
				$this->session->set_flashdata('error_message', 'Decline verification failed!');
				redirect('account/verification_request');
			}
		}
	}

	public function change_password(){
		$this->form_validation->set_rules('old_password', 'Old Password','required');
		$this->form_validation->set_rules('new_password', 'New Password','required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$check = [
				'username' => $this->session->userdata('username'),
				'password' => md5($this->input->post('old_password'))
			];
			if($this->Account_model->checkAccount($check)){
				if($this->Account_model->changePassword($check['username'], md5($this->input->post('new_password')))) {
					$this->session->set_flashdata('success_message', 'Change password success!');
					redirect('account/settings');
				}else{
					$this->session->set_flashdata('error_message', 'Change password failed!');
					redirect('account/settings');
				}
			}else{
				$this->session->set_flashdata('error_message', 'Wrong old password!');
				redirect('account/settings');
			}
		}	
	}
}

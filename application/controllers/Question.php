<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Question_model');
		$this->load->model('Answer_model');
	}	
	public function index(){
		redirect('home');
	}

	public function post($slug){
		$data['question'] = $this->Question_model->getQuestion($slug);
		if($data['question'] != null) {
			$data['answer'] = $this->Answer_model->getAnswer($data['question']['question_id']);
			$this->Question_model->setViewsInc($data['question']['question_id']);
			if ($this->session->has_userdata('username')) {
				$this->load->view('header_session');
				$this->load->view('search_box');
				$this->load->view('question', $data);
			} else {
				$this->load->view('header_default');
				$this->load->view('search_box');
				$this->load->view('question', $data);
			}
		}else{
			show_404();
		}
		
	}
	public function create(){
		$this->form_validation->set_rules('title', 'Title','required');
		$this->form_validation->set_rules('content', 'Content','required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$data = [
				'username' => $this->session->userdata('username'),
				'title' => $this->input->post('title', true),
				'content' => $this->input->post('content', true),
				'question_time_created' => date('Y-m-d H:i:s'),
			];
	
			if($this->Question_model->createQuestion($data)){
				$question_id = $this->db->insert_id();
				$slug = url_title($data['title'], 'dash', true).'-'.$question_id;
				if($this->Question_model->setSlug($question_id, $slug)){
					$this->session->set_flashdata('success_message', 'Ask question success!');
					redirect('question/post/'.$slug);
				}
			}
		}
	}


	public function delete(){
		$this->form_validation->set_rules('question_id', 'Question ID','required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$question_id = $this->input->post('question_id');
			$slug = $this->Question_model->getSlug($question_id);
			if($this->Question_model->deleteQuestion($question_id)) {
				$this->session->set_flashdata('success_message', 'Delete question success!');
				redirect('question/deleted');
			}else{
				$this->session->set_flashdata('error_message', 'Delete question failed!');
				redirect('question/post/'.$slug);
			}
		}
	}

	public function deleted(){
		if ($this->session->has_userdata('username')) {
			$this->load->view('header_session');
			$this->load->view('search_box');
			$this->load->view('question_deleted');
		} else {
			$this->load->view('header_default');
			$this->load->view('search_box');
			$this->load->view('question_deleted');
		}
	}
	
	

	public function edit(){
		$this->form_validation->set_rules('question_id', 'Question ID','required');
		$this->form_validation->set_rules('title', 'Title','required');
		$this->form_validation->set_rules('content', 'Content','required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$question_id = $this->input->post('question_id');
			$data = [
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'question_time_edited' => date('Y-m-d H:i:s')
			];
			$slug = $this->Question_model->getSlug($question_id);
			if($this->Question_model->editQuestion($question_id, $data)) {
				$this->session->set_flashdata('success_message', 'Edit question success!');
				redirect('question/post/'.$slug);
			}else{
				$this->session->set_flashdata('error_message', 'Edit question failed!');
				redirect('question/post/'.$slug);
			}
		}
	}

}

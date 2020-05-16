<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Answer_model');
		$this->load->model('Question_model');
    }

	public function create(){
		$this->form_validation->set_rules('question_id', 'Question ID','required');
		$this->form_validation->set_rules('content', 'Content','required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$data = [
				'question_id' => $this->input->post('question_id', true),
				'username' => $this->session->userdata('username'),
				'content' => $this->input->post('content', true),
				'answer_time_created' => date('Y-m-d H:i:s')
			];
			$slug = $this->Question_model->getSlug($data['question_id']);
			if($this->Answer_model->createAnswer($data)){
				$this->session->set_flashdata('success_message', 'Create answer success!');
				redirect('question/post/'.$slug);
			}else{
				$this->session->set_flashdata('error_message', 'Create answer failed!');
				redirect('question/post'.$slug);
			}
		}
    }
    
    public function delete(){
		$this->form_validation->set_rules('question_id', 'Question ID','required');
		$this->form_validation->set_rules('answer_id', 'Answer ID','required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
		}
		$answer_id = $this->input->post('answer_id');
		$question_id = $this->input->post('question_id');
		$slug = $this->Question_model->getSlug($question_id);
		if($this->Answer_model->deleteAnswer($answer_id)) {
			$this->session->set_flashdata('success_message', 'Delete answer success!');
			redirect('question/post/'.$slug);
		}else{
			$this->session->set_flashdata('error_message', 'Delete answer failed!');
			redirect('question/post/'.$slug);
		}
    }
    
    public function edit(){
		$this->form_validation->set_rules('question_id', 'Question ID','required');
		$this->form_validation->set_rules('answer_id', 'Answer ID','required');
		$this->form_validation->set_rules('content', 'Content','required');
		if ($this->form_validation->run() == false){
			show_404();
		}else{
			$question_id = $this->input->post('question_id');
			$answer_id = $this->input->post('answer_id');
			$data = [
				'content' => $this->input->post('content'),
				'answer_time_edited' => date('Y-m-d H:i:s')
			];
			$slug = $this->Question_model->getSlug($question_id);
			if($this->Answer_model->editAnswer($answer_id, $data)) {
				$this->session->set_flashdata('success_message', 'Edit answer success!');
				redirect('question/post/'.$slug);
			}else{
				$this->session->set_flashdata('error_message', 'Edit answer failed!');
				redirect('question/post/'.$slug);
			}
		}
	}
}

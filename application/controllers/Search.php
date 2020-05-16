<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Question_model');
	}
	
	public function index()
	{
		$data['search_question'] = $this->input->get('q', true);
		$per_page = $this->input->get('per_page', true);
		$config['base_url'] = 'http://localhost/healthdocs/search';
		$config['total_rows'] = $this->Question_model->countSearchRows($data['search_question']);
		$config['per_page'] = 5;
		$config['enable_query_strings']  = true;
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_open'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$data['results'] = $this->Question_model->searchQuestion($data['search_question'], $config['per_page'], $per_page);
		$data['num_results'] = count($data['results']);
		if ($this->session->has_userdata('username')) {
			$this->load->view('header_session');
			$this->load->view('search_box');
			$this->load->view('search_result', $data);
		} else {
			$this->load->view('header_default');
			$this->load->view('search_box');
			$this->load->view('search_result', $data);
		}
	}

	public function latest_questions(){
		$config['base_url'] = 'http://localhost/healthdocs/search/latest_questions';
		$config['total_rows'] = $this->Question_model->countTodayQuestions();
		$config['per_page'] = 5;
		$start = $this->uri->segment(3);

		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_open'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$data['results'] = $this->Question_model->getLatestQuestions($config['per_page'], $start);
		if ($this->session->has_userdata('username')) {
			$this->load->view('header_session');
			$this->load->view('search_box');
			$this->load->view('latest_questions', $data);
		} else {
			$this->load->view('header_default');
			$this->load->view('search_box');
			$this->load->view('latest_questions', $data);
		}
	}

	public function trending_questions(){
		$config['base_url'] = 'http://localhost/healthdocs/search/trending_questions';
		$config['total_rows'] = $this->Question_model->countTodayQuestions();
		$config['per_page'] = 5;
		$start = $this->uri->segment(3);

		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_open'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$data['results'] = $this->Question_model->getTrendingQuestions($config['per_page'], $start);
		if ($this->session->has_userdata('username')) {
			$this->load->view('header_session');
			$this->load->view('search_box');
			$this->load->view('trending_questions', $data);
		} else {
			$this->load->view('header_default');
			$this->load->view('search_box');
			$this->load->view('trending_questions', $data);
		}
	}
}

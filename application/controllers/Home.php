<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if ($this->session->has_userdata('username')) {
			$this->load->view('header_session');
			$this->load->view('home');
		} else {
			$this->load->view('header_default');
			$this->load->view('home');
		}
	}

	public function about_us(){
		if ($this->session->has_userdata('username')) {
			$this->load->view('header_session');
			$this->load->view('search_box');
			$this->load->view('about_us');
		} else {
			$this->load->view('header_default');
			$this->load->view('search_box');
			$this->load->view('about_us');
		}
	}
}

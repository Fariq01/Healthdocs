<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {

    public function getQuestion($slug){
        $this->db->where('slug', $slug);
        $this->db->from('question');
        $this->db->join('account', 'question.username = account.username');
        return $this->db->get()->row_array();
    }

    public function getQuestionByUsername($username){
        $this->db->select('question_id, title, slug,views, question_time_created, question_time_edited');
        $this->db->where('username', $username);
        $this->db->from('question');
        return $this->db->get()->result_array();
    }

    public function createQuestion($data){
        return $this->db->insert('question', $data);
    }

    public function setSlug($question_id, $slug){
        return $this->db->update('question', array('slug' => $slug), array('question_id' => $question_id));
    }

    public function getSlug($question_id){
        $this->db->where('question_id', $question_id);
        return $this->db->get('question')->row_array()['slug'];
    }

    public function setViewsInc($question_id){
        $this->db->where('question_id', $question_id);
        $this->db->set('views', 'views+1', FALSE);
        $this->db->update('question');
    }

    public function deleteQuestion($question_id){
        $this->db->delete('answer', array('question_id' => $question_id));
        return $this->db->delete('question', array('question_id' => $question_id));
    }

    public function editQuestion($question_id, $data){
        return $this->db->update('question', $data, array('question_id' => $question_id));
    }

    public function searchQuestion($search, $limit, $start) {
        $this->db->like('title', $search);
        return $this->db->get('question', $limit, $start)->result_array();
    }

    public function countSearchRows($search){
        $this->db->like('title', $search);
        return $this->db->get('question')->num_rows();
    }

    public function countTodayQuestions(){
        $this->db->where('question_time_created', date('Y-m-d'));
        return $this->db->get('question')->num_rows();
    }
    public function getLatestQuestions($limit, $start) {
        $date = array('question_time_created >=' => date('Y-m-d 00:00:00'), 'question_time_created <=' => date('Y-m-d 23:59:59'));
        $this->db->where($date);
        $this->db->order_by('question_time_created', 'DESC');
        return $this->db->get('question', $limit, $start)->result_array();
    }

    public function getTrendingQuestions($limit, $start) {
        $date = array('question_time_created >=' => date('Y-m-d 00:00:00'), 'question_time_created <=' => date('Y-m-d 23:59:59'));
        $this->db->order_by('views', 'DESC');
        return $this->db->get('question', $limit, $start)->result_array();
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_model extends CI_Model {
    
    public function getAnswer($question_id){
        $this->db->where('question_id', $question_id);
        $this->db->from('answer');
        $this->db->join('account', 'answer.username = account.username');
        return $this->db->get()->result_array();
    }

    public function createAnswer($data){
        return $this->db->insert('answer', $data);
    }

    public function deleteAnswer($answer_id){
        return $this->db->delete('answer', array('answer_id' => $answer_id));
    }

    public function editAnswer($answer_id, $data){
        return $this->db->update('answer', $data, array('answer_id' => $answer_id));
    }
}

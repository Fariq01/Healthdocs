<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
    
    public function __construct() {
		parent::__construct();
		$this->load->model('Question_model');
    }
    
    public function checkAccount($data) {
        $this->db->where($data);
        if ($this->db->get('account')->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createAccount($data) {
		return $this->db->insert('account', $data);
	}

	public function checkUsername($username) {
		$this->db->where('username', $username);
		if ($this->db->get('account')->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
    }
    
    public function getAccount($username) {
        $this->db->where('username', $username);
        return $this->db->get('account')->row_array();
    }

    public function editAccount($username, $data){
        return $this->db->update('account', $data, array('username' => $username));
    }

    public function changeProfilePicture($username, $photo_profile){
        return $this->db->update('account', $photo_profile, array('username' => $username));
    }

    public function deleteAccount($username){
        $question = $this->Question_model->getQuestionByUsername($username);
        foreach ($question as $q) {
            $this->Question_model->deleteQuestion($q['question_id']);
        }
        return $this->db->delete('account', array('username' => $username));
    }


    public function changePassword($username, $new_password){
        return $this->db->update('account', array('password' => $new_password), array('username' => $username));
    }
}

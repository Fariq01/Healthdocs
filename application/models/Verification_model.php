<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verification_model extends CI_Model {

    public function createVerification($data){
        return $this->db->insert('verification', $data);
    }

    public function getVerificationRequest(){
        $this->db->where('verification_status', 'pending');
        return $this->db->get('verification')->result_array();
    }

    public function acceptVerification($verification_id){
        $this->db->where('verification_id', $verification_id);
        $this->db->from('verification');
        $this->db->join('account', 'verification.username = account.username');
        $this->db->update('verification', array('verification_status' => 'accepted', 'verification_time_accepted' => date('Y-m-d H:i:s')));
        return $this->db->update('account', array('is_verified' => 1));
    }

    public function declineVerification($verification_id){
        $this->db->where('verification_id', $verification_id);
        return $this->db->update('verification', array('verification_status' => 'declined', 'verification_time_declined' => date('Y-m-d H:i:s')));
    }

    public function getVerificationStatus($username){
        $this->db->where('username', $username);
        $this->db->order_by('verification_time_submited', 'DESC');
        $result = $this->db->get('verification')->row_array();
        if($result != null){
            return $result['verification_status'];
        }else {
            return 'not submited';
        }
    }
}

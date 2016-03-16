<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertNewUser($data) {
        return $this->db->insert('users', $data);
    }

    public function loginUser($data) {
        $this->db->select('id,username,user_type,password');
        $this->db->where('username', $data['username']);
        $query = $this->db->get('users');
        $result = $query->row_array();

        if ($result) {
            if(!password_verify($data['password'], $result['password'])) {
                return false;
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

}
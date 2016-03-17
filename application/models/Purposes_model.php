<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purposes_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_purposes() {
        $this->db->select('id,purpose as name');
        $query = $this->db->get('Purposes');
        return $query->result_array();
    }

    public function get_purpose($id) {
        $this->db->select('id,purpose as name');
        $this->db->where('id', $id);
        $query = $this->db->get('Purposes');
        return $query->row_array();
    }

    public function update_purpose($data) {
        $this->db->set('purpose', $data['name']);
        $this->db->where('id', $data['id']);
        $query = $this->db->update('Purposes');
        return $this->db->affected_rows();
    }

    public function add_purpose($data) {
        $insertData = array(
            'purpose' => $data['name']
        );
    
        return $this->db->insert('Purposes',$insertData);
    }

    public function delete_purpose($id) {
        return $this->db->delete('Purposes',array('id' => $id));
    }

}
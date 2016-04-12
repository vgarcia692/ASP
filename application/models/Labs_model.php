<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Labs_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_labs() {
        $query = $this->db->get('Labs');
        return $query->result_array();
    }

    public function get_all_purposes() {
        $this->db->select('id,purpose');
        $query = $this->db->get('Purposes');
        return $query->result_array();
    }

    public function get_all_courses() {
        $this->db->select('id,course');
        $query = $this->db->get('Courses');
        return $query->result_array();
    }

    public function get_lab($labId) {
        $this->db->select('id,name,capacity');
        $this->db->where('id',$labId);
        $query = $this->db->get('Labs');
        return $query->row_array();
    }

    public function get_lab_id($labName) {
        $this->db->select('id');
        $this->db->where('name',$labName);
        $query = $this->db->get('Labs');
        return $query->row_array();
    }

    public function validate_purpose($name) {
        $this->db->where('purpose', $name);
        $query = $this->db->get('Purposes');
        return $query->num_rows();
    }

    // GET CHECKINS IN PARTICULAR LAB
    public function get_all_lab_checkins($labId) {
        $query = "SELECT l.id, l.checkIn, s.name, CONCAT(l.name, '-',l.userType) as nonStudent FROM LabLogs l LEFT JOIN Students s ON s.id = l.StudentId WHERE l.checkIn IS NOT NULL AND l.checkOut IS NULL AND l.LabId=".$labId;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function update_lab($data) {
        $this->db->set('name', $data['name']);
        $this->db->where('id', $data['id']);
        $query = $this->db->update('Labs');
        return $this->db->affected_rows();
    }

    public function add_lab($data) {
        $insertData = array(
            'name' => $data['name']
        );
    
        return $this->db->insert('Labs',$insertData);
    }

    public function delete_lab($id) {
        return $this->db->delete('Labs',array('id' => $id));
    }

}
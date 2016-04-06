<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function validate_student($studentId) {

        $this->db->where('studNo', $studentId);
        $query = $this->db->get('Students');
        return $query->num_rows();
    }

    public function get_all_students() {
        $this->db->select('id,studNo,name');
        $this->db->order_by('name','ASC');
        $query = $this->db->get('Students');
        return $query->result_array();
    }

    public function get_student($id) {
        $this->db->select('id,studNo,name');
        $this->db->where('id', $id);
        $query = $this->db->get('Students');
        return $query->row_array();
    }

    public function get_student_by_studNo($studNo) {
        $this->db->select('id,studNo,name');
        $this->db->where('studNo', $studNo);
        $query = $this->db->get('Students');
        return $query->row_array();
    }

    public function update_student($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('studNo', $data['studNo']);
        $this->db->where('id', $data['id']);
        $query = $this->db->update('Students');
        return $this->db->affected_rows();
    }

    public function add_student($data) {
        $insertData = array(
            'name' => $data['name'],
            'studNo' => $data['studNo']
        );
    
        return $this->db->insert('Students',$insertData);
    }

    public function delete_student($id) {
        return $this->db->delete('Students',array('id' => $id));
    }

}
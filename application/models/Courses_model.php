<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_Courses() {
        $this->db->select('id,course as name');
        $query = $this->db->get('Courses');
        return $query->result_array();
    }

    public function get_course($id) {
        $this->db->select('id,course as name');
        $this->db->where('id', $id);
        $query = $this->db->get('Courses');
        return $query->row_array();
    }

    public function update_course($data) {
        $this->db->set('course', $data['name']);
        $this->db->where('id', $data['id']);
        $query = $this->db->update('Courses');
        return $this->db->affected_rows();
    }

    public function add_course($data) {
        $insertData = array(
            'course' => $data['name']
        );
    
        return $this->db->insert('Courses',$insertData);
    }

    public function delete_course($id) {
        return $this->db->delete('Courses',array('id' => $id));
    }

}
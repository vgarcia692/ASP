<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Labs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('labs_model');
        $this->load->model('logs_model');
        $this->load->model('students_model');
        $this->load->library('form_validation');
    }

    // SELECT LAB PAGE
    public function labSelect() {
        if (!isset($_SESSION['userType'])) {
            redirect('/');
        }

        // GET ALL LAB NAMES WITH ID
        $data['labs'] = $this->labs_model->get_all_labs();

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('lab/lab_select', $data);
        $this->load->view('templates/footer');
    }

    // IN CURRENT LAB SELECTED
    public function lab($labId) {

        $data = array();
        $data['labInfo'] = $this->labs_model->get_lab($labId);
        $data['purposes'] = $this->labs_model->get_all_purposes();
        $data['courses'] = $this->labs_model->get_all_courses();
        $data['currentCheckedIns'] = $this->labs_model->get_all_lab_checkins($labId);
        $data['checkIn'] = array();
        for ($i=0; $i < count($data['currentCheckedIns']); $i++) { 
            $dateObject = date_create($data['currentCheckedIns'][$i]['checkIn']);
            $data['currentCheckedIns'][$i]['checkIn'] = date_format($dateObject, 'M d, Y H:i');
        }
        $data['jsonCheckIns'] = json_encode($data['currentCheckedIns']);

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('lab/lab', $data);
        $this->load->view('templates/footer');
    }

    // PROCESS THE LAB SELECTED
    public function processLabSelect() {
        if (!isset($_SESSION['userType'])) {
            redirect('/');
        }

        $labId = $this->input->post('lab');

        $this->lab($labId);

    }

    public function addNewLog() {
        if(!$this->input->post('isNotStudent')) {
            $this->form_validation->set_rules('studentId', 'Student ID', 'required|callback_validate_student');
            $this->form_validation->set_message('validate_student', 'Student Not Found.');
        } else {
            $this->form_validation->set_rules('user', 'User Type', 'required');
            $this->form_validation->set_rules('userName', 'User Name', 'required');
        }

        $this->form_validation->set_rules('purpose', 'Purpose', 'required|callback_validate_purpose');
        $this->form_validation->set_message('validate_purpose', 'Purpose Not Found.');
        $this->form_validation->set_rules('purposeDetail', 'Purpose Detail', 'required');
        $this->form_validation->set_rules('course', 'Course', 'required');

        if ($this->form_validation->run() == FALSE) {
                $this->processLabSelect($this->input->post('labId'));
        } else {

            $data = array();

            if (!$this->input->post('isNotStudent')) {
                $data['studentId'] = $this->input->post('studentId');
            } else {
                $data['user'] = $this->input->post('user');
                $data['userName'] = $this->input->post('userName');
            }

            $data['labId'] = $this->input->post('labId');
            $data['purpose'] = $this->input->post('purpose');
            $data['purposeDetail'] = $this->input->post('purposeDetail');
            $data['courseId'] = $this->input->post('course');

            $result = $this->logs_model->add_new_lab_log($data);
            if(!$result) {
                $this->session->set_flashdata('labLogMessage', 'Could Not Add New Lab Log.');
                $this->lab($this->input->post('labId'));
            } else {
                $this->session->set_flashdata('labLogMessage', 'New Lab Log Added.');
                $this->lab($this->input->post('labId'));
            }

        }  

    }

    public function checkout($id) {
        $this->logs_model->checkout_user($id);
    }


    // CHECK FOR EXISTING STUDENT BEFORE CHECKING THEM IN
    public function validate_student($str) {
        if($this->students_model->validate_student($str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // CHECK FOR EXISTING PURPOSE FROM AUTOCOMPLETE
    public function validate_purpose($str) {
        if($this->labs_model->validate_purpose($str)) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

}
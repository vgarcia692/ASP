<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('logs_model');
        $this->load->model('labs_model');
        $this->load->model('students_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
    }

    public function logLabs() {
        $data['labs'] = $this->labs_model->get_all_labs();

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('logs/log_labs', $data);
        $this->load->view('templates/footer');
    }

    public function allLogs($labId) {
        if (!$this->session->userType=='admin') {
            redirect('/');
        }

        // PAGINATION CONFIG
        $pagConfig['base_url'] = base_url('logs/allLogs'.'/'.$labId);
        $pagConfig['total_rows'] = $this->logs_model->logs_record_count($labId);   
        $pagConfig['per_page'] = 20;   
        $this->pagination->initialize($pagConfig);
        $data['pagnation_links'] = $this->pagination->create_links();
            
        // GET ALL LOGS
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['logs'] = $this->logs_model->get_all_logs($pagConfig['per_page'],$data['page'],$labId);

        // GET ALL LAB NAMES WITH ID
            $data['labs'] = $this->labs_model->get_all_labs();
                // ADD A BLANK OPTION FOR THE DROPDOWN LIST
                array_unshift($data['labs'], array('id'=>NULL,'name'=>''));
        
        $data['lab'] = $labId;

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('logs/log_review', $data);
        $this->load->view('templates/footer');
    }

    // GO TO CERTAIN LOG FOR EDITING
    public function editLog($logId,$page) {

        $data['page'] = $page;

        if (!$this->session->userType) {
            redirect('/');
        }

        // GET ALL LAB NAMES WITH ID
        $data['labs'] = $this->labs_model->get_all_labs();
        // GET ALL COURSES
        $data['courses'] = $this->labs_model->get_all_courses();
        // GET ALL PURPOSES
        $data['purposes'] = $this->labs_model->get_all_purposes();

        
        $data['log'] = $this->logs_model->get_log($logId);
        $data['log']['checkIn'] = date_format(date_create($data['log']['checkIn']), "Y-m-d\TH:i");
        if (isset($data['log']['checkOut'])) {
            $data['log']['checkOut'] = date_format(date_create($data['log']['checkOut']), "Y-m-d\TH:i");   
        }
        
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('logs/edit_log', $data);
        $this->load->view('templates/footer');
    }

    // PROCESS EDIT ON LOG
    public function processEdit() {
        if (!empty($_POST['studNo'])) {
            $this->form_validation->set_rules('studNo', 'Student ID', 'required|callback_validate_student');
            $this->form_validation->set_message('validate_student', 'Student Not Found.');
        }
        $this->form_validation->set_rules('purpose', 'Purpose', 'required|callback_validate_purpose');
        $this->form_validation->set_message('validate_purpose', 'Purpose Not Found.');
        $this->form_validation->set_rules('lab', 'Lab', 'required');
        $this->form_validation->set_rules('courseId', 'Course', 'required');
        $this->form_validation->set_rules('purposeDetail', 'Purpose Detail', 'required');
        $this->form_validation->set_rules('checkIn', 'Check In DateTime', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->editLog($this->input->post('id'));
        } else {
            $updateData = array(
                'id' => $this->input->post('id'),
                'checkIn' => $this->input->post('checkIn'),
                'checkOut' => $this->input->post('checkOut'),
                'purposeDetail' => $this->input->post('purposeDetail'),
                'courseId' => $this->input->post('courseId'),
                'purpose' => $this->input->post('purpose'),
                'lab' => $this->input->post('lab')
            );

            if (isset($_POST['studNo']) && $_POST['studNo']!= '') {
                $updateData['studNo'] = $this->input->post('studNo');
            } else {
                $updateData['userType'] = $this->input->post('userType');
                $updateData['name'] = $this->input->post('name');
            }

            $pageNum = $this->input->post('page');

            $result = $this->logs_model->update_log($updateData);
            if($result) {
                // Get the Lab ID to bring back to original page of allLogs
                $lab = $this->labs_model->get_lab_id($updateData['lab']);

                $this->session->set_flashdata('labEditMessage','Successfully Updated Lab Log');
                redirect(base_url('logs/allLogs/'.$lab['id'].'/'.$pageNum));
            } else {
                $this->session->set_flashdata('labEditMessage','Unable to Update Lab Log');
                redirect(base_url('logs/editLog/'.$updateData['id']));
            }
        }
        
    }

    public function proccessDeleteLog($logId,$lab) {
        $result = $this->logs_model->delete_log($logId);

        if ($result) {
            $this->session->set_flashdata('deleteMessage', 'Successfull Deleted Log');
            redirect(base_url('logs/allLogs/'.$lab));
        } else {
            $this->session->set_flashdata('deleteMessage', 'Failed to Delete Log');
            redirect(base_url('logs/allLogs/'.$lab));
        }
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
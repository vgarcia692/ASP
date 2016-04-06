<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('labs_model');
        $this->load->model('students_model');
        $this->load->model('courses_model');
        $this->load->model('purposes_model');
    }

    public function settingsSelect() {
        if ($this->session->userType!=='admin') {
            redirect('/');
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('settings/select_settings');
        $this->load->view('templates/footer');
    }

    public function editView($type) {
        
        
        switch ($type) {
            case 'lab':
                $data['data'] = $this->labs_model->get_all_labs();
                break;
            case 'course':
                $data['data'] = $this->courses_model->get_all_courses();
                break;
            case 'purpose':
                $data['data'] = $this->purposes_model->get_all_purposes();
                break;
            case 'student':
                $data['data'] = $this->students_model->get_all_students();
                break;
        }

        $data['type'] = $type; 

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('settings/edit_view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($type,$id) {
        switch ($type) {
            case 'lab':
                $data['data'] = $this->labs_model->get_lab($id);
                break;
            case 'course':
                $data['data'] = $this->courses_model->get_course($id);
                break;
            case 'purpose':
                $data['data'] = $this->purposes_model->get_purpose($id);
                break;
            case 'student':
                $data['data'] = $this->students_model->get_student($id);
                break;
        }
        $data['type'] = $type;

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('settings/edit_data', $data);
        $this->load->view('templates/footer');
    }

    public function proccessEdit() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        if (isset($_POST['studNo'])) {
            $this->form_validation->set_rules('studNo', 'Student ID', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('type'),$this->input->post('id'));
        } else {
            $result = FALSE;
            $type = $this->input->post('type');
            $insertData = array();
            $insertData['id'] = $this->input->post('id');
            $insertData['name'] = $this->input->post('name');
            if (isset($_POST['studNo'])) {
                $insertData['studNo'] = $this->input->post('studNo');
            }

            switch ($type) {
                case 'lab':
                    $result = $this->labs_model->update_lab($insertData);
                    break;
                case 'course':
                    $result = $this->courses_model->update_course($insertData);
                    break;
                case 'purpose':
                    $result = $this->purposes_model->update_purpose($insertData);
                    break;
                case 'student':
                    $result = $this->students_model->update_student($insertData);
                    break;
            }

            if ($result) {
                $this->session->set_flashdata('updateMessage', 'Update Successfull');
                redirect(base_url('settings/edit/'.$type.'/'.$this->input->post('id')));
            } else {
                $this->session->set_flashdata('updateMessage', 'Failed to Update');
                redirect(base_url('settings/edit/'.$type.'/'.$this->input->post('id')));
            }
        }

    }

    public function addView($type) {
        $data['type'] = $type;

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('settings/add_data', $data);
        $this->load->view('templates/footer');
    }

    public function proccessAdd() {
        $type = $this->input->post('type');
        $table = ucfirst($type).'s';
        $nameField = '';
        switch ($type) {
                case 'lab':
                case 'student':
                    $nameField = 'name';
                    break;
                case 'course':
                    $nameField = 'course';
                    break;
                case 'purpose':
                    $nameField = 'purpose';
                    break;
            }

        $this->form_validation->set_rules('name', 'Name', 'required|is_unique['.$table.'.'.$nameField.']');
        if (isset($_POST['studNo'])) {
            $this->form_validation->set_rules('studNo', 'Student ID', 'required|is_unique[students.studNo]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->addView($this->input->post('type'));
        } else {
            $result = FALSE;
            $addData = array();
            $addData['name'] = $this->input->post('name');
            if (isset($_POST['studNo'])) {
                $addData['studNo'] = $this->input->post('studNo');
            }

            switch ($type) {
                case 'lab':
                    $result = $this->labs_model->add_lab($addData);
                    break;
                case 'course':
                    $result = $this->courses_model->add_course($addData);
                    break;
                case 'purpose':
                    $result = $this->purposes_model->add_purpose($addData);
                    break;
                case 'student':
                    $result = $this->students_model->add_student($addData);
                    break;
            }

            if ($result) {
                $this->session->set_flashdata('addMessage', 'Successfull Added New'.$this->input->post('type'));
                redirect(base_url('settings/addView/'.$type));
            } else {
                $this->session->set_flashdata('addMessage', 'Failed to Add '.$this->input->post('type'));
                redirect(base_url('settings/addView/'.$type));
            }
        }  
    }

    public function deleteView($type) {
        
        
        switch ($type) {
            case 'lab':
                $data['data'] = $this->labs_model->get_all_labs();
                break;
            case 'course':
                $data['data'] = $this->courses_model->get_all_courses();
                break;
            case 'purpose':
                $data['data'] = $this->purposes_model->get_all_purposes();
                break;
        }

        $data['type'] = $type; 

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('settings/delete_view', $data);
        $this->load->view('templates/footer');
    }

    public function proccessDelete($type,$id) {
        $result = FALSE;

        switch ($type) {
            case 'lab':
                $result = $this->labs_model->delete_lab($id);
                break;
            case 'course':
                $result = $this->courses_model->delete_course($id);
                break;
            case 'purpose':
                $result = $this->purposes_model->delete_purpose($id);
                break;
            case 'student':
                $result = $this->students_model->delete_student($id);
                break;
        }

        if ($result) {
            $this->session->set_flashdata('deleteMessage', 'Successfull Deleted '.ucfirst($type));
            redirect(base_url('settings/deleteView/'.$type));
        } else {
            $this->session->set_flashdata('deleteMessage', 'Failed to Delete '.ucfirst($type));
            redirect(base_url('settings/deleteView/'.$type));
        }
          
    }

}

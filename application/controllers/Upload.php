<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('logs_model');
        $this->load->library('form_validation');
    }

    public function uploadForm() {
        if ($this->session->userType!=='admin') {
            redirect('/');
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('logs/upload');
        $this->load->view('templates/footer');
    }

    public function processUpload() {
        $this->form_validation->set_rules('upload', 'CSV FILE', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->uploadForm();
        }

        $fileName = base_url('uploads/'.$this->uploadFile());

        $csv = array_map('str_getcsv', file($fileName));

        if ($this->input->post('includesFields')) {
            array_shift($csv);    
        }

        // CHECK THE FIRST ELEMENT OF FIRST ARRAY TO SEE IF IT IS THE HEADER OR A DATE
        // SEEING IF THE FIELDS WERE INCLUDED OR NOT
        $validDate = $this->validateDate($csv[0][0]);
        if ($validDate) {
            $result = $this->logs_model->upload_logs($csv);
            if($result) {
                $this->session->set_flashdata('uploadMessage', 'Upload Successfull.');
                redirect(base_url('upload/uploadForm'));
            } else {
                $this->session->set_flashdata('uploadMessage', 'Could not upload CSV file, please check that the file is valid.');
                redirect(base_url('upload/uploadForm'));
            }
            
        } else {
            $this->session->set_flashdata('uploadMessage', 'Could not upload CSV file, please check that the file is valid.');
            redirect(base_url('upload/uploadForm'));
        }
        
    }

    public function uploadFile() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '5000';
        
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            echo $this->upload->display_errors();
        } else {
            return $this->upload->data('file_name');
        }

    }

    private function validateDate($date) {
        if (strtotime($date) == FALSE) {
            return FALSE;
        } else { 
            return TRUE;
        }
    }

}
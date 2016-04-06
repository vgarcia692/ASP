<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('labs_model');
        $this->load->model('logs_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function totalVisits() {
        $data['labs'] = $this->labs_model->get_all_labs();

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('reports/total_visits', $data);
        $this->load->view('templates/footer');
    } 

    public function processVisitRange() {
        $this->form_validation->set_rules('startingDate', 'Starting Date', 'required');
        $this->form_validation->set_rules('endingDate', 'Ending Date', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(false);
            die();
        }

        $whereData = array(
            'labId' => $this->input->post('lab'),
            'startingDate' => $this->input->post('startingDate'),
            'endingDate' => $this->input->post('endingDate')
        );

        $result = $this->logs_model->get_total_visits($whereData);

        echo json_encode($result);
    }
}
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public totalVisits() {
        
    } 
}
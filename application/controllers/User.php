<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard() {
        if(!isset($_SESSION['userType'])) {
            redirect('/');
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('users/dashboard');
        $this->load->view('templates/footer');
    }

}
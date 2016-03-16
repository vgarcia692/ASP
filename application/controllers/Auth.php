<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('auth_model');
    }

    public function signup()
    {
        if (!$this->session->userType=='admin') {
            redirect('/');
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('auth/signup');
        $this->load->view('templates/footer');
    }

    public function login()
    {

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );

        $result = $this->auth_model->loginUser($data);
            
        if (!$result) {
            $_SESSION['loginMessage'] = 'Failed to login.';
            $this->session->mark_as_flash('loginMessage');
            redirect('/');
        } else {
            $_SESSION['userType'] = $result['user_type'];
            $_SESSION['userId'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            redirect('user/dashboard');
        }

    }

    public function logout()
    {
        unset(
            $_SESSION['userType'],
            $_SESSION['userId'],
            $_SESSION['username']
        );

        redirect(base_url());
    }

    public function processSignup()
    {
        // ADD CLAUSE FOR AN ADMIN VIEW ONLY
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passwordConfirm', 'Password Confirm', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
                $this->signup();
        }
        else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );

            $result = $this->auth_model->insertNewUser($data);  
            if ($result) {
                    $_SESSION['signUpMessage'] = 'SignUp Successful';
                 } else {
                     $_SESSION['signUpMessage'] = 'SignUp Failed';
                 }

            $this->session->mark_as_flash('signUpMessage');
            redirect('/auth/signup');
                      
        }

    }


}
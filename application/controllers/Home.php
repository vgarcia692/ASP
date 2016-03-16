<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function view($page = 'login')
    {
        if (! file_exists(APPPATH.'/views/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }
        
        $this->load->helper('url');
        $this->load->helper('html');

        $data['title'] = ucfirst($page); // Capitalize the first letter


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view($page, $data);
        $this->load->view('templates/footer', $data);
    }
}
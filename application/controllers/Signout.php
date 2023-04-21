<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Signout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');

    }

    public function index()
    {
        $this->session->sess_destroy();
        redirect(site_url('web'), 'reload');
    }
}

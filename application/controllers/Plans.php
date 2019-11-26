<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Common_model');
        $this->load->model('Poll_icons_model');
        $this->load->model('Vote_model');
        $this->load->model('Poll_model');
        $this->load->helper('cookie');
        if (!$this->session->has_userdata('company_id')) {
            redirect('Authentication/index');
        } 

    }
    public function index(){
        $data = array();
        $this->load->view('plans/plans', $data);
    }
}
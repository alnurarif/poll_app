<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Verification_email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Common_model');
        $this->load->model('Company_model');

    }
    public function index()
    {
        redirect('Home');
    }
    public function not_verified($id = ""){
        $data = array();
        $data['company'] = $this->Common_model->getDataById($id,'tbl_companies');
        $data['main_content'] = $this->load->view('verification_email/not_verified', $data, TRUE);
        $this->load->view('template/common_template', $data);
    }
    public function send_verification_mail(){
        $data = array();
        $data['main_content'] = $this->load->view('verification_email/verification_mail_sent', $data, TRUE);
        $this->load->view('template/common_template', $data);   
    }
}
?>
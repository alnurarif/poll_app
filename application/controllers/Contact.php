<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Common_model');

    }
    public function index(){
      $data = array();
        $data['main_content'] = $this->load->view('contact/contact', $data, TRUE);
        $this->load->view('template/common_template', $data);
    }
}
?>
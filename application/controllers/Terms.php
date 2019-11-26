<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');

    }
    public function index(){
        $data = array();
        $this->load->view('terms/terms', $data);
    }
}
?>
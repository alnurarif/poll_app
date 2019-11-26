<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class How_to_use_our_site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');

    }
    public function index(){
      $data = array();
        $data['main_content'] = $this->load->view('how_to_use_our_site/how_to_use_our_site', $data, TRUE);
        $this->load->view('template/common_template', $data);
    }
}
?>
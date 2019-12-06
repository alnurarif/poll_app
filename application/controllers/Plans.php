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
        // if (!$this->session->has_userdata('company_id')) {
        //     redirect('Authentication/index');
        // } 

    }
    public function index(){
        $data = array();
        $this->load->view('plans/plans', $data);
    }
    public function test_ipn()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST'){
            redirect('Plans');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"cmd=_notify-validate".http_build_query($this->input->post()));

        $response = curl_exec($ch);
        curl_close($ch);
        // file_put_contents("test.txt", $response);
        $this->load->helper('file');
        if ( ! write_file(FCPATH.'/assets/test.txt', $response))
        {
        echo 'Unable to write the file';
        }
        else
        { 
        echo 'File written!';
        }
    }
}
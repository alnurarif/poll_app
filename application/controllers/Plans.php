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
        $this->load->model('Payment_model');
        $this->load->helper('cookie');
        // if (!$this->session->has_userdata('company_id')) {
        //     redirect('Authentication/index');
        // } 

    }
    public function index(){
        $data = array();
        $this->load->view('plans/plans', $data);
    }
    public function IPN_Listener()
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
        curl_setopt($ch, CURLOPT_POSTFIELDS,"cmd=_notify-validate&".http_build_query($this->input->post()));

        $response = curl_exec($ch);
        curl_close($ch);
        // file_put_contents("test.txt", $response);
        // 
        $text = '';
        if($response=="VERIFIED"){
            $payment_info = array();
            $payment_info['company_id'] = $this->input->post('company_id');
            $payment_info['product_id'] = $this->input->post('product_id');
            $payment_info['txn_id'] = $this->input->post('txn_id');
            $payment_info['payment_gross'] = $this->input->post('amount');
            $payment_info['currency_code'] = $this->input->post('mc_currency');
            $payment_info['payer_email'] = $this->input->post('payer_email');
            $payment_info['payment_status'] = $this->input->post('payment_status');
            $payment_info['created_at'] = date('Y-m-d H:i:s');
            $id = $this->Common_model->insertInformation($payment_info, "tbl_payments");   
        }
        $text .= $this->session->userdata('company_id');
        $this->load->helper('file');
        if ( ! write_file(FCPATH.'/assets/test.txt', $text))
        {
        echo 'Unable to write the file';
        }
        else
        { 
        echo 'File written!';
        }
    }
}
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

        $id = $this->input->post('id');
        $data = array();
        $data['company'] = $company = $this->Common_model->getDataById($id,'tbl_companies');
        
        $message = $this->load->view('email/verification_email',$data,true);

        $config = Array(
            'protocol' => 'sendmail',
            'mailpath' => '/usr/sbin/sendmail',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('alnursarwer@gmail.com'); // change it to yours
        $this->email->to('alnurarif@yahoo.com');// change it to yours
        $this->email->subject('Verify Account');
        $this->email->message($message);
        if($this->email->send()){
            $data['main_content'] = $this->load->view('verification_email/verification_mail_sent', $data, TRUE);
            $this->load->view('template/common_template', $data); 
        }else{
            show_error($this->email->print_debugger());
        }
        
          
    }
}
?>
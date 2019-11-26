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
        
        //Send Password by Email
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $id = $this->input->post('id');
        
        $data = array();
        $data['company'] = $company = $this->Common_model->getDataById($id,'tbl_companies');
        
        $mesg = $this->load->view('email/verification_email',$data,true);
        

        $this->email->to('alnurarif@yahoo.com');
        $this->email->from('alnursarwer@gmail.com', 'AlNurArif');
        $this->email->subject("Verify Account");
        $this->email->message($mesg);
        $mail = $this->email->send();


        $data['main_content'] = $this->load->view('verification_email/verification_mail_sent', $data, TRUE);
        $this->load->view('template/common_template', $data);   
    }
}
?>
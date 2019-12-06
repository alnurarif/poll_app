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
        
        

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'alnursarwer@gmail.com', // change it to yours
            'smtp_pass' => 'alnur1989arif', // change it to yours
            'mailtype' => 'html',
            'charset'  => 'utf-8',
            'wordwrap' => TRUE
        );

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('test@gmail.com'); // change it to yours
        $this->email->to('test@yahoo.com');// change it to yours
        $this->email->subject('Verify Account');
        $message = $this->load->view('email/verification_email',$data,true);
        $this->email->message($message);
        if($this->email->send()){
            $data['main_content'] = $this->load->view('verification_email/verification_mail_sent', $data, TRUE);
            $this->load->view('template/common_template', $data); 
        }else{
            show_error($this->email->print_debugger());
        }
        
          
    }
    public function verify_account($id,$email_verification_code){
        $company = $this->Company_model->getByIdAndVerificationCode($id,$email_verification_code);
        // echo $this->db->last_query();
        // dd($company);
        $data = array();
        if($company){
            $this->Company_model->verifyAccount($id);   
            $data['main_content'] = $this->load->view('verification_email/verification_successfull', $data, TRUE);
            $this->load->view('template/common_template', $data);
        }else{
            $data['main_content'] = $this->load->view('verification_email/verification_unsuccessfull', $data, TRUE);
            $this->load->view('template/common_template', $data);
        }
    }
}
?>
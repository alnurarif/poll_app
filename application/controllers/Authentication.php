<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->library('form_validation');
        $this->load->helper('cookie');
    }

    public function index() {
 
        if ($this->session->userdata('company_id')) {
            redirect("Dashboard");
        }else if(!is_null(get_cookie('u_id'))){
            $this->getherLoginCookie();
            redirect("Dashboard");
        }
        $data = array();
        $data['main_content'] = $this->load->view('authentication/login', $data, TRUE);
        $this->load->view('template/common_template', $data);
    }

    public function loginCheck() {
        if ($this->input->post('submit') != 'Submit') {
            redirect("Authentication/index");
        }
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', "required|max_length[25]");
        if ($this->form_validation->run() == TRUE) {
            $email_address = $this->input->post($this->security->xss_clean('email'));
            $password = $this->input->post($this->security->xss_clean('password'));
            $company_information = $this->Authentication_model->getCompanyInformation($email_address, $password);

            if($company_information->email_verified == 0){
                redirect('Verification_email/not_verified/'.$company_information->id);
            }

            //If user exists
            if ($company_information) {
                if($this->input->post('remember_me')){
                    $this->rememberMe($company_information->id);
                }
                $login_session = array();
                //User Information
                $login_session['company_id'] = $company_information->id;
                $login_session['name'] = $company_information->name;
                $login_session['email'] = $company_information->email;
                $login_session['phone'] = $company_information->phone;
                //Set session
                $this->session->set_userdata($login_session);
                
                redirect("Dashboard");
            } else {
                $this->session->set_flashdata('exception_1', lang('incorrect_email_password'));
                redirect('Authentication/index');
            }
        } else {
            $this->load->view('authentication/login');
        }
    }

    public function paymentNotClear() {
        if (!$this->session->has_userdata('customer_id')) {
            redirect('Authentication/index');
        }
        $this->load->view('authentication/paymentNotClear');
    }

    public function userProfile() {
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if($this->session->userdata('role') == 'Kitchen User'){
            redirect("Kitchen/panel");
        }
        if($this->session->userdata('role') == 'Bar User'){
            redirect("Bar/panel");
        }
        if($this->session->userdata('role') == 'Waiter User'){
            redirect("Waiter/panel");
        }
        if($this->session->userdata('role') == 'POS User'){
            redirect("Sale/POS");
        }
        $data = array();
        $data['main_content'] = $this->load->view('authentication/userProfile', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function companyProfile() {
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        $data = array();
        $company_id = $this->session->userdata('company_id');
        $data['company_information'] = $this->Common_model->getDataById($company_id, 'tbl_companies');
        $data['main_content'] = $this->load->view('authentication/updateCompanyProfile', $data, TRUE);
        $this->load->view('outlet/outletHome', $data);
    }

    public function changePassword() {
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if ($this->input->post('submit') == 'submit') {
            $this->form_validation->set_rules('old_password',lang('old_password'), 'required|max_length[50]');
            $this->form_validation->set_rules('new_password', lang('new_password'), 'required|max_length[50]|min_length[6]');
            if ($this->form_validation->run() == TRUE) {
                $old_password = $this->input->post($this->security->xss_clean('old_password'));
                $user_id = $this->session->userdata('user_id');

                $password_check = $this->Authentication_model->passwordCheck($old_password, $user_id);

                if ($password_check) {
                    $new_password = $this->input->post($this->security->xss_clean('new_password'));

                    $this->Authentication_model->updatePassword($new_password, $user_id);

                    mail($this->session->userdata['email_address'], "Change Password", "Your new password is : " . $new_password);

                    $this->session->set_flashdata('exception',lang('password_changed'));
                    redirect('Authentication/changePassword');
                } else {
                    $this->session->set_flashdata('exception_1',lang('old_password_not_match'));
                    redirect('Authentication/changePassword');
                }
            } else {
                $data = array();
                $data['main_content'] = $this->load->view('authentication/changePassword', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {
            $data = array();
            $data['main_content'] = $this->load->view('authentication/changePassword', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }

    public function passwordChange() {

        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if ($this->input->post('submit') == 'submit') {
            $this->form_validation->set_rules('old_password',lang('old_password'), 'required|max_length[50]');
            $this->form_validation->set_rules('new_password', lang('new_password'), 'required|max_length[50]|min_length[6]');
            if ($this->form_validation->run() == TRUE) {
                $old_password = $this->input->post($this->security->xss_clean('old_password'));
                $user_id = $this->session->userdata('user_id');

                $password_check = $this->Authentication_model->passwordCheck($old_password, $user_id);

                if ($password_check) {
                    $new_password = $this->input->post($this->security->xss_clean('new_password'));

                    $this->Authentication_model->updatePassword($new_password, $user_id);

                    $this->session->set_flashdata('exception', lang('password_changed'));
                    redirect('Authentication/passwordChange');
                } else {
                    $this->session->set_flashdata('exception_1', lang('old_password_not_match'));
                    redirect('Authentication/passwordChange');
                }
            } else {
                $data = array();
                $data['main_content'] = $this->load->view('authentication/passwordChange', $data, TRUE);
                $this->load->view('outlet/outletHome', $data);
            }
        } else {
            $data = array();
            $data['main_content'] = $this->load->view('authentication/passwordChange', $data, TRUE);
            $this->load->view('outlet/outletHome', $data);
        }
    }

    public function forgotPassword() {
        $this->load->view('authentication/forgotPassword');
    }

    public function sendAutoPassword() {
        if ($this->input->post('submit') == 'submit') {
            $this->form_validation->set_rules('email_address', lang('email_address'), 'required|valid_email|callback_checkEmailAddressExistance');
            if ($this->form_validation->run() == TRUE) {
                $email_address = $this->input->post($this->security->xss_clean('email_address'));

                $user_details = $this->Authentication_model->getAccountByMobileNo($email_address);

                $user_id = $user_details->id;

                $auto_generated_password = mt_rand(100000, 999999);

                $this->Authentication_model->updatePassword($auto_generated_password, $user_id);

                //Send Password by Email
                $this->load->library('email');

                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);

                mail($email_address, "Change Password", "Your new password is : " . $auto_generated_password);

                $this->load->view('authentication/forgotPasswordSuccess');
            } else {
                $this->load->view('authentication/forgotPassword');
            }
        } else {
            $this->load->view('authentication/forgotPassword');
        }
    }

    public function checkEmailAddressExistance() {
        $email_address = $this->input->post($this->security->xss_clean('email_address'));

        $checkEmailAddressExistance = $this->Authentication_model->getAccountByMobileNo($email_address);

        if (count($checkEmailAddressExistance) <= 0) {
            $this->form_validation->set_message('checkEmailAddressExistance', 'Email Address does not exist');
            return false;
        } else {
            return true;
        }
    }

    public function logOut() {
        //User Information 
        
        $this->session->unset_userdata('company_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('phone');
        delete_cookie('u_id');

        redirect('Authentication/index');
    }

    public function setting($id = '') {
        $company_id = $this->session->userdata('company_id');

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('date_format', lang('date_format'), "required|max_length[50]");
            $this->form_validation->set_rules('time_zone', lang('country_time_zone'), "required|max_length[50]");
            $this->form_validation->set_rules('currency',lang('currency'), "required|max_length[50]");
            if ($this->form_validation->run() == TRUE) {
                $org_information = array();
                $org_information['date_format'] = $this->input->post($this->security->xss_clean('date_format'));
                $org_information['time_zone'] = $this->input->post($this->security->xss_clean('time_zone'));
                $org_information['currency'] = $this->input->post($this->security->xss_clean('currency'));
                $org_information['company_id'] = $this->session->userdata('company_id');
 
                $this->Common_model->updateInformation($org_information, $id, "tbl_settings");
                $this->session->set_flashdata('exception', lang('update_success'));
                //set session on update
                $this->session->set_userdata('currency', $org_information['currency']);  
                $this->session->set_userdata('time_zone', $org_information['time_zone']);  
                $this->session->set_userdata('date_format', $org_information['date_format']);  
                redirect('Authentication/setting/'.$org_information['company_id']);
            } else { 
                $data = array();
                $data['setting_information'] = $this->Authentication_model->getSettingInformation($company_id);
                $data['time_zones'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
                $data['currencies'] = $this->Common_model->getAllForDropdown("tbl_admin_currencies");
                $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
                $this->load->view('userHome', $data); 
            }
        } else { 
            $data = array();
            $data['setting_information'] = $this->Authentication_model->getSettingInformation($company_id);
            $data['time_zones'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
            $data['currencies'] = $this->Common_model->getAllForDropdown("tbl_admin_currencies");
            $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
            $this->load->view('userHome', $data); 
        }
    }

    public function SMSSetting($id='') {
        $company_id = $this->session->userdata('company_id');

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('email_address',lang('email_address'), "required|valid_email|max_length[50]");
            $this->form_validation->set_rules('password',lang('password'), "required|max_length[50]"); 
            if ($this->form_validation->run() == TRUE) {
                $sms_info = array();
                $sms_info['email_address'] = $this->input->post($this->security->xss_clean('email_address'));
                $sms_info['password'] = $this->input->post($this->security->xss_clean('password')); 
                $sms_info['company_id'] = $this->session->userdata('company_id');
 
                $this->Common_model->updateInformation($sms_info, $id, "tbl_sms_settings");
                $this->session->set_flashdata('exception', lang('update_success')); 
                redirect('Authentication/SMSSetting/'.$sms_info['company_id']);
            } else { 
                $data = array();
                $data['sms_information'] = $this->Authentication_model->getSMSInformation($company_id); 
                $data['main_content'] = $this->load->view('authentication/sms_setting', $data, TRUE);
                $this->load->view('userHome', $data); 
            }
        } else { 
            $data = array();
            $data['sms_information'] = $this->Authentication_model->getSMSInformation($company_id); 
            $data['main_content'] = $this->load->view('authentication/sms_setting', $data, TRUE);
            $this->load->view('userHome', $data); 
        }
    }

    public function changeProfile($id = '') {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $company_id = $this->session->userdata('company_id');
        if ($id != '') {
            $user_details = $this->Common_model->getDataById($id, "tbl_users");
        }

        if ($this->input->post('submit')) {

            if ($id != '') {
                $post_email_address = $this->input->post($this->security->xss_clean('email_address'));
                $existing_email_address = $user_details->email_address;
                if ($post_email_address != $existing_email_address) {
                    $this->form_validation->set_rules('email_address', lang('email_address'), "required|valid_email|max_length[50]|is_unique[tbl_users.email_address]");
                } else {
                    $this->form_validation->set_rules('email_address',lang('email_address'), "required|valid_email|max_length[50]");
                }
            } else {
                $this->form_validation->set_rules('email_address', lang('email_address'), "required|valid_email|max_length[50]|is_unique[tbl_users.email_address]");
            }

            if ($this->form_validation->run() == TRUE) {
                $user_info = array();
                $user_info['full_name'] = $this->input->post($this->security->xss_clean('full_name'));
                $user_info['email_address'] = $this->input->post($this->security->xss_clean('email_address'));
                $user_info['phone'] = $this->input->post($this->security->xss_clean('phone'));
                $this->Common_model->updateInformation($user_info, $id, "tbl_users");
                $this->session->set_flashdata('exception', lang('update_success'));
   
                $this->session->set_userdata('full_name', $user_info['full_name']);  
                $this->session->set_userdata('phone', $user_info['phone']);  
                $this->session->set_userdata('email_address', $user_info['email_address']);  

                redirect('Authentication/changeProfile');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                    $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                    $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }
    public function setlanguage(){
    $id=$this->session->userdata('user_id');
    $language=$this->input->post('language');
    if ($language == "") {
        $language = "english";
    }
    $data['language']=$language;
    $this->session->set_userdata('language', $language);
    $this->db->WHERE('id',$id);
    $this->db->update('tbl_users',$data);
    redirect($_SERVER["HTTP_REFERER"]);
   }
    public function signup(){
        if ($this->session->userdata('company_id')) {
            redirect("Dashboard");
        }
        $data = array();
        $data['countries'] = $this->Common_model->getAll('tbl_countries');
        $data['main_content'] = $this->load->view('authentication/registration', $data, TRUE);
        $this->load->view('template/common_template', $data);
    }
    public function login(){
        if ($this->session->userdata('company_id')) {
            redirect("Dashboard");
        }
        $data = array();
        
        $data['main_content'] = $this->load->view('authentication/login', $data, TRUE);
        $this->load->view('template/common_template', $data);
    }

    public function registerCompany($id = ""){
        
        if ($this->input->post('submit')) {
                
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[20]');
            $this->form_validation->set_rules('country_id', 'Country', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($_FILES['logo']['name'] != "") {
                $this->form_validation->set_rules('logo', 'Logo', 'callback_validate_logo');
            }
            if ($this->form_validation->run() == TRUE) {
                $company_info = array();
                $company_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $company_info['email'] = htmlspecialchars($this->input->post($this->security->xss_clean('email')));
                $company_info['phone'] = htmlspecialchars($this->input->post($this->security->xss_clean('phone')));
                $company_info['country_id'] = htmlspecialchars($this->input->post($this->security->xss_clean('country_id')));
                $company_info['password'] = htmlspecialchars($this->input->post($this->security->xss_clean('password')));
                $company_info['email_verification_code'] = $this->generateRandomString(50);
                if ($_FILES['logo']['name'] != "") {  

                    $company_info['logo'] = $this->session->userdata('logo'); 
                    $this->session->unset_userdata('logo'); 
                }
                if ($id == "") {
                    
                    $id = $this->Common_model->insertInformation($company_info, "tbl_companies");   
                    
                    $this->session->set_flashdata('exception', lang('insertion_success'));
                }
                // $login_session = array();
                // //User Information
                // $login_session['company_id'] = $id;
                // $login_session['name'] = $company_info['name'];
                // $login_session['email'] = $company_info['email'];
                // $login_session['phone'] = $company_info['phone'];
                // //Set session
                // $this->session->set_userdata($login_session);
                
                redirect('Authentication/login');
            } else {
                redirect('Authentication/signup');
            }
        }
    }

    public function validate_logo() {

        if ($_FILES['logo']['name'] != "") {
            $config['upload_path'] = './assets/dashboard/img/logos';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = '2048';
            $config['maintain_ratio'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $config['detect_mime'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("logo")) {
                
                $upload_info = $this->upload->data();


                // if ($upload_info['image_width'] != 142 || $upload_info['image_height'] != 80) {
                //     $this->form_validation->set_message('validate_logo', "File height must be 80px and width must be 142px");
                //     return FALSE;
                // }

                $logo = $upload_info['file_name']; 
                
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/dashboard/img/logos/'.$logo;
                // $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 200;
                $config['height'] = 100;

                $this->load->library('image_lib', $config); 

                $this->image_lib->resize();
                $this->session->set_userdata('logo', $upload_info['file_name']);

            } else {
                $this->form_validation->set_message('validate_logo', $this->upload->display_errors());
                return FALSE;
            }
        }
    }
    public function rememberMe($userId){
        $cookie = array(
            'name'   => 'u_id',
            'value' => $userId,
            'expire' => '3600'
        );
        try {
            $this->input->set_cookie($cookie);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getherLoginCookie(){
        $company_information = $this->Common_model->getDataById($this->input->cookie('u_id'),'tbl_companies');
        $login_session = array();
        //User Information
        $login_session['company_id'] = $company_information->id;
        $login_session['name'] = $company_information->name;
        $login_session['email'] = $company_information->email;
        $login_session['phone'] = $company_information->phone;
        //Set session
        $this->session->set_userdata($login_session);
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

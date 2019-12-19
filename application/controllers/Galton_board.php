<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Galton_board extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Common_model');
        $this->load->model('Galton_model');
        if (!$this->session->has_userdata('company_id')) {
            redirect('Authentication/index');
        }
        $company_id = $this->session->userdata('company_id');
        $company = $this->Common_model->getDataById($company_id,'tbl_companies');
        if($company->package_id != 2 && $company->package_id != 5){
            redirect('Dashboard');
        }
    }
    public function index(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        $data['company'] = $this->Common_model->getDataById($company_id,'tbl_companies');
        
        
        $data['galton_info'] = $this->Galton_model->calculate(rand(1,10000));
        $data['galton'] = $this->Galton_model->getGaltonInfoByCompanyId($company_id);
        $data['main_content'] = $this->load->view('galton/galton', $data, TRUE);
        $this->load->view('template/dashboard_template', $data);
    }
    public function addEditGaltonFrom(){
        $this->form_validation->set_rules('galton_color', 'Galton Color', 'required|max_length[50]'); 
        // $this->form_validation->set_rules('icon_detail', 'Icon Detail', 'required|max_length[500]'); 
        if ($_FILES['galton_icon']['name'] != "") {
            $this->form_validation->set_rules('galton_icon', 'Galton Icon', 'callback_validate_photo');
        }

        if ($this->form_validation->run() == TRUE) { 
            $galton_info = array();
            $galton_info['galton_color'] = htmlspecialchars($this->input->post($this->security->xss_clean('galton_color')));
            $galton_info['company_id'] = $this->session->userdata('company_id');
            if ($_FILES['galton_icon']['name'] != "") {  

                $galton_info['icon_file_name'] = $this->session->userdata('photo'); 
                $this->session->unset_userdata('photo'); 
            }
            $galton = $this->is_company_in_galton();
            if (!$galton) {
                
                $icon_id = $this->Common_model->insertInformation($galton_info, "tbl_galtons"); 
            } else {
                $this->Common_model->updateInformation($galton_info, $galton->id, "tbl_galtons");
            }
            redirect('Galton_board');
        }else{
            echo "something went wrong";
            echo validation_errors();
        }

        echo $icon_id;
    }
    public function is_company_in_galton(){
        $galton = $this->Galton_model->getGaltonInfoByCompanyId($this->session->userdata('company_id'));
        
        return $galton;
    }
    public function validate_photo() {

        if ($_FILES['galton_icon']['name'] != "") {
            $config['upload_path'] = './assets/galton_board/img/user_icons';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = '4096';
            $config['maintain_ratio'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $config['detect_mime'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("galton_icon")) {
                
                $upload_info = $this->upload->data();


                // if ($upload_info['image_width'] != 142 || $upload_info['image_height'] != 80) {
                //     $this->form_validation->set_message('validate_photo', "File height must be 80px and width must be 142px");
                //     return FALSE;
                // }

                $photo = $upload_info['file_name']; 
                
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/galton_board/img/user_icons/'.$photo;
                // $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 200;
                $config['height'] = 200;

                $this->load->library('image_lib', $config); 

                $this->image_lib->resize();
                $this->session->set_userdata('photo', $upload_info['file_name']);

            } else {
                $this->form_validation->set_message('validate_photo', $this->upload->display_errors());
                return FALSE;
            }
        }
    }

    

}
?>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Votes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Common_model');
        $this->load->model('Poll_icons_model');
        $this->load->model('Poll_model');
        $this->load->model('Vote_model');
        $this->load->model('Company_model');
        $this->load->model('Galton_model');
    }
    public function giveVoteSpeedoMeter(){
        $rotation = $this->input->post('rotation');

        $voteInfo = array();
        $voteInfo['poll_id'] = $poll_id = htmlspecialchars($this->input->post($this->security->xss_clean('poll_id')));
        $voteInfo['ip_info'] = $_SERVER['REMOTE_ADDR'];;
        $voteInfo['rotation'] = $rotation;
        $voteInfo['poll_type'] = 'Speedo Meter';
        $voteInfo['voted_from'] = ($this->isInWhiteList($voteInfo['ip_info']))? NULL : $this->votedFrom($voteInfo['ip_info'])->country;
        $voteInfo['created_at'] = date('Y-m-d H:i:s');
        $voteInfo['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->Common_model->insertInformation($voteInfo, "tbl_votes");

        $data = array();
        
        $data['first'] = $this->Vote_model->getFirstTypeVote($poll_id);
        $data['mid'] = $this->Vote_model->getMidTypeVote($poll_id);
        $data['last'] = $this->Vote_model->getLastTypeVote($poll_id);
        $data['total_votes'] = $this->Vote_model->getVotesNumberByPollId($poll_id);
        $data['company_info'] = $company_info = $this->Company_model->getCompanyInfoByPollId($poll_id);
        if($company_info->package_id==2){
            $data['galton_info'] = $this->Galton_model->calculate($data['total_votes']->total_votes);
        }
        echo json_encode($data);
    }
    public function giveVoteCompass(){
        $rotation = $this->input->post('rotation');

        $voteInfo = array();
        $voteInfo['poll_id'] = $poll_id = htmlspecialchars($this->input->post($this->security->xss_clean('poll_id')));
        $voteInfo['ip_info'] = $_SERVER['REMOTE_ADDR'];;
        $voteInfo['rotation'] = (round($rotation)<0)?round(360+$rotation):round($rotation);
        $voteInfo['poll_type'] = 'Compass';
        $voteInfo['voted_from'] = ($this->isInWhiteList($voteInfo['ip_info']))? NULL : $this->votedFrom($voteInfo['ip_info'])->country;
        $voteInfo['created_at'] = date('Y-m-d H:i:s');
        $voteInfo['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->Common_model->insertInformation($voteInfo, "tbl_votes");

        $data = array();
        
        $data['first'] = $this->Vote_model->getFirstTypeVoteCompass($poll_id);
        $data['second'] = $this->Vote_model->getSecondTypeVoteCompass($poll_id);
        $data['third'] = $this->Vote_model->getThirdTypeVoteCompass($poll_id);
        $data['forth'] = $this->Vote_model->getForthTypeVoteCompass($poll_id);
        $data['fifth'] = $this->Vote_model->getFifthTypeVoteCompass($poll_id);
        $data['sixth'] = $this->Vote_model->getSixthTypeVoteCompass($poll_id);
        $data['total_votes'] = $this->Vote_model->getVotesNumberByPollId($poll_id);
        $data['company_info'] = $company_info = $this->Company_model->getCompanyInfoByPollId($poll_id);
        if($company_info->package_id==2){
            $data['galton_info'] = $this->Galton_model->calculate($data['total_votes']->total_votes);
        }

        echo json_encode($data);   
    }
    public function giveVoteSlider(){
        $percentage = $this->input->post('percentage');

        $voteInfo = array();
        $voteInfo['poll_id'] = $poll_id = htmlspecialchars($this->input->post($this->security->xss_clean('poll_id')));
        $voteInfo['ip_info'] = $_SERVER['REMOTE_ADDR'];;
        $voteInfo['percentage'] = $percentage;
        $voteInfo['poll_type'] = 'Speedo Meter';
        $voteInfo['voted_from'] = ($this->isInWhiteList($voteInfo['ip_info']))? NULL : $this->votedFrom($voteInfo['ip_info'])->country;
        $voteInfo['created_at'] = date('Y-m-d H:i:s');
        $voteInfo['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->Common_model->insertInformation($voteInfo, "tbl_votes");

        $data = array();
        $data['first'] = $this->Vote_model->getFirstTypeSliderVote($poll_id);
        $data['mid'] = $this->Vote_model->getMidTypeSliderVote($poll_id);
        $data['last'] = $this->Vote_model->getLastTypeSliderVote($poll_id);
        $data['total_votes'] = $this->Vote_model->getVotesNumberByPollId($poll_id);
        $data['all_percentages'] = $this->Vote_model->getAllPercentagesOfSliderPoll($poll_id);
        $data['company_info'] = $company_info = $this->Company_model->getCompanyInfoByPollId($poll_id);
        if($company_info->package_id==2){
            $data['galton_info'] = $this->Galton_model->calculate($data['total_votes']->total_votes);
        }
        echo json_encode($data);
    }
    public function votedFrom($ip){
        $json       = file_get_contents("http://ipinfo.io/{$ip}");
        $details    = json_decode($json);
        return $details;
    }

    //this is for development purpose to generate ip 
    public function updateVoteCountryBasedOnIp()
    {
        // dd();
        $votes = $this->db->get('tbl_votes');
        $votes_result = $votes->result();
        // dd($votes_result);
        foreach ($votes_result as $vote)
        {
            if($vote->voted_from == null){
                $vote_ip_info = $this->votedFrom($vote->ip_info);
                if(isset($vote_ip_info->country)){
                    $data = array( 
                        'voted_from'      => $vote_ip_info->country
                    );

                    $this->db->where('id', $vote->id);
                    $this->db->where('voted_from is NULL', NULL, FALSE);

                    $this->db->update('tbl_votes', $data);
                    dump($vote_ip_info->country);
                }else{
                    $randIP = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
                    $data = array( 
                        'ip_info'      => $randIP
                    );
                    
                    $this->db->where('id', $vote->id);

                    $this->db->update('tbl_votes', $data);
                }    
            }
            
        }
    }
    // this is for development purpose
    public function updateVoteCountryBasedOnPreviousRandomRecords()
    {
        // dd();
        $this->db->select("*");
        $this->db->from('tbl_votes');
        $this->db->where('voted_from is not NULL', NULL, FALSE);
        $votes_result = $this->db->get()->result(); 
        
        foreach ($votes_result as $vote){
            $randIP = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
            $data = array( 
                'ip_info'      => $vote->ip_info,
                'voted_from'   => $vote->voted_from
            );

            $this->db->where('id', rand(430,738));
            $this->db->where('voted_from is NULL', NULL, FALSE);

            $this->db->update('tbl_votes', $data);
        }
    }
    public function isInWhiteList($ip)
    {
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );
        if(in_array($ip, $whitelist)){
            return true;
        }
        return false;
    }



}
?>
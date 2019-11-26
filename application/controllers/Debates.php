<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Debates extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Common_model');
        $this->load->model('Poll_icons_model');
        $this->load->model('Poll_model');
        $this->load->model('Vote_model');

    }
    public function index(){
        $data = array();
        $data['polls'] = $this->Common_model->getAllByTableOrderByField("tbl_polls","id","DESC");
        $data['main_content'] = $this->load->view('debates/debates', $data, TRUE);
        $this->load->view('template/common_template', $data);
    }
    public function getPoll(){
        $id = $this->input->post('poll_id');
        $data = array();
        $data['poll'] = $this->Poll_model->getDebateDetailsById($id);
        $data['poll_icons'] = $this->Poll_icons_model->getPollIcons($id);
        $data['votes'] = $this->Vote_model->getVotesNumberByPollId($id);
        echo json_encode($data);
    }
    public function singleDebate($id){
        $data = array();
        $data['poll'] = $poll = $this->Poll_model->getDebateDetailsById($id);
        $data['poll_icons'] = $this->Poll_icons_model->getPollIcons($id);
        $data['total_votes'] = $this->Vote_model->getVotesNumberByPollId($id);
        
        if($poll->poll_type == "Slider"){
            $data['first'] = $this->Vote_model->getFirstTypeSliderVote($id);
            $data['mid'] = $this->Vote_model->getMidTypeSliderVote($id);
            $data['last'] = $this->Vote_model->getLastTypeSliderVote($id);
            $data['all_percentages'] = $this->Vote_model->getAllPercentagesOfSliderPoll($id);
        }elseif($poll->poll_type == "Compass"){
            $data['first'] = $this->Vote_model->getFirstTypeVoteCompass($id);
            $data['second'] = $this->Vote_model->getSecondTypeVoteCompass($id);
            $data['third'] = $this->Vote_model->getThirdTypeVoteCompass($id);
            $data['forth'] = $this->Vote_model->getForthTypeVoteCompass($id);
            $data['fifth'] = $this->Vote_model->getFifthTypeVoteCompass($id);
            $data['sixth'] = $this->Vote_model->getSixthTypeVoteCompass($id);
        }elseif($poll->poll_type == "Speedo Meter"){
            $data['first'] = $this->Vote_model->getFirstTypeVote($id);
            $data['mid'] = $this->Vote_model->getMidTypeVote($id);
            $data['last'] = $this->Vote_model->getLastTypeVote($id);
        }
        $this->load->view('debates/single_debate', $data);
    }
}
?>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Insights extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Common_model');
        $this->load->model('Poll_icons_model');
        $this->load->model('Vote_model');
        $this->load->model('Poll_model');
        $this->load->helper('cookie');
        if (!$this->session->has_userdata('company_id')) {
            redirect('Authentication/index');
        } 

    }
    public function index($value=''){
        $company_id = $this->session->userdata('company_id');
        $data = array();

        $data['polls_responses'] = $this->Poll_model->getVotesOfPolls($company_id);
        $data['votes_from_countries_of_polls'] = $this->Poll_model->getCountriesOfPolls($company_id);
        $firstSecondIndexArray = $this->getOnlyFirstIndex($data['votes_from_countries_of_polls']);
        $unique_first_second_index = array_map("unserialize", array_unique(array_map("serialize", $firstSecondIndexArray))); 
        $data['votes_from_countries_of_polls'] = $this->arrangeObjects($data['votes_from_countries_of_polls'],$unique_first_second_index);
     

        $data['most_voted_time_of_countries'] = $this->Poll_model->most_voted_time_of_countries($company_id);
        $firstSecondIndexArray = $this->getOnlyFirstIndex($data['most_voted_time_of_countries']);
        $unique_first_second_index = (object) array_map("unserialize", array_unique(array_map("serialize", $firstSecondIndexArray))); 
        $reconstructedMostVotedTimeCountries = $this->arrangeObjectsMostCountriesTime($data['most_voted_time_of_countries'],$unique_first_second_index);
        $data['most_voted_time_of_countries'] = $reconstructedMostVotedTimeCountries;
        

        $data['main_content'] = $this->load->view('insights/insights', $data, TRUE);
        $this->load->view('template/dashboard_template', $data);
    }
    public function getOnlyFirstIndex($objects){
        $object_array = array();
        $i = 0;
        foreach($objects as $object){
            $object_array[$i] = array('poll_id'=> $object->poll_id, 'question' =>$object->question);
            $i++;
        }
        return $object_array;
    }
    public function arrangeObjects($objects,$unique_first_second_index){
        $polls = array();
        $i = 0;
        foreach($unique_first_second_index as $index){
            $data = new \stdClass();
            $data->poll_id = $index['poll_id'];
            $data->question = $index['question'];
            $data->detail = $this->getDetailsOfPoll($objects,$index['poll_id']);
            $polls[$i] = $data;
            $i++;
        }
        return $polls;
    }
    public function arrangeObjectsMostCountriesTime($objects,$unique_first_second_index)
    {
        $polls = array();
        $i = 0;
        foreach($unique_first_second_index as $index){
            $data = new \stdClass();
            $data->poll_id = $index['poll_id'];
            $data->question = $index['question'];
            $data->detail = $this->getDetailsOfPollMostCountyTime($objects,$index['poll_id']);
            $polls[$i] = $data;
            $i++;
        }
        return $polls;
    }
    public function getDetailsOfPoll($objects,$index){
        $data = array();
        $i = 0;
        foreach($objects as $object){
            if($object->poll_id == $index){
                $data[$i] = array('votes' => $object->votes, 'country_name' => $object->country_name);
                $i++;
            }
            
        }
        return $data;
    }
    public function getDetailsOfPollMostCountyTime($objects,$index){
        $data = array();
        $checked_countries = array();
        $i = 0;

        foreach($objects as $object){
            if($object->poll_id == $index){
                if(!in_array($object->voted_country, $checked_countries)){
                    $found_max = $this->check_most_votes_time_from_country($object,$objects);
                    $voted_time = (empty((array)$found_max))?0:$found_max->voted_time;
                    $country_name = (empty((array)$found_max))?'Anonymous':$found_max->voted_country;
                    $data[$i] = array('voted_time' => $voted_time, 'country_name' => $country_name);
                    $i++;    
                }
                
            }
            
        }
        return $data;
    }
    public function check_most_votes_time_from_country($object,$objects){
        $same_poll_country_objects = array();
        $max_votes_from_country = 0;
        $max_votes_from_country_object = (object)[];
        foreach($objects as $single_object){
            if($single_object->poll_id == $object->poll_id && $single_object->voted_country_code==$object->voted_country_code){
                array_push($same_poll_country_objects, $single_object);
            }
        }

        foreach($same_poll_country_objects as $single_object){
            if($max_votes_from_country < $single_object->votes_from_country){
                $max_votes_from_country = $single_object->votes_from_country;    
                $max_votes_from_country_object = $single_object;
            }
            
        }
        // echo "<pre>";var_dump($max_votes_from_country_object);echo "</pre>";
        // echo "<pre>";var_dump($same_poll_country_objects);echo "</pre>";
        return $max_votes_from_country_object;
    }
}
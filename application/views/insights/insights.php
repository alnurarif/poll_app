<?php 
    //show polls responses
    $polls_responses_to_show = '';
    if(count($polls_responses)>0){
        foreach($polls_responses as $single_poll_responses){
            $polls_responses_to_show .= '<div class="single_poll_response fix">';
                $polls_responses_to_show .= '<p class="poll_name">'.$single_poll_responses->question.'</p>';
                $polls_responses_to_show .= '<p class="poll_responses_number">'.$single_poll_responses->responses.'</p>';
            $polls_responses_to_show .= '</div>';    
        }
    }
    //end show polls responses

    //show votes from countries
    $show_votes_from_countries = '';

    if(count($votes_from_countries_of_polls)>0){
        $previous_poll_id = null;
        foreach($votes_from_countries_of_polls as $single_country_for_particular_poll){
                $show_votes_from_countries .= '<div class="single_poll_countries_and_question fix">';
                    $show_votes_from_countries .= '<div class="fix single_poll_country_question">';
                        $show_votes_from_countries .= '<div class="question_part"><p>'.$single_country_for_particular_poll->question.'</p></div>';
                        $show_votes_from_countries .= '<div class="arrow_part"><i class="fas fa-chevron-circle-down country_response_arrow down_arrow" id="down_arrow_'.$single_country_for_particular_poll->poll_id.'"></i><i class="fas fa-chevron-circle-up country_response_arrow up_arrow" id="up_arrow_'.$single_country_for_particular_poll->poll_id.'"></i></div>';
                    $show_votes_from_countries .= '</div>';
                    $show_votes_from_countries .= '<div class="single_poll_country_votes_details" id="single_poll_country_votes_details_'.$single_country_for_particular_poll->poll_id.'">';
                        foreach($single_country_for_particular_poll->detail as $single_country){
                            $country_name = ($single_country['country_name']==NULL || $single_country['country_name'] == "")?"Anonymous":$single_country['country_name'];
                            $show_votes_from_countries .= '<div class="country_name_votes"><p>'.$country_name.': '.$single_country['votes'].'</p></div>';
                        }
                    $show_votes_from_countries .= '</div>';
                $show_votes_from_countries .= '</div>';

        }
    }
    //end show votes from countries
    
    //show countries active time
    $show_countries_active_time = '';

    if(count($most_voted_time_of_countries)>0){
        $previous_poll_id = null;
        foreach($most_voted_time_of_countries as $single_country_for_particular_poll){
                $show_countries_active_time .= '<div class="single_poll_countries_and_question fix">';
                    $show_countries_active_time .= '<div class="fix single_poll_country_question">';
                        $show_countries_active_time .= '<div class="question_part"><p>'.$single_country_for_particular_poll->question.'</p></div>';
                        $show_countries_active_time .= '<div class="arrow_part"><i class="fas fa-chevron-circle-down country_response_arrow down_arrow_most_response" id="down_arrow_most_response_'.$single_country_for_particular_poll->poll_id.'"></i><i class="fas fa-chevron-circle-up country_response_arrow up_arrow_most_response" id="up_arrow_most_response_'.$single_country_for_particular_poll->poll_id.'"></i></div>';
                    $show_countries_active_time .= '</div>';
                    $show_countries_active_time .= '<div class="single_poll_country_most_votes_details" id="single_poll_country_most_votes_details_'.$single_country_for_particular_poll->poll_id.'">';
                        foreach($single_country_for_particular_poll->detail as $single_country){
                            $country_name = ($single_country['country_name']==NULL || $single_country['country_name'] == "")?"Anonymous":$single_country['country_name'];
                            $show_countries_active_time .= '<div class="country_name_votes"><p>'.$country_name.': '.$single_country['voted_time'].'</p></div>';
                        }
                    $show_countries_active_time .= '</div>';
                $show_countries_active_time .= '</div>';

        }
    }
    //end countries active time

?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/insights/css/page_style/insights.css">

<div class="insights_wrapper fix">
    <div class="section fix">
        
        <div class="inner_section fix">
            <div class="header fix">
                <h2>Responses</h2>
            </div>
            <div class="body fix">
                <div id="polls_responses">
                    <?php echo $polls_responses_to_show; ?>    
                </div>        
            </div>
        </div>
        <div class="inner_section fix">
            <div class="header fix">
                <h2>Responses From</h2>
            </div>
            <div class="body fix">
                <div id="responses_from_countries">
                    <?php echo $show_votes_from_countries; ?>    
                </div>
            </div>
        </div>
        <div class="inner_section fix">
            <div class="header fix">
                <h2>Countries Active Time</h2>
            </div>
            <div class="body fix">
                <div id="most_responses_from_countries">
                    <?php echo $show_countries_active_time; ?>    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/insights/js/page_js/insights.js"></script>

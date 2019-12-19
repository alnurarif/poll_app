<?php 
$polls_to_show = '';

if(count($polls)>0){
  foreach($polls as $poll){
    if($poll->poll_type == 'Speedo Meter'){
      $edit_link = 'Dashboard/editSpeedoMeter/'.$poll->id;
      $view_link = 'Dashboard/viewSpeedoMeter/'.$poll->id;
      $poll_icon = '<i class="fas fa-tachometer-alt"></i>';
    }else if($poll->poll_type == 'Slider'){
      $edit_link = 'Dashboard/editSliderPoll/'.$poll->id;
      $view_link = 'Dashboard/viewSliderPoll/'.$poll->id;
      $poll_icon = '<i class="fas fa-sliders-h"></i>';
    }else if($poll->poll_type == 'Compass'){
      $edit_link = 'Dashboard/editCompass/'.$poll->id;
      $view_link = 'Dashboard/viewCompass/'.$poll->id;
      $poll_icon = '<i class="fas fa-compass"></i>';
    }
    $polls_to_show .= '<tr>';
      $polls_to_show .= '<th scope="row">'.$poll_icon.'</th>';
      $polls_to_show .= '<td class="dasboard_question_col">'.$poll->question.'</td>';
      $polls_to_show .= '<td>Independent</td>';
      $polls_to_show .= '<td class="dashboard_date_col">'.date('d.m.Y',strtotime($poll->created_at)).'</td>';
      $polls_to_show .= '<td>';
        $polls_to_show .= '<a href="'.base_url($view_link).'"><i class="fas fa-eye"></i></a>';
        $polls_to_show .= '<a href="'.base_url($edit_link).'"><i class="fas fa-edit"></i></a>';
        $polls_to_show .= '<a class="open_poll_info_modal"  id="open_poll_info_modal_'.$poll->id.'"><i class="fas fa-info"></i></a>';
        // $polls_to_show .= '<a href="#"><i class="fas fa-code"></i></a>';
        $polls_to_show .= '<a class="open_delete_modal" id="open_delete_modal_'.$poll->id.'"><i class="fas fa-trash-alt"></i></a>';

      $polls_to_show .= '</td>';
    $polls_to_show .= '</tr>';
  }
}
?>


        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/dashboard.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>

        <section id="all_pool">

               <div class="container"> 
                    <div class="row"> 
                        <div class="col-md-9"> 
                            <div class="header_left"> 
                              <ul class="nav nav-tabs">
                                <!-- <li class="nav-item">
                                  <a class="nav-link active" href="#recomanded">Viewpointb Recommended</a>
                                </li> -->
                                <li class="nav-item">
                                  <a class="nav-link" href="">All Polls</a>
                                </li>
                                <?php if($company->package_id == 2 || $company->package_id == 5) {?>
                                <li class="nav-item">
                                  <a class="nav-link" href="#">Questionnaire link</a>
                                </li>
                                <?php } ?>
                                <?php if($company->package_id == 1 || $company->package_id == 2 || $company->package_id == 4 || $company->package_id == 5 ) {?>
                                <li class="nav-item">
                                  <a class="nav-link" href="#">Rate Card Optimizer</a>
                                </li>
                                <?php } ?>
                                <?php if($company->package_id == 2 || $company->package_id == 5) {?>
                                <li class="nav-item">
                                  <a class="nav-link" href="<?php echo base_url(); ?>Galton_board">Galton Board</a>
                                </li>
                                <?php } ?>
                              </ul>
                            </div>
                        </div>
                        <div class="col-md-3"> 
                          <div class="header_right">
                            <input type="text" name="search_poll" id="search_poll" placeholder="Type Quetion Name & Date">
                          </div>
                        </div>
                    </div>
                </div>
            <div class="container" id="recomanded">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                          <thead>
                            <tr style="background: #000000;
    color: #fff;">
                              <th scope="col">Type</th>
                              <th scope="col">Question</th>
                              <th scope="col">Publisher</th>
                              <th scope="col">Last Update</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php echo $polls_to_show; ?>
        
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
<!-- The Modal -->
<div id="deletePollModal" class="modal" style="padding-top:20px;">

    <!-- Modal content -->
    <div class="modal-content" id="deletePollModalContent">
        <div class="header">
            <h1>Delete Poll</h1>
        </div>
        <div class="body">
          <p>Are you sure to delete?</p>
        </div>
        <div class="bottom">
          <a href="#" id="pollIdDelete" class="modalButton">Yes</a>
          <a href="#" id="pollDeleteCancel" class="modalButton">Cancel</a>
        </div>
    </div>

</div>
<!-- end add customer modal -->    


<!-- The Modal -->
<div id="infoPollModal" class="modal" style="padding-top:20px;">

    <!-- Modal content -->
    <div class="modal-content" id="infoPollModalContent">
        <div class="close_modal_cross">
          <i class="fas fa-times-circle"></i>
        </div>
        <div class="header">
            <h1>Poll Info</h1>
        </div>
        <div class="body">
          <p>People Perticipitated : <span id="people_perticipated_to_poll">0</span></p>
          <p>Poll has been running for : <span id="poll_has_been_running_for">0</span> Days</p>
          <div class="info_header_section">
            <div class="twothird floatleft textleft"><p class="header_text">Three Highest Days of Perticipation</p></div>
            <div class="onethird floatleft textright"><i class="fas fa-angle-double-up arrow_up"></i><i class="fas fa-angle-double-down arrow_down"></i></div>
          </div>
          <div class="info_paragraph_section">
            <span id="three_highest_days_of_perticipation">None</span>
          </div>
          <div class="info_header_section">
            <div class="twothird floatleft textleft"><p class="header_text">Three Lowest Days of Perticipation</p></div>
            <div class="onethird floatleft textright"><i class="fas fa-angle-double-up arrow_up"></i><i class="fas fa-angle-double-down arrow_down"></i></div>
          </div>
          <div class="info_paragraph_section">
            <span id="three_lowest_days_of_perticipation">None</span>
          </div>
          <div class="info_header_section">
            <div class="twothird floatleft textleft"><p class="header_text">Voting Locations</p></div>
            <div class="onethird floatleft textright">&nbsp;<!-- <i class="fas fa-angle-double-up arrow_up"></i><i class="fas fa-angle-double-down arrow_down"></i> --></div>
          </div>
          <div id="votes_from_countries"></div>
          
        </div>
    </div>

</div>
<!-- end add customer modal -->    

<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/page_js/dashboard.js"></script>



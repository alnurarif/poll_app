<?php 
  $debates_to_show = '';
  if(count($polls)>0){
    foreach($polls as $poll){
      $debates_to_show .= '<div class="single_debate col-md-3" style="margin: 0px 0px 40px 0px;" id="single_debate_'.$poll->id.'">';
        $debates_to_show .= '<div class="debates_content">';
          $debates_to_show .= '<a href="#">';
            $debates_to_show .= '<img src="'.base_url().'assets/img/debate_default_bg.png" alt="debates  img" class="img-responsive">';
            $debates_to_show .= '<h3>'.$poll->question.'</h3>';
          $debates_to_show .= '</a>';
        $debates_to_show .= '</div>';
      $debates_to_show .= '</div>';
    }
  }
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/page_style/debates.css">
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>

        <!-- Login form -->
        <section id="debate_page_banner">
          <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="banner_left">
                            <h1>Debates</h1>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="banner_right">
                            <!-- <video width="500px" height="400px" controls="">
                              <source src="http://localhost/poll_app/assets/video/video.mp4" type="video/mp4">
                              <source src="http://localhost/poll_app/assets/video/video.ogg" type="video/ogg">
                              Your browser does not support the video tag.
                            </video> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="debates_section">
          <div class="container">
            <span style="display:none" id="selected_poll_id"></span>
            <!-- <div class="row">
              <div class="col-md-12 text-center pt-100 pb-100">
                <div class="debates_heading">
                  <h2>All Debates</h2>
                  <span style="display:none" id="selected_poll_id"></span>
                </div>
              </div>
            </div> -->
            <div class="row" id="wrapper_poll">
              <div id="left_right_cross_holder">
                <div id="left_right_cross">
                  <div id="question_left" class="floatleft">
                    <i class="fas fa-chevron-left"></i>
                  </div>
                  <div id="question_right" class="floatleft">
                    <i class="fas fa-chevron-right"></i>
                  </div>
                  <div id="question_cross" class="floatleft">
                    <i class="fas fa-times"></i>
                  </div>
                </div>  
              </div>
              
              <div id="total_poll_section">
                <div id="poll_tabs">
                  <div class="single_tab">
                    <p><i class="fas fa-flag"></i> <span id="debate_creator_company">Company Name</span></p>
                  </div>
                </div>  
                <div id="poll_holder">
                  <div id="poll_holder_inside">
                    <div id="question">
                      <h2 id="question_header">This is test Question</h2>
                    </div>
                    <div id="compass_wrapper2" style="position: relative;">
                      
                      <div id="compass2">
                        <div id="compass_hand2"><img src="<?php echo base_url(); ?>assets/dashboard/img/profile_avatar.png" id="compass_hand_company_logo"></div>
                        <div id="speedo_meter_pointer_icon"><img src="<?php echo base_url(); ?>assets/dashboard/img/profile_avatar.png"></div>     
                        <div class="icon_slider" id="icon_slider1"></div>     
                        <div class="icon_slider" id="icon_slider2"></div>     
                        <div class="icon_slider" id="icon_slider3"></div>     
                        <div id="left_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="left_vote_percentage_text">36</span>%</div>
                        <div id="mid_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="mid_vote_percentage_text">9</span>%</div>
                        <div id="right_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="right_vote_percentage_text">55</span>%</div>
                      </div>
                      <div id="debate_between">
                          <div class="half floatleft"><p class="textleft floatleft" id="left_label_text">No. Let Robert Downey Jr. enjoy the time off.</p></div>
                          <div class="half floatright"><p class="textright floatright" id="right_label_text">Yes. I demand more Iron Man.</p></div>
                      </div>
                      
                    </div>

                    <div id="compass_wrapper" style="position: relative;">
                      <div id="compass">
                        <div class="container2">
                          <!--the holders/targets for the text, reuse as desired-->
                          <div class="circTxt" id="test"></div>
                        </div>
                        <?php //echo $icons_show; ?>
                        <div id="compass_hand">
                          <svg height="210" width="30">
                              <path id="compass_indicator" fill="#c62d2d" stroke-width="1.5" d="M15 0 L25 105 A15 15 0 1 1 6 104 L5 105 0z" />                              
                          </svg>
                        </div>
                        <div id="compass_vote_percentage_1" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_1">36</span>%</div>
                        <div id="compass_vote_percentage_2" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_2">36</span>%</div>
                        <div id="compass_vote_percentage_3" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_3">36</span>%</div>
                        <div id="compass_vote_percentage_4" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_4">36</span>%</div>
                        <div id="compass_vote_percentage_5" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_5">36</span>%</div>
                        <div id="compass_vote_percentage_6" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_6">36</span>%</div>
                      </div>
                    </div>

                    <div id="plain_slider_wrapper">
                      <div style="margin:5px auto; text-align:center;">
                        <div id="piechart" style="width: 400px; height: 200px;margin:0 auto;display: none;"></div>
                        <!-- <canvas id="graph" width="450" height="150" align="center"></canvas> -->
                      </div>
                      <div id="plain_slider">
                        <div id="slider">
                          <div class="first floatleft slider_get_icon" id="slider_get_icon1"><img src="<?php echo base_url(); ?>assets/dashboard/img/profile_avatar.png"></div>
                          <div class="second floatleft">
                            <div id="slide_line"></div>
                            <img id="slider_company_icon" src="<?php echo base_url(); ?>assets/dashboard/img/profile_avatar.png"/>
                          </div>
                          <div class="third floatleft slider_get_icon" id="slider_get_icon2"><img src="<?php echo base_url(); ?>assets/dashboard/img/profile_avatar.png"></div>
                        </div>
                        <div id="slider_options">
                          <div id="show_vote_percentage">
                            <div class="floatleft" style="width:33.3333%"><p class='slider_percentage_text'><span id="slider_left_percentage_text">13</span>%</p></div>
                            <div class="floatleft" style="width:33.3333%"><p class='slider_percentage_text'><span id="slider_mid_percentage_text">35</span>%</p></div>
                            <div class="floatleft" style="width:33.3333%"><p class='slider_percentage_text'><span id="slider_right_percentage_text">52</span>%</p></div>
                          </div>
                          <div class="left_space floatleft"></div>
                          <div class="left_option floatleft textleft" id="slide_left_answer">Yes, she's trying to raise awareness of important issues</div>            
                          <div class="right_option floatleft textright" id="slide_right_answer">No, her actions are an insult to the country</div>            
                          <div class="right_space floatleft"></div>
                        </div>
                      </div>
                    </div>


                    <div id="social_share_vote_section">
                      <div class="social_share floatleft half textleft">
                        <img src="<?php echo base_url();?>assets/img/fb_share.png" style="float:left;width:70px;height:30px;margin-right:5px;">
                        <img src="<?php echo base_url();?>assets/img/tweet.png" style="float:left;width:70px;height:30px;margin-right:5px;">
                      </div>
                      <div class="vote_section floatright half textright"><span id="user_voted">3039</span> Votes</div>
                    </div>
                  </div>
                  <div id="company_logo_very_small">
                    <a href="<?php echo base_url(); ?>Dashboard" class="debate_create_now_button">Create Now</a>
                    <img src="<?php echo base_url();?>assets/img/cropped-Tiger-logo.png">
                    <img id="information_icon" src="<?php echo base_url();?>assets/img/information_icon.png">
                  </div>
                    
                </div>  
              </div>
              <div id="galton_wrapper">
                <div class="galton_icon_section">
                  <img src="<?php echo base_url()."assets/dashboard/img/profile_avatar.png"; ?>" id="galton_icon">  
                </div>                
                
                <div id="galton">
                  <div class="bar" id="galton_bar1"></div>
                  <div class="bar" id="galton_bar2"></div>
                  <div class="bar" id="galton_bar3"></div>
                  <div class="bar" id="galton_bar4"></div>
                  <div class="bar" id="galton_bar5"></div>
                  <div class="bar" id="galton_bar6"></div>
                  <div class="bar" id="galton_bar7"></div>
                  <div class="bar" id="galton_bar8"></div>
                  <div class="bar" id="galton_bar9"></div>
                  <div class="bar" id="galton_bar10"></div>
                  <div class="bar" id="galton_bar11"></div>
                </div>  
              </div>
              <!-- <div id="poll_holder2">
                <div id="plain_slider_wrapper">
                  <div id="plain_slider">
                    <div id="slider">
                      <div class="first floatleft"><img src="images/face1.jpg"></div>
                      <div class="second floatleft">
                        <div id="slide_line"></div>
                        <img src="images/profile_avatar.png"/>
                      </div>
                      <div class="third floatleft"><img src="images/face2.jpg"></div>
                    </div>
                    <div id="slider_options">
                      <div class="left_space floatleft"></div>
                      <div class="left_option floatleft textleft">Yes, she's trying to raise awareness of important issues</div>            
                      <div class="right_option floatleft textright">No, her actions are an insult to the country</div>            
                      <div class="right_space floatleft"></div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="row mt-50">

              <?php echo $debates_to_show; ?>
            </div>
          </div>
        </section>

               <!-- footer section start -->
        <section id="footer_section" class="mt-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer_one">
                            <?php $this->load->view('template/common_include/login_form_footer_portion');?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer_two">
                            <h3>WHERE TO FIND US</h3>
                            <p><i class="fas fa-envelope"></i>info@viewpointb.com</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer_three">
                            <h3>ABOUT US</h3>
                            <p>We are a Malaysian based company with a team of committed individuals from around the world. \outside your office to reach your customers. We want to help you help yourself to reach your business goals.</p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer_four">
                            <h3>MENU</h3>
                            <ul>
                                <li><a href="<?php echo base_url(); ?>Home">HOME</a></li>
                                <li><a href="#">HOW TO USE OUR SITE</a></li>
                                <li><a href="<?php echo base_url(); ?>Contact">CONTACT</a></li>
                                <li><a href="<?php echo base_url(); ?>Login">LOGIN</a></li>
                                <li><a href="<?php echo base_url(); ?>Signup">SIGNUP</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- The Modal -->
<div id="image_after_voting">
  <div id="close_add_button"><img src="<?php echo base_url(); ?>assets/img/cross_icon.png" alt=""></div>
  <img id="add_image" src="<?php echo base_url(); ?>assets/img/pop_up_image.jpg">
</div>
<!-- end add customer modal -->


<!-- The Modal -->
<div id="company_info_wrapper" class="modal" style="padding-top:20px;">
    <!-- Modal content -->
    <div class="modal-content" id="company_info_content">
      <img src="<?php echo base_url(); ?>assets/img/cross_icon.png" alt="" id="company_info_wrapper_close">
      <div class="info_header_section">
        <div class="half floatleft textleft"><p class="header_text">How does this work?</p></div>
        <div class="half floatleft textright"><i class="fas fa-angle-double-up arrow_up"></i><i class="fas fa-angle-double-down arrow_down"></i></div>
      </div>
      <div class="info_paragraph_section">This is a poll for our readers. Simply drag  to the position on the arch that aligns with your opinion. You may also find views from opinion leaders and news sources to help you make your decision. Click on their pictures and you'll get a summary of their opinion. Please note that this poll is non-representative.</div>
      <div class="info_header_section">
        <div class="half floatleft textleft"><p class="header_text">Can I change my vote?</p></div>
        <div class="half floatleft textright"><i class="fas fa-angle-double-up arrow_up"></i><i class="fas fa-angle-double-down arrow_down"></i></div>
      </div>
      <div class="info_paragraph_section">Yes, just move the icon to a different position - but each reader only has one vote! After voting, you'll see where other readers have positioned themselves.</div>
      <!-- <div class="info_header_section">
        <div class="half floatleft textleft"><p class="header_text">What happens to my vote?</p></div>
        <div class="half floatleft textright"><i class="fas fa-angle-double-up arrow_up"></i><i class="fas fa-angle-double-down arrow_down"></i></div>
      </div>                  
      <div class="info_paragraph_section">At Viewpointb, we take your privacy seriously. We do not collect any personal data - the vote data we store is anonymised. More information on Viewpointb's Privacy Policy is available here: Viewpointb Privacy Policy.
If you still wish to opt out, please follow this link and click the Opt Out button at the bottom of the page.</div> -->
    </div>
</div>
<!-- end add customer modal -->



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/topup.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/page_js/debates.js"></script>



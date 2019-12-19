<?php 
    $icon_slider_id1 = "";
    $icon_slider_id2 = "";
    $icon_slider_id3 = "";
    $icon_slider_rotation1 = "";
    $icon_slider_rotation2 = "";
    $icon_slider_rotation3 = "";
    $icon_description1 = "";
    $icon_description2 = "";
    $icon_description3 = "";
    $icon_slider_image1 = "";
    $icon_slider_image2 = "";
    $icon_slider_image3 = "";
    $icon_slider_pointer_show1 = "";
    $icon_slider_pointer_show2 = "";
    $icon_slider_pointer_show3 = "";
    if(count($poll_icons)>0){
        $icon_slider_image_dynamic = "icon_slider_image";
        $icon_slider_pointer_show_dynamic = "icon_slider_pointer_show";
        $icon_slider_id_dynamic = "icon_slider_id";
        $icon_slider_rotation_dynamic = "icon_slider_rotation";
        $icon_description_dynamic = "icon_description";
        
        $i = 1;
        foreach ($poll_icons as $single_icon) {
            ${$icon_slider_image_dynamic . $i} = '<img src="'.base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name.'" id="moving_icon_image_'.$single_icon->id.'" class="moving_icon_image" style="width:45px;transform: rotate('.number_format((float)$single_icon->icon_rotation*-1, 4, '.', '').'deg);"/>';
            ${$icon_slider_pointer_show_dynamic . $i} = 'style="width:45px;transform: rotate('.number_format((float)$single_icon->icon_rotation, 4, '.', '').'deg);"';

            ${$icon_slider_id_dynamic . $i} = $single_icon->icon_id;
            ${$icon_slider_rotation_dynamic . $i} = $single_icon->icon_rotation;
            ${$icon_description_dynamic . $i} = $single_icon->description;

            $i++;
        }
    }

    //calculate percentage of votes
    $total_votes = $total_votes->total_votes;
    $first_percentage = 0;
    $mid_percentage = 0; 
    $last_percentage = 0;
    if($total_votes>0){
        $first_percentage = round(($first * 100) / $total_votes);
        $mid_percentage = round(($mid * 100) / $total_votes); 
        $last_percentage = round(($last * 100) / $total_votes);    
    }

    $indicator_color = '#cfcfcf';
    if($poll->indicator_color!="" || $poll->indicator_color!=null){
        $indicator_color = '#'.$poll->indicator_color;
    }
    
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/editSpeedoMeter.css">
<?php if ($this->session->flashdata('exception')) { ?>
    <div class="container">
        <div class="row">
            <div class="co-md-12" style="margin-top: 20px">
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('exception');?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<section id="all_pool">
    <div class="container" style="background: #fff;margin-top: 20px">
        <div class="row">
            <?php echo form_open(base_url('Dashboard/addEditSpeedoMeterPoll/'.$poll->id),array('id' => 'addEditSpeedoMeterPollForm','method' => 'post','style' => 'width:100%;')); ?>
                <div class="col-md-12 pt-50">
                    <div class="question pt-100">
                        <div class="spee_text">
                            <span style="margin-top: 10px;background: #000;color: #fff;padding: 7px;">Speedometer</span>
                        </div>
                        <div class="question_top">
                            <!-- <input value="<?php echo  $poll->question; ?>" name="question" id="question" class="form-control" type="text" placeholder="Type Your Question ..... " disabled> -->
                            <p id="total_votes_show">Votes: <?php echo  $total_votes; ?></p>
                            <p id="view_question_show"><?php echo  $poll->question; ?></p>
                        </div>
                        <div id="speedo_meter_section">
                            <div class="left">&nbsp;
                            </div>
                            <div class="left">
                                <div id="compass_wrapper2" style="position: relative;">
                                    <div id="compass2">
                                        <div id="compass_hand2" style="background-color:<?php echo $indicator_color; ?>;z-index: 100;"></div>
                                        <div id="speedo_meter_pointer_icon"></div>     
                                        <div class="icon_slider" id="icon_slider1" <?php echo $icon_slider_pointer_show1;?>><?php echo $icon_slider_image1; ?></div>     
                                        <div class="icon_slider" id="icon_slider2" <?php echo $icon_slider_pointer_show2;?>><?php echo $icon_slider_image2; ?></div>     
                                        <div class="icon_slider" id="icon_slider3" <?php echo $icon_slider_pointer_show3;?>><?php echo $icon_slider_image3; ?></div>     
                                        <div id="left_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="left_vote_percentage_text"><?php echo $first_percentage; ?></span>%</div>
                                        <div id="mid_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="mid_vote_percentage_text"><?php echo $mid_percentage; ?></span>%</div>
                                        <div id="right_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="right_vote_percentage_text"><?php echo $last_percentage; ?></span>%</div>
                                    </div>
                                    <div id="debate_between" style="z-index: 100; position:relative;">
                                        <div class="half floatleft"><p class="textleft"><?php echo  $poll->left_label; ?></p></div>
                                        <div class="half floatleft"><p class="textright"><?php echo  $poll->right_label; ?></p></div>
                                    </div>
                                </div>
                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            </div>
                            <div class="left">&nbsp;
                            </div>
                        </div>
                        <div class="question_bottom mt-50 mb-50" style="padding : 20px">
                            <div class="left">
                                <!-- <input value="<?php echo  $poll->left_label; ?>" name="left_label" class="form-control" type="text" placeholder="Left Label ..... " disabled> -->
                            </div>
                            <div class="left">&nbsp;
                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            </div>
                            <div class="left">
                                <!-- <input value="<?php echo  $poll->right_label; ?>" name="right_label" class="form-control" type="text" placeholder="Right Label ..... " style="text-align: right;" disabled> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="poll_id" style="margin-top: -62px;margin-left: 11px;">
                        <label>Poll ID</label><br>
                        <input value="<?php echo  $poll->poll_id; ?>" type="text" name="poll_id" id="poll_id"  style="border: none;border-bottom: 1px solid #666;" disabled>
                    </div>
                    <div class="poll_btn">
                        <a href="<?php echo base_url('Dashboard/editSpeedoMeter/').$poll->id;?>" style="background:#000;color:#fff;">Edit</a>
                        <a href="<?php echo base_url('Dashboard');?>" style="background:#000;color:#fff;">Dashboard</a>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/page_js/viewCompass.js"></script>
<script type="text/javascript">
    
</script>
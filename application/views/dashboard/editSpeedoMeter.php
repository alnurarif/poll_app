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
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/editSpeedoMeter.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/wheelcolorpicker.css" />
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.wheelcolorpicker.min.js"></script>
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
    <span id="embed_script" style="display:none"><iframe src="<?php echo base_url(); ?>Debates/singleDebate/<?php echo $poll->id;?>" width="700px" height="500px"><p>Your browser does not support iframes.</p></iframe></span>
    <div class="container" style="background: #fff;margin-top: 20px">
        <div class="row">
            <?php echo form_open(base_url('Dashboard/addEditSpeedoMeterPoll/'.$poll->id),array('id' => 'addEditSpeedoMeterPollForm','method' => 'post','style' => 'width:100%;')); ?>
                <div class="col-md-12 pt-50">
                    <div class="question pt-100">
                        <div class="spee_text">
                            <span style="margin-top: 10px;background: #000;color: #fff;padding: 7px;">Speedometer</span>
                        </div>
                        <div class="poll_help" id="poll_help">
                            <p><i class="fas fa-question-circle"></i></p>
                        </div>
                        <div class="question_top">
                            <input value="<?php echo  $poll->question; ?>" name="question" id="question" class="form-control" type="text" placeholder="Type Your Question ..... ">
                        </div>
                        <div id="speedo_meter_section">
                            <div class="left">&nbsp;
                            </div>
                            <div class="left">
                                <div id="compass_wrapper2" style="position: relative;">
                                    <div id="compass2">
                                        <div id="speedo_meter_pointer_icon"></div>     
                                        <div class="icon_slider" id="icon_slider1" <?php echo $icon_slider_pointer_show1;?>><?php echo $icon_slider_image1; ?></div>     
                                        <div class="icon_slider" id="icon_slider2" <?php echo $icon_slider_pointer_show2;?>><?php echo $icon_slider_image2; ?></div>     
                                        <div class="icon_slider" id="icon_slider3" <?php echo $icon_slider_pointer_show3;?>><?php echo $icon_slider_image3; ?></div>     
                                        
                                    </div>
                                    <!-- <div id="debate_between">
                                        <div class="half floatleft"><p class="textleft">No. Let Robert Downey Jr. enjoy the time off.</p></div>
                                        <div class="half floatleft"><p class="textright">Yes. I demand more Iron Man.</p></div>
                                    </div> -->
                                </div>
                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            </div>
                            <div class="left">&nbsp;
                            </div>
                        </div>
                        <div class="question_bottom mt-50 mb-50" style="padding : 20px">
                            <input type="hidden" name="icon_slider_id1" id="icon_slider_id_input1" value="<?php echo $icon_slider_id1; ?>">
                            <input type="hidden" name="icon_slider_id2" id="icon_slider_id_input2" value="<?php echo $icon_slider_id2; ?>">
                            <input type="hidden" name="icon_slider_id3" id="icon_slider_id_input3" value="<?php echo $icon_slider_id3; ?>">
                            <input type="hidden" name="icon_slider_rotation1" id="icon_slider_rotation1" value="<?php echo $icon_slider_rotation1; ?>">
                            <input type="hidden" name="icon_slider_rotation2" id="icon_slider_rotation2" value="<?php echo $icon_slider_rotation2; ?>">
                            <input type="hidden" name="icon_slider_rotation3" id="icon_slider_rotation3" value="<?php echo $icon_slider_rotation3; ?>">
                            <input type="hidden" name="icon_description1" id="icon_description1" value="<?php echo $icon_description1; ?>">
                            <input type="hidden" name="icon_description2" id="icon_description2" value="<?php echo $icon_description2; ?>">
                            <input type="hidden" name="icon_description3" id="icon_description3" value="<?php echo $icon_description3; ?>">
                            <div class="left">
                                <input value="<?php echo  $poll->left_label; ?>" name="left_label" class="form-control" type="text" placeholder="Left Label ..... ">
                            </div>
                            <div class="left">
                                <input value="<?php echo  $poll->indicator_color; ?>" name="indicator_color" class="form-control" type="text" placeholder="Indicator Color" style="text-align: left;" data-wheelcolorpicker />
                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            </div>
                            <div class="left">
                                <input value="<?php echo  $poll->right_label; ?>" name="right_label" class="form-control" type="text" placeholder="Right Label ..... " style="text-align: right;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="poll_id" style="margin-top: -62px;margin-left: 11px;">
                        <label>Poll ID</label><br>
                        <input value="<?php echo  $poll->poll_id; ?>" type="text" name="poll_id" id="poll_id"  style="border: none;border-bottom: 1px solid #666;">
                    </div>
                    <div class="poll_btn">
                        <a href="<?php echo base_url('Dashboard');?>">Cancel</a>
                        <a id="copy_embed_script">Copy Embed Script</a>
                        <a href="<?php echo base_url('Dashboard/copySpeedoMeter/'.$poll->id);?>">Copy Poll</a>
                        <a href="<?php echo base_url('Dashboard/viewSpeedoMeter/'.$poll->id);?>">Preview</a>
                        <a onclick="document.getElementById('addEditSpeedoMeterPollForm').submit();">Save & Preview</a>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>

<!-- The Modal -->
<div id="addIconsToSpeedoMeterSection" class="modal" style="padding-top:20px;">

    <!-- Modal content -->
    <div class="modal-content" id="addIconsToSpeedoMeterSectionContent">
        <div class="header">
            <h1>Update Icons</h1>
        </div>
        <div class="updateSpeedoMeterContent">
            <form id="icon_insert_form" name="icon_insert_form">
                <div class="floatleft" id="icon_section">
                    <div id="select_icon_portion">
                        <input type="text" name="" placeholder="Search" id="search_icon">
                        <div class="top_border_div"></div>
                        <div id="previous_icons">
                            
                        </div>
                        <div class="create_icon_footer">
                            <button id="create_new_icon_button">Create New Icon</button>
                        </div>
                    </div>
                    <div id="add_icon_portion">
                        <input type="text" name="icon_name" placeholder="Name" id="icon_name_to_insert">
                        <div class="top_border_div"></div>
                        <div id="upload_icon_file_section">
                            <input type="file" name="icon" id="icon_file" accept="image/*">
                            <div id="show_upload_before_image">
                                
                            </div>    
                        </div>
                        <div class="create_icon_footer">
                            <!-- <input id="icon_submit_button" type="submit" name="submit_icon" value="Submit"/> -->
                            <button id="icon_submit_cancel">Cancel</button>
                            
                        </div>  
                    </div>
                </div>
                <div class="floatleft" id="icon_detail_section">
                    <div id="icon_name_and_detail">
                        <span style="display:none;" id="icon_id_slide_pointer"></span>
                        <span style="display:none;" id="slide_pointer_id"></span>
                        <div class="icon_and_name">
                            <img src="<?php echo base_url(); ?>assets/dashboard/img/profile_avatar.png" id="right_preview_icon_image"/>
                            <p id="icon_name_just_show">Influencer Name</p>
                        </div>
                        <textarea name="icon_detail" id="icon_detail_poll"></textarea>    
                    </div>
                    <div class="create_icon_footer">
                        <input id="icon_submit_button" type="submit" name="submit_icon" value="Save"/>
                        <button type="button" id="icon_submit_button_for_right">Save</button>
                        <button id="icon_save_cancel">Cancel</button>
                    </div>          
                </div>
            </form>
        </div>        
        
        
    </div>

</div>
<!-- end add customer modal -->

<!-- The Modal -->
<div id="copyEmbedScript" class="modal" style="padding-top:20px;">
    <!-- Modal content -->
    <div class="modal-content" id="copyEmbedScriptContent">
        <div class="header">
            <h1 style="text-align: center;">Copied</h1>
        </div>
    </div>
</div>


<!-- end add customer modal -->


<!-- The Modal -->
<div id="helpPollModal" class="modal" style="padding-top:20px;">

    <!-- Modal content -->
    <div class="modal-content" id="helpPollModalContent">
        <div class="close_modal_cross">
          <i class="fas fa-times-circle"></i>
        </div>
        <div class="header">
            <h1>Help</h1>
        </div>
        <div class="body">
          <p>You can see a circle pointer on the half circle line. When it's clicked for twice modal is opened. You can select images for 3 times and move over the line.</p>
        </div>
    </div>

</div>
<!-- end modal -->    


<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/page_js/editSpeedoMeter.js"></script>
<script type="text/javascript">
    $('#copy_embed_script').on('click',function(){
        var $tempElement = $("<input>");
        $("body").append($tempElement);
        $tempElement.val($('#embed_script').html()).select();
        document.execCommand("Copy");
        $tempElement.remove();

        $('#copyEmbedScript').fadeIn('1000');

        setTimeout(function(){
            $('#copyEmbedScript').fadeOut('1000');
        },1500);


    });

    
</script>
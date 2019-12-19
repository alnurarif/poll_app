<?php
    $compass_icon_id1 = "";
    $compass_icon_id2 = "";
    $compass_icon_id3 = "";
    $compass_icon_id4 = "";
    $compass_icon_id5 = "";
    $compass_icon_position1 = "";
    $compass_icon_position2 = "";
    $compass_icon_position3 = "";
    $compass_icon_position4 = "";
    $compass_icon_position5 = "";
    $icon_description1 = "";
    $icon_description2 = "";
    $icon_description3 = "";
    $icon_description4 = "";
    $icon_description5 = "";
    $icons_show = '';
    // dd($poll_icons);
    if(count($poll_icons)>0){
        $icon_slider_image_dynamic = "icon_slider_image";
        $icon_slider_pointer_show_dynamic = "icon_slider_pointer_show";
        $compass_icon_id_dynamic = "compass_icon_id";
        $compass_icon_position_dynamic = "compass_icon_position";
        $icon_description_dynamic = "icon_description";

        $i = 1;
        foreach ($poll_icons as $single_icon) {
            $image_position_array = explode(",",$single_icon->compass_icon_position);
            $icons_show .= '<div class="compass_image_holder"  id="compass_image_holder_'.$i.'" style="top: '.$image_position_array[1].'px;left: '.$image_position_array[0].'px;"><img class="compass_image" id="compass_image_'.$i.'" src="'.base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name.'"></div>';


            ${$compass_icon_id_dynamic . $i} = $single_icon->icon_id;
            ${$compass_icon_position_dynamic . $i} = $single_icon->compass_icon_position;
            ${$icon_description_dynamic . $i} = $single_icon->description;
            $i++;
        }
    }

    // <div class="compass_image_holder" style="top: 186px;left: 199.8125px;"><img src="http://localhost/poll_app/assets/dashboard/img/user_icons/1fcc59bf5113ec39937e9a4ecedc7182.jpg"></div>
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/compass.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/wheelcolorpicker.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/editCompass.css">
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
    <span style="display:none;" id="clickedX"></span>
    <span style="display:none;" id="clickedY"></span>
    <span style="display:none;" id="edit_icon_mode">0</span>
	<!-- <svg viewBox="0 0 500 500">
	  <path id="curve" fill="transparent" d="M73.2,148.6c4-6.1,65.5-96.8,178.6-95.6c111.3,1.2,170.8,90.3,175.1,97" />
	  <text width="500">
	    <textPath xlink:href="#curve">
	      Dangerous Curves Ahead
	    </textPath>
	  </text>
	</svg> -->
    <div class="container" style="background: #fff;margin-top: 20px">
        <div class="row">
            <?php echo form_open(base_url('Dashboard/addEditCompassPoll/'.$poll->id),array('id' => 'addEditCompassPollForm','method' => 'post','style' => 'width:100%;')); ?>
                <div class="col-md-12 pt-50">
                    <div class="question pt-100">
                        <div class="spee_text">
                            <span style="margin-top: 10px;background: #000;color: #fff;padding: 7px;">Compass</span>
                        </div>
                        <div class="poll_help" id="poll_help">
                            <p><i class="fas fa-question-circle"></i></p>
                        </div>
                        <div class="question_top">
                            <input value="<?php echo  $poll->question; ?>" name="question" id="question" class="form-control" type="text" placeholder="Type Your Question ..... ">
                        </div>
						<div id="compass_section">
							<div class="left" style="width:20%;">&nbsp;</div>
							<div class="left" style="width:60%;">
								<div id="compass_wrapper" style="position: relative;">
									
                                    <div id="compass">
                                        <div class="container2">
                                          <!--the holders/targets for the text, reuse as desired-->
                                          <div class="circTxt" id="test"></div>
                                        </div>    
                                        <?php echo $icons_show; ?>
										<div id="compass_hand" style="display:none;"></div>
									</div>
								</div>
							</div>
							<div class="left" style="width:20%;">&nbsp;</div>
						</div>
                        <div class="question_bottom mt-50 mb-50" style="padding : 20px;padding: 20px;margin: 15px 0px 70px 0px;}">
                            <input type="hidden" name="compass_icon_id1" id="compass_icon_id_input1" value="<?php echo $compass_icon_id1; ?>">
                            <input type="hidden" name="compass_icon_id2" id="compass_icon_id_input2" value="<?php echo $compass_icon_id2; ?>">
                            <input type="hidden" name="compass_icon_id3" id="compass_icon_id_input3" value="<?php echo $compass_icon_id3; ?>">
                            <input type="hidden" name="compass_icon_id4" id="compass_icon_id_input4" value="<?php echo $compass_icon_id4; ?>">
                            <input type="hidden" name="compass_icon_id5" id="compass_icon_id_input5" value="<?php echo $compass_icon_id5; ?>">
                            <input type="hidden" name="compass_icon_position1" id="compass_icon_position1" value="<?php echo $compass_icon_position1; ?>">
                            <input type="hidden" name="compass_icon_position2" id="compass_icon_position2" value="<?php echo $compass_icon_position2; ?>">
                            <input type="hidden" name="compass_icon_position3" id="compass_icon_position3" value="<?php echo $compass_icon_position3; ?>">
                            <input type="hidden" name="compass_icon_position4" id="compass_icon_position4" value="<?php echo $compass_icon_position4; ?>">
                            <input type="hidden" name="compass_icon_position5" id="compass_icon_position5" value="<?php echo $compass_icon_position5; ?>">
                            <input type="hidden" name="icon_description1" id="icon_description1" value="<?php echo $icon_description1; ?>">
                            <input type="hidden" name="icon_description2" id="icon_description2" value="<?php echo $icon_description2; ?>">
                            <input type="hidden" name="icon_description3" id="icon_description3" value="<?php echo $icon_description3; ?>">
                            <input type="hidden" name="icon_description4" id="icon_description4" value="<?php echo $icon_description4; ?>">
                            <input type="hidden" name="icon_description5" id="icon_description5" value="<?php echo $icon_description5; ?>">
                            <div class="left">
                                <input value="<?php echo  $poll->first_label; ?>" name="first_label" class="form-control compass_option" type="text" placeholder="First Label ..... " id="compass_option_1">
                            </div>
                            <div class="left">
                                <?php if($company->package_id == 1 || $company->package_id == 2 || $company->package_id == 4 || $company->package_id == 5) {?>
                                <input value="<?php echo  $poll->indicator_color; ?>" name="indicator_color" class="form-control" type="text" placeholder="Indicator Color" style="text-align: left;" data-wheelcolorpicker />
                                <?php }else{echo "&nbsp;";} ?>                                
                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            </div>
                            <div class="left">
                                <input value="<?php echo  $poll->second_label; ?>" name="second_label" class="form-control compass_option" type="text" placeholder="Second Label ..... " style="text-align: right;" id="compass_option_2">
                            </div>
                            <div style="margin-top: 50px;overflow:hidden;width:100%;">
                            	<div class="left">
	                                <input value="<?php echo  $poll->third_label; ?>" name="third_label" class="form-control compass_option" type="text" placeholder="Third Label ..... " id="compass_option_3">
	                            </div>
	                            <div class="left">&nbsp;
	                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
	                            </div>
	                            <div class="left">
	                                <input value="<?php echo  $poll->forth_label; ?>" name="forth_label" class="form-control compass_option" type="text" placeholder="Forth Label ..... " style="text-align: right;" id="compass_option_4">
	                            </div>	
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
                        <a href="<?php echo base_url('Dashboard/copyCompass/'.$poll->id);?>">Copy Poll</a>
                        <a href="<?php echo base_url('Dashboard/viewCompass/'.$poll->id);?>">Preview</a>
                        <a onclick="document.getElementById('addEditCompassPollForm').submit();">Save & Preview</a>
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
            <span style="display:none;" id="requested_pointer_id"></span>
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
          <p>There is a compass. When it's clicked for twice inside of the compass, modal is opened. You can select images for 5 times.</p>
        </div>
    </div>

</div>
<!-- end modal -->  

<!-- The Modal -->
<div id="compassImageOperationModal" class="modal" style="padding-top:20px;">

    <!-- Modal content -->
    <div class="modal-content" id="compassImageOperationModalContent">
        <div class="close_modal_cross">
          <i class="fas fa-times-circle"></i>
        </div>
        <div class="header">
            <h1>Compass Image Operation</h1>
        </div>
        <div class="body">
            <span id="icon_number_selected" style="display:none;"></span>
            <button id="remove_this_icon">Remove This Icon</button>
            <button id="change_this_icon">Change This Icon</button>
        </div>
    </div>

</div>
<!-- end modal -->  


<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/page_js/editCompass.js"></script>
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
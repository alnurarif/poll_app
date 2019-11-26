<?php 
	$icon_slider_id1 = "";
    $icon_slider_id2 = "";
    $icon_description1 = "";
    $icon_description2 = "";
    $icon_slider_image1 = base_url()."assets/dashboard/img/profile_avatar.png";
    $icon_slider_image2 = base_url()."assets/dashboard/img/profile_avatar.png";
    // dd($poll_icons);
    if(count($poll_icons)>0){
        
        $i = 1;
        foreach ($poll_icons as $single_icon) {
        	if($single_icon->icon_side == "Left"){
        		$icon_slider_image1 = base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name;
	            
	            $icon_slider_id1 = $single_icon->icon_id;
	            $icon_description1 = $single_icon->description;
        	}elseif($single_icon->icon_side == "Right"){
        		$icon_slider_image2 = base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name;
        		$icon_slider_id2 = $single_icon->icon_id;
	            $icon_description2 = $single_icon->description;
        	}
            

            $i++;
        }
    }
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/editSliderPoll.css">
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>
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
			<?php echo form_open(base_url('Dashboard/addEditSliderPoll/'.$poll->id),array('id' => 'addEditSliderPollForm','method' => 'post','style' => 'width:100%;')); ?>
				<div class="col-md-12 pt-50">
					<div class="question pt-100">
						<div class="spee_text">
                            <span style="margin-top: 10px;background: #000;color: #fff;padding: 7px;">Slider</span>
                        </div>
                        <div class="poll_help" id="poll_help">
                            <p><i class="fas fa-question-circle"></i></p>
                        </div>
						<div class="question_top">
							<input value="<?php echo  $poll->question; ?>" name="question" id="question" class="form-control" type="text" placeholder="Type Your Question ..... ">
						</div>

						<div id="slider_poll_section">
                            <div id="plain_slider_wrapper">
						        <div id="plain_slider">
						            <div id="slider">
						                <div class="first floatleft slider_get_icon" id="slider_get_icon1"><img src="<?php echo $icon_slider_image1; ?>"></div>
						                <div class="second floatleft">
						                    <div id="slide_line"></div>
						                    <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/profile_avatar.png"/> -->
						                </div>
						                <div class="third floatleft slider_get_icon" id="slider_get_icon2"><img src="<?php echo $icon_slider_image2; ?>"></div>
						            </div>
						            <!-- <div id="slider_options">
						                <div class="left_space floatleft"></div>
						                <div class="left_option floatleft textleft">Yes, she's trying to raise awareness of important issues</div>            
						                <div class="right_option floatleft textright">No, her actions are an insult to the country</div>            
						                <div class="right_space floatleft"></div>
						            </div> -->
						        </div>
						    </div>
                            <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            
                        </div>

						<div class="question_bottom mt-50 mb-50" style="padding : 20px;margin-top:0px;">
							<input type="hidden" name="icon_slider_id1" id="icon_slider_id_input1" value="<?php echo $icon_slider_id1; ?>">
                            <input type="hidden" name="icon_slider_id2" id="icon_slider_id_input2" value="<?php echo $icon_slider_id2; ?>">
                            <input type="hidden" name="icon_description1" id="icon_description1" value="<?php echo $icon_description1; ?>">
                            <input type="hidden" name="icon_description2" id="icon_description2" value="<?php echo $icon_description2; ?>">
							<div class="left">
								<input value="<?php echo  $poll->left_label; ?>" name="left_label" class="form-control" type="text" placeholder="Left Label ..... ">
							</div>
							<div class="left">&nbsp;
								<!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/Screenshot_1.png" style="width: 97%;margin-top: -118px;margin-left: 9px;"> -->
							</div>
							<div class="left">
								<input value="<?php echo  $poll->right_label; ?>" name="right_label" class="form-control" type="text" placeholder="Right Label ..... " style="text-align:right">
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
                        <a href="<?php echo base_url('Dashboard/copySliderPoll/'.$poll->id);?>">Copy Poll</a>
                        <a href="<?php echo base_url('Dashboard/viewSliderPoll/'.$poll->id);?>">Preview</a>
                        <a onclick="document.getElementById('addEditSliderPollForm').submit();">Save & Preview</a>
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
          <p>You'll see two images to two sides of slider. To add new picture or update you have to click for twice, then a modal will be appeared. Choose a new image or upload new image then select a image among images.</p>
        </div>
    </div>

</div>
<!-- end modal -->    

<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/page_js/editSliderPoll.js"></script>

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
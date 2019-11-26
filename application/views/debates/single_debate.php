<?php 
	$debate = '';
	// dd($poll);
	if($poll->poll_type == 'Slider'){

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
	        	}elseif($single_icon->icon_side == "Right"){
	        		$icon_slider_image2 = base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name;
	        	}

	            $i++;
	        }
	    }

		$debate .= '<div id="plain_slider_wrapper">';
			$debate .= '<div style="margin:5px auto; text-align:center;">';
				$debate .= '<div id="piechart" style="width: 400px; height: 200px;margin:0 auto;display: none;"></div>';
			$debate .= '</div>';
			$debate .= '<div id="plain_slider">';
				$debate .= '<div id="slider">';
					$debate .= '<div class="first floatleft slider_get_icon" id="slider_get_icon1"><img src="'.$icon_slider_image1.'"></div>';
					$debate .= '<div class="second floatleft">';
						$debate .= '<div id="slide_line"></div>';
						$debate .= '<img src="'.base_url().'assets/dashboard/img/profile_avatar.png"/>';
					$debate .= '</div>';
					$debate .= '<div class="third floatleft slider_get_icon" id="slider_get_icon2"><img src="'.$icon_slider_image2.'"></div>';
				$debate .= '</div>';
				$debate .= '<div id="slider_options">';
					$debate .= '<div id="show_vote_percentage">';
						$debate .= '<div class="floatleft" style="width:33.3333%"><p class="slider_percentage_text"><span id="slider_left_percentage_text">13</span>%</p></div>';
						$debate .= '<div class="floatleft" style="width:33.3333%"><p class="slider_percentage_text"><span id="slider_mid_percentage_text">35</span>%</p></div>';
						$debate .= '<div class="floatleft" style="width:33.3333%"><p class="slider_percentage_text"><span id="slider_right_percentage_text">52</span>%</p></div>';
					$debate .= '</div>';
					$debate .= '<div class="left_space floatleft"></div>';
					$debate .= '<div class="left_option floatleft textleft" id="slide_left_answer">'.$poll->left_label.'</div>';            
					$debate .= '<div class="right_option floatleft textright" id="slide_right_answer">'.$poll->right_label.'</div>';            
					$debate .= '<div class="right_space floatleft"></div>';
				$debate .= '</div>';
			$debate .= '</div>';
		$debate .= '</div>';

		
	}elseif($poll->poll_type == 'Compass'){

		$compass_icon_image = '';
		if(count($poll_icons)>0){
		    $i = 1;
		    foreach ($poll_icons as $single_icon) {
		    	$image_position_array = explode(",",$single_icon->compass_icon_position);
	        		
	        	$compass_icon_image .= '<div class="compass_image_holder" style="top: '.$image_position_array[1].'px;left: '.$image_position_array[0].'px;">';
	        		$compass_icon_image .= '<img src="'.base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name.'">';
	        	$compass_icon_image .= '</div>';
	        	
	            $i++;
		    }
		}
		$debate .= '<div id="compass_wrapper" style="position: relative;">';
			$debate .= '<div id="compass">';
				$debate .= $compass_icon_image;
				$debate .= '<div class="container2">';
					$debate .= '<div class="circTxt" id="test"></div>';
				$debate .= '</div>';
				$debate .= '<div id="compass_hand"></div>';
				$debate .= '<div id="compass_vote_percentage_1" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_1">36</span>%</div>';
				$debate .= '<div id="compass_vote_percentage_2" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_2">36</span>%</div>';
				$debate .= '<div id="compass_vote_percentage_3" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_3">36</span>%</div>';
				$debate .= '<div id="compass_vote_percentage_4" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_4">36</span>%</div>';
				$debate .= '<div id="compass_vote_percentage_5" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_5">36</span>%</div>';
				$debate .= '<div id="compass_vote_percentage_6" class="compass_vote_percentage_text"><span id="compass_vote_percentage_text_6">36</span>%</div>';
			$debate .= '</div>';
		$debate .= '</div>';
	}elseif($poll->poll_type == 'Speedo Meter'){
		$icon_slider_image1 = ""; 
		$icon_slider_image2 = ""; 
		$icon_slider_image3 = ""; 
		$icon_slider_pointer_show1 = ""; 
		$icon_slider_pointer_show2 = ""; 
		$icon_slider_pointer_show3 = ""; 
		// $('#icon_slider1,#icon_slider2,#icon_slider3').html('').css('width','0px').css('transform','rotate(0deg'); 
		

		$icon_slider1_image = '';
		$icon_slider2_image = '';
		$icon_slider3_image = '';
		$icon_sliders = '';
		if(count($poll_icons)>0){
			$i = 1;
			foreach($poll_icons as $single_icon){
				if($i==1){
					$icon_slider1_image = '<img style="transform: rotate('.number_format((float)$single_icon->icon_rotation*-1, 4, '.', '').'deg)" src="'.base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name.'" id="moving_icon_image_'.$single_icon->id.'" class="moving_icon_image"/>';
				}
				if($i==2){
					$icon_slider2_image = '<img style="transform: rotate('.number_format((float)$single_icon->icon_rotation*-1, 4, '.', '').'deg)" src="'.base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name.'" id="moving_icon_image_'.$single_icon->id.'" class="moving_icon_image"/>';
				}
				if($i==3){
					$icon_slider3_image = '<img style="transform: rotate('.number_format((float)$single_icon->icon_rotation*-1, 4, '.', '').'deg)" src="'.base_url().'assets/dashboard/img/user_icons/'.$single_icon->icon_file_name.'" id="moving_icon_image_'.$single_icon->id.'" class="moving_icon_image"/>';
				}
				$i++;
			}
		}
		$company_image = 'profile_avatar.png';
		if($poll->company_logo!="" || $poll->company_logo!=null){
			$company_image = 'logos/'.$poll->company_logo;
		}
		$indicator_color = '#cfcfcf';
		if($poll->indicator_color!="" || $poll->indicator_color!=null){
			$indicator_color = '#'.$poll->indicator_color;
		}
		$debate .= '<div id="compass_wrapper2" style="position: relative;">';
			$debate .= '<div id="compass2">';
				$debate .= '<div id="compass_hand2" style="background-color:'.$indicator_color.'"><img src="'.base_url().'assets/dashboard/img/'.$company_image.'" id="compass_hand_company_logo"></div>';
				$debate .= '<div id="speedo_meter_pointer_icon"><img src="'.base_url().'assets/dashboard/img/profile_avatar.png"></div>';
				$debate .= '<div class="icon_slider" id="icon_slider1">'.$icon_slider1_image.'</div>';
				$debate .= '<div class="icon_slider" id="icon_slider2">'.$icon_slider2_image.'</div>';
				$debate .= '<div class="icon_slider" id="icon_slider3">'.$icon_slider3_image.'</div>';
				$debate .= '<div id="left_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="left_vote_percentage_text">36</span>%</div>';
				$debate .= '<div id="mid_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="mid_vote_percentage_text">9</span>%</div>';
				$debate .= '<div id="right_vote_percentage" class="speedo_meter_vote_percentage_text"><span id="right_vote_percentage_text">55</span>%</div>';
			$debate .= '</div>';
			$debate .= '<div id="debate_between">';
				$debate .= '<div class="half floatleft"><p class="textleft floatleft" id="left_label_text">'.$poll->left_label.'</p></div>';
				$debate .= '<div class="half floatright"><p class="textright floatright" id="right_label_text">'.$poll->right_label.'</p></div>';
			$debate .= '</div>';
		$debate .= '</div>';
	}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Site Title Here</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/meanmenu.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
        
        <script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.12.4.min.js"></script>
        
        <base data-base="<?php echo base_url(); ?>"></base>
        <style type="text/css">
			#wrapper_poll {
			    margin: 0px 0px 0px 0px !important;
			    height: 570px !important;
			}
			#total_poll_section {
				padding: 0px 0px !important; 
			}
			#poll_holder {
			    border: none !important;
			}
			#total_poll_section {
			    margin: 0px 0px 0px 0px !important;
			}
			#poll_holder {
		   		padding: 25px 0px 15px 0px !important;
		   	}
		   	#poll_holder_inside {
			    padding: 5px 0px 0px 0px !important;
			}
			#question {
			    margin: 0px 0px 20px 0px !important;
			}
		</style>
    </head>
    <body>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/page_style/debates.css">
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>
<span id="selected_poll_id" style="display:none;"><?php echo $poll->id; ?></span>
<div class="row" id="wrapper_poll">
	<div id="total_poll_section">
		<div id="poll_holder">
			<div id="poll_holder_inside">
				<div id="question">
					<h2 id="question_header"><?php echo $poll->question; ?></h2>
				</div>
				

				
				<?php echo $debate; ?>
				


				<div id="social_share_vote_section">
					<div class="social_share floatleft half textleft">
						<img src="<?php echo base_url();?>assets/img/fb_share.png" style="float:left;width:70px;height:30px;margin-right:5px;">
						<img src="<?php echo base_url();?>assets/img/tweet.png" style="float:left;width:70px;height:30px;margin-right:5px;">
					</div>
					<div class="vote_section floatright half textright"><span id="user_voted"><?php echo $total_votes->total_votes;?></span> Votes</div>
				</div>
			</div>
			<div id="company_logo_very_small">
				<img src="<?php echo base_url();?>assets/img/cropped-Tiger-logo.png">
				<img id="information_icon" src="<?php echo base_url();?>assets/img/information_icon.png">
			</div>

		</div>  
	</div>

</div>

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/topup.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/page_js/debates.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/isotope.pkgd.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/one-page-nav-min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.meanmenu.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ajax-form.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
		<script type="text/javascript">
			<?php

			if($poll->poll_type == 'Compass'){?>
				run_compass_pointer();
				circularText('<?php echo $poll->first_label; ?>', 175, 0, 0);
				circularText('<?php echo $poll->second_label; ?>', 175, 0, 90);
				circularText('<?php echo $poll->third_label; ?>', 175, 0, 180);
				circularText('<?php echo $poll->forth_label; ?>', 175, 0, 270);
			<?php }?>

			<?php if($poll->poll_type == 'Speedo Meter'){?>
				run_speedo_meter_pointer(); 
				if($('#icon_slider1').html()!=""){
					$('#icon_slider1').css('width','45px').css('transform','rotate('+parseFloat(<?php if(isset($poll_icons[0]->icon_rotation)){echo $poll_icons[0]->icon_rotation;}else{echo 0;} ?>).toFixed(4)+'deg');
				}
				if($('#icon_slider2').html()!=""){
					$('#icon_slider2').css('width','45px').css('transform','rotate('+parseFloat(<?php if(isset($poll_icons[1]->icon_rotation)){echo $poll_icons[1]->icon_rotation;}else{echo 0;} ?>).toFixed(4)+'deg');
				}
				if($('#icon_slider3').html()!=""){
					$('#icon_slider3').css('width','45px').css('transform','rotate('+parseFloat(<?php if(isset($poll_icons[2]->icon_rotation)){echo $poll_icons[2]->icon_rotation;}else{echo 0;} ?>).toFixed(4)+'deg');					
				}
			<?php } ?>
		</script>
	</body>
</html>
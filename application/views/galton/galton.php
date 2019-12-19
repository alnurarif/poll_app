<?php 
	$galton_bar_and_drop_color = ($galton->galton_color)? "#".$galton->galton_color: "#80c5de";
	// $galton_bar_and_drop_color = "#7f00ff";
	$galton_icon = ($galton->icon_file_name)?base_url()."assets/galton_board/img/user_icons/".$galton->icon_file_name:base_url()."assets/dashboard/img/profile_avatar.png";

	$galton_info = $galton_info;
	$last_galton_result_array = $galton_info['last_galton_result_array'];
	
	$galton_bar_height1 = ($last_galton_result_array[0]*100)/$galton_info['votes'];
	$galton_bar_height2 = ($last_galton_result_array[1]*100)/$galton_info['votes'];
	$galton_bar_height3 = ($last_galton_result_array[2]*100)/$galton_info['votes'];
	$galton_bar_height4 = ($last_galton_result_array[3]*100)/$galton_info['votes'];
	$galton_bar_height5 = ($last_galton_result_array[4]*100)/$galton_info['votes'];
	$galton_bar_height6 = ($last_galton_result_array[5]*100)/$galton_info['votes'];
	$galton_bar_height7 = ($last_galton_result_array[6]*100)/$galton_info['votes'];
	$galton_bar_height8 = ($last_galton_result_array[7]*100)/$galton_info['votes'];
	$galton_bar_height9 = ($last_galton_result_array[8]*100)/$galton_info['votes'];
	$galton_bar_height10 = ($last_galton_result_array[9]*100)/$galton_info['votes'];
	$galton_bar_height11 = ($last_galton_result_array[10]*100)/$galton_info['votes'];
	// dd($last_galton_result_array); 

?>
<style type="text/css">
	#galton .bar{
		width:25px;
		margin-right:.09%;
		background:<?php echo $galton_bar_and_drop_color; ?>;
		float:left;
		height:50%;
		position:absolute;
		bottom:0px;
		transition: height 5s;
		height:0px;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/galton_board/css/page_style/galton_board.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/wheelcolorpicker.css" />
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/jquery.wheelcolorpicker.min.js"></script>
<div id="galton_wrapper">
	<div class="galton_icon_section">
		<img src="<?php echo $galton_icon; ?>" id="galton_icon">	
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

<div class="edit_section fix">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php echo form_open(base_url('Galton_board/addEditGaltonFrom'),array('id' => 'addEditGaltonForm','method' => 'post','style' => 'width:100%;', 'enctype' => 'multipart/form-data')); ?>
			    <input value="<?php echo $galton->galton_color; ?>" name="galton_color" class="form-control" type="text" placeholder="Galton Color" style="text-align: left;" data-wheelcolorpicker />
			    <!-- <input value="" name="first_label" class="form-control" type="text" placeholder="First Label ..... " id="compass_option_1"> -->
			    Select icon to upload:
			    <input class="form-control" type="file" name="galton_icon" id="galton_icon_upload" accept="image/*">
			    <input class="form-control" type="submit" value="Update" name="submit">
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-4"></div>
	</div>
	
</div>
<script type="text/javascript">
	var base_url = $('base').attr('data-base');
	var galton_bar_height1 = <?php echo $galton_bar_height1; ?>;
	var galton_bar_height2 = <?php echo $galton_bar_height2; ?>;
	var galton_bar_height3 = <?php echo $galton_bar_height3; ?>;
	var galton_bar_height4 = <?php echo $galton_bar_height4; ?>;
	var galton_bar_height5 = <?php echo $galton_bar_height5; ?>;
	var galton_bar_height6 = <?php echo $galton_bar_height6; ?>;
	var galton_bar_height7 = <?php echo $galton_bar_height7; ?>;
	var galton_bar_height8 = <?php echo $galton_bar_height8; ?>;
	var galton_bar_height9 = <?php echo $galton_bar_height9; ?>;
	var galton_bar_height10 = <?php echo $galton_bar_height10; ?>;
	var galton_bar_height11 = <?php echo $galton_bar_height11; ?>;
	for(i=0;i<400;i++){

		var image_left = Math.floor(Math.random() * 400) + 1;
		
		$('#galton').append('<svg width="5px" viewbox="0 0 30 42" style="left:'+image_left+'px"> <path fill="<?php echo $galton_bar_and_drop_color; ?>" stroke="<?php echo $galton_bar_and_drop_color; ?>" stroke-width="1.5"d="M15 3 Q16.5 6.8 25 18 A12.8 12.8 0 1 1 5 18 Q13.5 6.8 15 3z" /> </svg>'); 
		// <path stroke-width="2.5" d="M15 3 Q16.5 6.8 25 148 A18.8 16.8 0 1 1 5 148 Q16.5 6.8 15 3z" />
		// $('#galton').append('<img style="left:'+image_left+'px" src="'+base_url+'assets/dashboard/img/rain_drop_small.png" class="rain_drop"/>');
		
	}
	// <path stroke-width="2.5" d="M15 3 Q16.5 6.8 25 148 A18.8 16.8 0 1 1 5 148 Q16.5 6.8 15 3z" />
	
	setTimeout(function(){ 
		$('#galton_bar1').css('height',galton_bar_height1*2+'%')
		$('#galton_bar2').css('height',galton_bar_height2*2+'%')
		$('#galton_bar3').css('height',galton_bar_height3*2+'%')
		$('#galton_bar4').css('height',galton_bar_height4*2+'%')
		$('#galton_bar5').css('height',galton_bar_height5*2+'%')
		$('#galton_bar6').css('height',galton_bar_height6*2+'%')
		$('#galton_bar7').css('height',galton_bar_height7*2+'%')
		$('#galton_bar8').css('height',galton_bar_height8*2+'%')
		$('#galton_bar9').css('height',galton_bar_height9*2+'%')
		$('#galton_bar10').css('height',galton_bar_height10*2+'%')
		$('#galton_bar11').css('height',galton_bar_height11*2+'%')

	}, 1500);


	for (var i=0;i<=400;i++) {
		(function(ind) {
			setTimeout(function(){
				$('#galton svg').eq(ind).css('top','400px');
				// $('#galton .rain_drop').eq(ind).css('top','400px');
			}, 10 * ind);
		})(i);
	}


	console.log(galton_bar_height1, galton_bar_height2, galton_bar_height3, galton_bar_height4, galton_bar_height5, galton_bar_height6, galton_bar_height7, galton_bar_height8, galton_bar_height9, galton_bar_height10, galton_bar_height11); 
</script>
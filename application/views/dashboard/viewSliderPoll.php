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
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/editSliderPoll.css">
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
			<?php echo form_open(base_url('Dashboard/addEditSliderPoll/'.$poll->id),array('id' => 'addEditSliderPollForm','method' => 'post','style' => 'width:100%;')); ?>
				<div class="col-md-12 pt-50">
					<div class="question pt-100">
						<div class="spee_text">
                            <span style="margin-top: 10px;background: #000;color: #fff;padding: 7px;">Slider</span>
                        </div>
						<div class="question_top">
							<!-- <input value="<?php echo  $poll->question; ?>" name="question" id="question" class="form-control" type="text" placeholder="Type Your Question ..... " disabled> -->
							<p id="total_votes_show">Votes: <?php echo  $total_votes; ?></p>
                            <p id="view_question_show"><?php echo  $poll->question; ?></p>
						</div>
						<div id="slider_poll_section" style="height:450px;">
                            <div id="plain_slider_wrapper">
								<div style="margin:5px auto; text-align:center;">
									<div id="piechart" style="width: 400px; height: 300px;margin:0 auto;"></div>
									<!-- <canvas id="graph" width="450" height="150" align="center"></canvas> -->
								</div>
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
						            <div id="slider_options">
						            	<div id="show_vote_percentage">
						            		<div class="floatleft" style="width:33.3333%"><p class='slider_percentage_text'><span id="slider_left_percentage_text"><?php echo $first_percentage; ?></span>%</p></div>
						            		<div class="floatleft" style="width:33.3333%"><p class='slider_percentage_text'><span id="slider_mid_percentage_text"><?php echo $mid_percentage; ?></span>%</p></div>
						            		<div class="floatleft" style="width:33.3333%"><p class='slider_percentage_text'><span id="slider_right_percentage_text"><?php echo $last_percentage; ?></span>%</p></div>
						            	</div>
						            	<div class="left_space floatleft"></div>
						            	<div class="left_option floatleft textleft" id="slide_left_answer"><?php echo  $poll->left_label; ?></div>            
						            	<div class="right_option floatleft textright" id="slide_right_answer"><?php echo  $poll->right_label; ?></div>            
						            	<div class="right_space floatleft"></div>
						            </div>
						        </div>
						    </div>
                            <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            
                        </div>
						<div class="question_bottom mt-50 mb-50" style="padding : 20px;overflow: hidden;margin: 0px;">
							<div class="left">
								<!-- <input value="<?php echo  $poll->left_label; ?>" name="left_label" class="form-control" type="text" placeholder="Left Label ..... " disabled> -->
							</div>
							<div class="left">&nbsp;
								<!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/Screenshot_1.png" style="width: 97%;margin-top: -118px;margin-left: 9px;"> -->
							</div>
							<div class="left">
								<!-- <input value="<?php echo  $poll->right_label; ?>" name="right_label" class="form-control" type="text" placeholder="Right Label ..... " style="text-align:right" disabled> -->
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
                        <a href="<?php echo base_url('Dashboard/editSliderPoll/').$poll->id;?>" style="background:#000;color:#fff;">Edit</a>
                        <a href="<?php echo base_url('Dashboard');?>" style="background:#000;color:#fff;">Dashboard</a>
                    </div>
                </div>
            <?php echo form_close(); ?>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/topup.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/page_js/viewSliderPoll.js"></script>
<script type="text/javascript">
	window.percentages = [<?php echo json_encode($all_percentages);?>]; 
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Vote', 'Percentage'],
      ['First', <?php echo $first_percentage; ?>],
      ['Mid', <?php echo $mid_percentage; ?>],
      ['Last', <?php echo $last_percentage; ?>]
    ]);

    var options = {
      title: 'Vote Percentage'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>
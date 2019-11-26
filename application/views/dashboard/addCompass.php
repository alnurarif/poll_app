<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/page_style/compass.css">

<section id="all_pool">
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
            <?php echo form_open(base_url('Dashboard/addEditCompassPoll'),array('id' => 'addEditCompassPollForm','method' => 'post','style' => 'width:100%;')); ?>
                <div class="col-md-12 pt-50">
                    <div class="question pt-100">
                        <div class="spee_text">
                            <span style="margin-top: 10px;background: #000;color: #fff;padding: 7px;">Compass</span>
                        </div>
                        <div class="question_top">
                            <input name="question" id="question" class="form-control" type="text" placeholder="Type Your Question ..... ">
                        </div>
						<div id="compass_section">
							<div class="left">&nbsp;</div>
							<div class="left">
								<div id="compass_wrapper" style="position: relative;">
									<div id="compass">
										<div id="compass_hand"></div>
									</div>
								</div>
							</div>
							<div class="left">&nbsp;</div>
						</div>
                        <div class="question_bottom mt-50 mb-50" style="padding : 20px;padding: 20px;margin: 15px 0px 70px 0px;}">
                            <div class="left">
                                <input name="first_label" class="form-control" type="text" placeholder="First Label ..... ">
                            </div>
                            <div class="left">&nbsp;
                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
                            </div>
                            <div class="left">
                                <input name="second_label" class="form-control" type="text" placeholder="Second Label ..... " style="text-align: right;">
                            </div>
                            <div style="margin-top: 50px;overflow:hidden;width:100%;">
                            	<div class="left">
	                                <input name="third_label" class="form-control" type="text" placeholder="Third Label ..... ">
	                            </div>
	                            <div class="left">&nbsp;
	                                <!-- <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;"> -->
	                            </div>
	                            <div class="left">
	                                <input name="forth_label" class="form-control" type="text" placeholder="Forth Label ..... " style="text-align: right;">
	                            </div>	
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="poll_id" style="margin-top: -62px;margin-left: 11px;">
                        <label>Poll ID</label><br>
                        <input type="text" name="poll_id" id="poll_id"  style="border: none;border-bottom: 1px solid #666;">
                    </div>
                    <div class="poll_btn">
                        <a href="<?php echo base_url('Dashboard');?>">Cancel</a>
                        <a onclick="document.getElementById('addEditCompassPollForm').submit();">Save & Preview</a>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<script type="text/javascript">
    
</script>
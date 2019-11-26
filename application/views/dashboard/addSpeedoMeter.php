<section id="all_pool">
    <div class="container" style="background: #fff;margin-top: 20px">
        <div class="row">
            <?php echo form_open(base_url('Dashboard/addEditSpeedoMeterPoll'),array('id' => 'addEditSpeedoMeterPollForm','method' => 'post','style' => 'width:100%;')); ?>
                <div class="col-md-12 pt-50">
                    <div class="question pt-100">
                        <div class="spee_text">
                            <span style="margin-top: 10px;background: #000;color: #fff;padding: 7px;">Speedometer</span>
                        </div>
                        <div class="question_top">
                            <input name="question" id="question" class="form-control" type="text" placeholder="Type Your Question ..... ">
                        </div>
                        <div class="question_bottom mt-50 mb-50" style="padding : 20px">
                            <div class="left">
                                <input name="left_label" class="form-control" type="text" placeholder="Left Label ..... ">
                            </div>
                            <div class="left">
                                <img src="<?php echo base_url(); ?>assets/dashboard/img/download.png" style="margin-top: -179px;">
                            </div>
                            <div class="left">
                                <input name="right_label" class="form-control" type="text" placeholder="Right Label ..... " style="text-align: right;">
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
                        <a onclick="document.getElementById('addEditSpeedoMeterPollForm').submit();">Save & Preview</a>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<script type="text/javascript">
    
</script>

<!-- Not verified section -->

<section id="note_verified_section" style="margin:80px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 id="email_not_verified_message" style="text-align:center">Dear <?php echo $company->name; ?>,<br/>Your email is not verified yet.</h1>

            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php echo form_open(base_url('Verification_email/send_verification_mail'),array('class' => 'mt-100 mb-100', 'id' => 'companyLoginForm', 'method' => 'post')); ?>
                    <div class="form-group" style="text-align:center;">
                        <input type="hidden" name="id" value="<?php echo $company->id;?>">
                        <input type="submit" name="submit" value="Send verification mail" class="btn btn-primary"/>    
                    </div>
                    
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-4"></div>
        </div> 
    </div>
</section>

       
    


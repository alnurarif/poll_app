
<!-- Login form -->

<section id="login_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php echo form_open(base_url('Authentication/loginCheck'),array('class' => 'mt-100 mb-100', 'id' => 'companyLoginForm', 'method' => 'post')); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <input name="remember_me" type="checkbox" class="form-check-input" id="exampleCheck1" value="remember_me">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                    <p style="color: #000;font-size: 14px;margin: 0px;line-height: 45px;">Don't have an account? <a href="<?php echo base_url();?>Authentication/signup">Sign Up</a></p>
                <?php echo form_close(); ?>

            </div>
            <div class="col-md-4"></div>
        </div> 
    </div>
</section>

       
    


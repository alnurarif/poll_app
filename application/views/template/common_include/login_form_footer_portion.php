<?php echo form_open(base_url('Authentication/loginCheck'),array('id' => 'companyLoginForm', 'method' => 'post')); ?>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

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
<?php echo form_close(); ?>
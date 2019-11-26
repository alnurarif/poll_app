<?php 
  $countries_to_show = '';
  if(count($countries)>0){
    foreach($countries as $country){
      $countries_to_show .= '<option value="'.$country->id.'">'.$country->name.'</option>';
    }
  }
?>
        <!-- Login form -->

        <section id="login_section">
            <div class="container">
               <div class="row">
                   <div class="col-md-4"></div>
                   <div class="col-md-4">
                        <?php echo form_open(base_url('Authentication/registerCompany'),array('class' => 'mt-100 mb-100', 'id' => 'companyRegisterForm', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="name" type="text" class="form-control"  placeholder="Name">
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input name="phone" type="text" class="form-control"  placeholder="Phone">
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Company Logo</label>
                            <input name="logo" type="file" class="form-control"  placeholder="Name">
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>

                         <div class="form-group">
                            <select name="country_id" class="custom-select" required>
                              <option value="">Choose a Country</option>
                              <?php echo $countries_to_show; ?>
                            </select>
                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                          </div>


                        <!-- <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
                            <label class="custom-control-label" for="customControlValidation1">I agree to my personal data being stored and used for distribution of the Viewpointb newsletter.</label>

                            <div class="invalid-feedback">Example invalid feedback text</div>
                        </div> -->


                    <div class="form-group">
                            <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
                            <label class="custom-control-label" for="customControlValidation1">I agree to ViewPointB <a href="<?php echo base_url(); ?>Privacy_policy">Privacy Policy</a></label>

                            <div class="invalid-feedback">Example invalid feedback text</div>
                        </div>
                    </div>



                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <!-- <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                          </div> -->
                          <!-- <button name="submit" type="submit" class="btn btn-primary">Submit</button> -->
                          <input  name="submit" type="submit" class="btn btn-primary" value="Submit">
                     <?php echo form_close(); ?>
                   </div>
                   <div class="col-md-4"></div>
               </div> 
            </div>
        </section>

       

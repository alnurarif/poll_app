<!-- menu section end -->

        <?php $this->load->view('template/common_include/banner');?>
        

        <section id="contat_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h2>Got a Question or feedback ?</h2>

                        <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>

  <div class="form-group">
    <select class="form-control">
      <option>Company</option>
      <option>An User</option>
      <option>A Job Applicant</option>
      <option>Media</option>
      <option>Prospective Client</option>
    </select>
  </div>

  <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    I’d like to receive more information via email
  </label>
</div>



  <!-- <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
     I’d be happy to get a call from one of your experts
  </label>
</div> -->


<div class="form-group">
    <textarea>Comment Here .....</textarea>
</div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
                    </div>
                    <div class="col-md-7">
                        <div class="contact_right">
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.048827592341!2d101.61020931501518!3d3.0816423544226876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4d3d76250b1b%3A0x6b1f70f884aca2f3!2sNetfix%20IT%20Solution!5e0!3m2!1sen!2sbd!4v1567259547535!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>


                            <div class="address">
                                <h3>Address</h3>
                                <p>your Adders Here ....</p>
                            </div>
                            <div class="contact">
                                <h3>Contact</h3>
                                <p>Your Conysvy</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $this->load->view('template/common_include/footer_menu_nav'); ?>
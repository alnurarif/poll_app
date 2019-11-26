<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $this->config->item('app_name'); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/dashboard/img/favicon.ico">
        <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/meanmenu.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/slick.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/responsive.css">
    
    <!-- Mandatori JS for initialization -->
        <script src="<?php echo base_url(); ?>assets/dashboard/js/vendor/jquery-1.12.4.min.js"></script>
        
        <base data-base="<?php echo base_url(); ?>"></base>
    </head>
    <body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    
    <?php
    $this->load->view('template/include/header');
    if (isset($main_content)) {
        echo $main_content;
    }
    ?> 

    




  <!-- JS here -->
    
    <script src="<?php echo base_url(); ?>assets/dashboard/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/one-page-nav-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/slick.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.meanmenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/ajax-form.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.scrollUp.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/plugins.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/js/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
    <script>
      $(document).ready(function(){
        $("#question").on('keyup',function(){
          var question = $(this).val();
          question = question.toLowerCase().replace(/ /g,"-");
          console.log('arif')
          $('#poll_id').val(question);
        });

      });
    </script>
    </body>
</html>




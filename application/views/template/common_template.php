<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $this->config->item('app_name'); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/meanmenu.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
        
        <script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.12.4.min.js"></script>
        
        <base data-base="<?php echo base_url(); ?>"></base>
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <?php
        $this->load->view('template/common_include/header_nav');
        if (isset($main_content)) {
            echo $main_content;
        }
        
        $this->load->view('template/common_include/footer');
        ?>





		<!-- JS here -->
        
        <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/isotope.pkgd.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/one-page-nav-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.meanmenu.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/ajax-form.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
    </body>
</html>

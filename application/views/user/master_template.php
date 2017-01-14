<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="en-US">
<!--<![endif]--><head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Exclusive Unlock:: <?php echo $title; ?></title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!--Google Font-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" media="screen">
</head>

<body class="index-page">
<header>
<div class="container">
<div class="row">
<div class="col-lg-12">
<h1 class="home-logo"><a href="<?php echo site_url(); ?>" class="logo"></a></h1>
</div>
</div>
</div>

</header>

<div class="container">
  <div class="home-login">
    <div class="home-login-form">
<?php $this->load->view($master_template); ?>
      <div class="nav-bottom">
        <ul>
          <?php if($this->uri->segment(1) == "login"): ?>
          <li><a href="<?php echo site_url('forgot_password'); ?>">Forgot Password</a></li>
          <?php else: ?>
          <li><a href="<?php echo site_url('login'); ?>" >Login</a></li>
          <?php endif; ?>
          <li><a href="<?php echo site_url('register'); ?>">Register Now</a></li>
          <li><a href="#" data-target=".bs-contact-modal-lg" data-toggle="modal">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<footer class="home-footer">

</footer>

<div aria-hidden="false" aria-labelledby="myLargeModalLabel" role="dialog" tabindex="-1" class="modal fade bs-contact-modal-lg in" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 id="myLargeModalLabel" class="modal-title">Contact Us</h4>
        </div>
        <div class="modal-body">
          <p>Exclusive Unlock Pvt Ltd.</p>
          <p>Email: info@exclusiveunlock.co.uk</p>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
</body>
</html>

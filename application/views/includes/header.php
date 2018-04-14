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
	<title><?php echo $Title; ?></title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!--Google Font-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/demo_table.css" type="text/css" media="screen">
    
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- Styles -->

</head>

<body>
<header>
<div class="welcome-bar">
<div class="container">
<div class="row">
<div class="col-lg-6">
 <ul>
 <li class="name">Welcome Back,<span><?php echo $this->session->userdata('MemberFirstName')
." ".$this->session->userdata("MemberLastName"); ?></span></li>
 <li>Balance : <?php echo $credit[0]['credit'] ?></li>
 <li><a href="<?php echo site_url('member/dashboard/addfund'); ?>">+Add Fund</a></li>
 </ul>
</div>
<div class="col-lg-6">
<div class="pull-right">

</div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-lg-3">

<h1 class="home-logo"><a href="#" class="logo"></a></h1>


</div>
<div class="col-lg-9">
	<a href="<?php echo site_url('user/logout') ?>" class="btn btn-danger pull-right" >Logout</a>
</div>
</div>
</div>
</header>
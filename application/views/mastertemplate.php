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
	<title>Exclusiveunlock:: <?php echo $Title; ?></title>
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />

    
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
 <li class="name">Welcome Back, <span><?php echo $this->session->userdata('MemberFirstName') ." ". $this->session->userdata("MemberLastName"); ?></span></li>
 <li>Balance : <?php echo $credit[0]['credit'] ?> Credits</li>
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

<h1 class="home-logo"><a href="<?php echo site_url(); ?>" class="logo"></a></h1>

</div>
<div class="col-lg-9">
	<a href="<?php echo site_url('logout') ?>" class="btn btn-danger pull-right" >Logout</a>
</div>
</div>
</div>
</header>
<div class="container">
    <div role="navigation" class="navbar navbar-inverse navbar-static-top">
        <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            </div>
        <div class="navbar-collapse collapse ">
            <ul class="nav navbar-nav">
            <li <?php echo($this->uri->uri_string()=='member/dashboard'?'class="active"':''); ?>><a href="<?php echo site_url('member/dashboard'); ?>">Home</a></li>
            <li <?php echo($this->uri->uri_string(2)=='member/imeirequest'?'class="active"':''); ?>><a href="<?php echo site_url('member/imeirequest'); ?>">IMEI Request</a></li>
            <li <?php echo($this->uri->uri_string(2)=='member/fileservices'?'class="active"':''); ?>><a href="<?php echo site_url('member/fileservices'); ?>">File Request</a></li>
            <li <?php echo($this->uri->uri_string(2)=='member/imeirequest/history'?'class="active"':''); ?>><a href="<?php echo site_url('member/imeirequest/history'); ?>">IMEI History</a></li>            
            <?php /*<li <?php echo($this->uri->uri_string(2)=='member/imeirequest/verify'?'class="active"':''); ?>><a href="<?php echo site_url('member/imeirequest/verify'); ?>">Verify IMEI Request</a></li>*/ ?>
            <li <?php echo($this->uri->uri_string(2)=='member/fileservices/history'?'class="active"':''); ?>><a href="<?php echo site_url('member/fileservices/history'); ?>">File History</a></li>
            <li <?php echo($this->uri->uri_string(2)=='member/dashboard/profile'?'class="active"':''); ?>><a href="<?php echo site_url('member/dashboard/profile'); ?>">My Account</a></li>
            </ul>
        </div>
        </div>
    </div>    
<?php $this->load->view($template); ?>
</div>
<footer class="home-footer">

</footer>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.cookie.js'></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
<script src="<?php echo base_url(); ?>js/jquery.knob.js"></script>
<script type="text/javascript" charset="utf-8">
var asInitVals = new Array();
    
$(document).ready(function() {
    var oTable = $('#example2').dataTable( {
        "oLanguage": {
            "sSearch": "Search all columns:"
        }
    } );
    
    $("tfoot input").keyup( function () {
        /* Filter on the column (the index) of this element */
        oTable.fnFilter( this.value, $("tfoot input").index(this) );
    } );
    
    
    
    /*
        * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
        * the footer
        */
    $("tfoot input").each( function (i) {
        asInitVals[i] = this.value;
    } );
    
    $("tfoot input").focus( function () {
        if ( this.className == "search_init" )
        {
            this.className = "";
            this.value = "";
        }
    } );
    
    $("tfoot input").blur( function (i) {
        if ( this.value == "" )
        {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    } );
    
    
} );
$(document).ready(function() {
    var oTable = $('#example').dataTable( {
        "oLanguage": {
            "sSearch": "Search all columns:"
        }
    } );
    
    $("tfoot input").keyup( function () {
        /* Filter on the column (the index) of this element */
        oTable.fnFilter( this.value, $("tfoot input").index(this) );
    } );
    
    
    
    /*
        * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
        * the footer
        */
    $("tfoot input").each( function (i) {
        asInitVals[i] = this.value;
    } );
    
    $("tfoot input").focus( function () {
        if ( this.className == "search_init" )
        {
            this.className = "";
            this.value = "";
        }
    } );
    
    $("tfoot input").blur( function (i) {
        if ( this.value == "" )
        {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    } );
    
    
} );
    
    
</script>
</body>       
</html>
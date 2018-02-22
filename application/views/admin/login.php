<!DOCTYPE html>
<html lang="en">
<head>        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    
    <title>Login - Admin Panel</title>

    <?php /* <link rel="icon" type="image/ico" href="<?php echo $this->config->item('assets_url');?>img/favicon.ico"/> */?>
    
    <link href="<?php echo $this->config->item('assets_url');?>css/stylesheets.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 8]>
        <link href="<?php echo $this->config->item('assets_url');?>css/ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->    
    <link rel='stylesheet' type='text/css' href='<?php echo $this->config->item('assets_url');?>css/fullcalendar.print.css' media='print' />
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery-1.9.1.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery-ui-1.10.1.custom.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery-migrate-1.1.1.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery.mousewheel.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/cookie/jquery.cookies.2.2.0.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/bootstrap.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/charts/excanvas.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/charts/jquery.flot.js'></script>    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/charts/jquery.flot.stack.js'></script>    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/charts/jquery.flot.pie.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/charts/jquery.flot.resize.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/sparklines/jquery.sparkline.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/fullcalendar/fullcalendar.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/select2/select2.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/uniform/uniform.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/maskedinput/jquery.maskedinput-1.3.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/validation/languages/jquery.validationEngine-en.js' charset='utf-8'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/validation/jquery.validationEngine.js' charset='utf-8'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/animatedprogressbar/animated_progressbar.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/qtip/jquery.qtip-1.0.0-rc3.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/cleditor/jquery.cleditor.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/jquery.dataTables.min.js'></script>    
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/pnotify/jquery.pnotify.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/ibutton/jquery.ibutton.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/cookies.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/actions.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/charts.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins.js'></script>
    
</head>
<body>
    <div class="loginBlock" id="login" style="display: block;">
        <h1>Welcome! Please Sign In</h1>
        <div class="dr"><span></span></div>
        <div class="loginForm">
            <?php $this->load->view('admin/includes/message'); ?>
        	<?php echo form_open('admin/session/login', array('class' => 'form-horizontal')); ?>
            	<input type="hidden" name="return_url" value="<?php echo $this->input->get('return_url') ?>" />
                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"><span class="icon-envelope"></span></span>
                        <input type="text" name="Email" id="Email" placeholder="Email" value="<?php echo set_value('Email') ?>" class="validate[required]"/>
                    </div>                
                </div>
                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"><span class="icon-lock"></span></span>
                        <input type="password" name="Password" id="Password" placeholder="Password" class="validate[required]"/>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span8">
                        <div class="control-group" style="margin-top: 5px;">
                            <!--<label class="checkbox"><input type="checkbox"> Remember me</label>-->                                                
                        </div>                    
                    </div>
                    <div class="span4">
                        <button type="submit" class="btn btn-block">Sign in</button>       
                    </div>
                </div>
            <?php echo form_close(); ?>  
            <div class="dr"><span></span></div>
            <div class="controls">
                <div class="row-fluid">
                    <div class="span6">
                        <button class="btn btn-link btn-block" onClick="loginBlock('#forgot');">Forgot your password?</button>
                    </div>
                    <div class="span2"></div>
                    <div class="span4"></div>
                </div>
            </div>
        </div>
    </div>    
    
    <div class="loginBlock" id="forgot">
        <h1>Forgot your password?</h1>
        <div class="dr"><span></span></div>
        <div class="loginForm">            
            <?php echo form_open('admin/session/forgot_password', array('class' => 'form-horizontal')) ?>
                <p>This form help you return your password. Please, enter your password, and send request</p>
                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"><span class="icon-envelope"></span></span>
                        <input type="text" placeholder="Your email" name="Email" value="<?php echo set_value('Email') ?>"/>
                    </div>                
                </div>                
                <div class="row-fluid">
                    <div class="span8"></div>
                    <div class="span4">
                        <button type="submit" class="btn btn-block">Send request</button>       
                    </div>
                </div>
            <?php echo form_close(); ?>  
            <div class="dr"><span></span></div>
            <div class="controls">
                <div class="row-fluid">                    
                    <div class="span12">
                        <button class="btn btn-link" onClick="loginBlock('#login');">&laquo; Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>

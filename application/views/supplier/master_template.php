<!DOCTYPE html>
<html lang="en">
<head>        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    
    <title>Unlocknetwork - Admin Panel</title>

    <?php /*<link rel="icon" type="image/ico" href="<?php echo $this->config->item('assets_url');?>img/favicon.ico"/>**/?>
    
    <link href="<?php echo $this->config->item('assets_url');?>css/stylesheets.css" rel="stylesheet" type="text/css" />  
    <!--[if lt IE 8]>
        <link href="<?php echo $this->config->item('assets_url');?>css/ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->            
    <link rel='stylesheet' type='text/css' href='<?php echo $this->config->item('assets_url');?>css/fullcalendar.print.css' media='print' />
    
    <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery-1.9.1.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery-ui-1.10.1.custom.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery-migrate-1.1.1.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/jquery/jquery.mousewheel.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/json2.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/jquery.cookie.js'></script>
    
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
    
    <style type="text/css" title="currentStyle">
		@import "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/css/TableTools.css";
	</style>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/jquery.dataTables.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/jquery.dataTables.columnFilter.js'></script>
    <script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/js/ZeroClipboard.js" charset="utf-8" ></script>
	<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/js/TableTools.js" charset="utf-8" ></script>    
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/pnotify/jquery.pnotify.min.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/ibutton/jquery.ibutton.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.gears.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.silverlight.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.flash.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.browserplus.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.html4.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.html5.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js'></script>    
    
    <script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>js/plugins/elfinder/elfinder.min.js"></script>
    
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/cookies.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/actions.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/charts.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/plugins.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/settings.js'></script>
    <script type='text/javascript' src='<?php echo $this->config->item('assets_url');?>js/jquery.nestable.js'></script>    
    
</head>
<body>
    <div class="wrapper"> 
            
        <div class="header">
            <!--<a class="logo" href="<?php echo site_url(); ?>"><img src="<?php echo $this->config->item('assets_url');?>img/fsd-solutions-logo.png" style="height: 36px;" alt="FSD Solutions -  Admin Panel" title="FSD Solutions -  Admin Panel"/></a>-->
            <ul class="header_menu">
                <li class="list_icon"><a href="#">&nbsp;</a></li>
                <li class="settings_icon">
                    <a href="#" class="link_themeSettings">&nbsp;</a>
                    
                    <div id="themeSettings" class="popup">
                        <div class="head clearfix">
                            <div class="arrow"></div>
                            <span class="isw-settings"></span>
                            <span class="name">Theme settings</span>
                        </div>
                        <div class="body settings">
                            <div class="row-fluid">
                                <div class="span3"><strong>Style:</strong></div>
                                <div class="span9">
                                    <a class="styleExample tip active" title="Default style" data-style="">&nbsp;</a>                                    
                                    <a class="styleExample silver tip" title="Silver style" data-style="silver">&nbsp;</a>
                                    <a class="styleExample dark tip" title="Dark style" data-style="dark">&nbsp;</a>
                                    <a class="styleExample marble tip" title="Marble style" data-style="marble">&nbsp;</a>
                                    <a class="styleExample red tip" title="Red style" data-style="red">&nbsp;</a>                                    
                                    <a class="styleExample green tip" title="Green style" data-style="green">&nbsp;</a>
                                    <a class="styleExample lime tip" title="Lime style" data-style="lime">&nbsp;</a>
                                    <a class="styleExample purple tip" title="Purple style" data-style="purple">&nbsp;</a>                                    
                                </div>
                            </div>                            
                            <div class="row-fluid">
                                <div class="span3"><strong>Background:</strong></div>
                                <div class="span9">
                                    <a class="bgExample tip active" title="Default" data-style="">&nbsp;</a>
                                    <a class="bgExample bgCube tip" title="Cubes" data-style="cube">&nbsp;</a>
                                    <a class="bgExample bghLine tip" title="Horizontal line" data-style="hline">&nbsp;</a>
                                    <a class="bgExample bgvLine tip" title="Vertical line" data-style="vline">&nbsp;</a>
                                    <a class="bgExample bgDots tip" title="Dots" data-style="dots">&nbsp;</a>
                                    <a class="bgExample bgCrosshatch tip" title="Crosshatch" data-style="crosshatch">&nbsp;</a>
                                    <a class="bgExample bgbCrosshatch tip" title="Big crosshatch" data-style="bcrosshatch">&nbsp;</a>
                                    <a class="bgExample bgGrid tip" title="Grid" data-style="grid">&nbsp;</a>
                                </div>
                            </div>                            
                            <div class="row-fluid">
                                <div class="span3"><strong>Fixed layout:</strong></div>
                                <div class="span9">
                                    <input type="checkbox" name="settings_fixed" value="1"/>
                                </div> 
                            </div>
                            <div class="row-fluid">
                                <div class="span3"><strong>Hide menu:</strong></div>
                                <div class="span9">
                                    <input type="checkbox" name="settings_menu" value="1"/>
                                </div>                                           
                            </div>                            
                        </div>
                        <div class="footer">                            
                            <button class="btn link_themeSettings" type="button">Close</button>
                        </div>
                    </div>                    
                    
                </li>
            </ul>    
        </div>

        <div class="menu">                

            <div class="breadLine">            
                <div class="arrow"></div>
                <div class="adminControl active">
                    Hi, <?php echo $this->session->userdata('full_name'); ?>
                </div>
            </div>

            <div class="admin">
                <div class="image">
                    <img src="<?php echo $this->config->item('assets_url');?>img/users/administrator-icon.png" width="50px" class="img-polaroid"/>                
                </div>
                <ul class="control">
                    <li><span class="icon-cog"></span> <a href="<?php echo site_url('admin/configuration'); ?>">Settings</a></li>
                    <li><span class="icon-share-alt"></span> <a href="<?php echo site_url('admin/session/logout'); ?>">Logout</a></li>
                </ul>
                <div class="info">
                    <span>Welcome back!</span>
                </div>
            </div>

            <ul class="navigation">            
                <li class="active">
                    <a href="<?php echo site_url("admin"); ?>">
                        <span class="isw-grid"></span><span class="text">Dashboard</span>
                    </a>
                </li>
                <?php /*<li class="openable">
                    <a href="#">
                        <span class="isw-documents"></span><span class="text">CMS</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo site_url("admin/page"); ?>">
                                <span class="icon-list-alt"></span><span class="text">Pages</span>
                            </a>                  
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin/menu"); ?>">
                                <span class="icon-th-list"></span><span class="text">Navigation Menus</span>
                            </a>                  
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin/testimonial"); ?>">
                                <span class="icon-certificate"></span><span class="text">Testimonials</span>
                            </a>                  
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin/autoresponder"); ?>">
                                <span class="icon-envelope"></span><span class="text">Autoresponders</span>
                            </a>                  
                        </li>                                                                        
                    </ul>                
                </li>
                */?>
                
                 <li class="openable">
                    <a href="#">
                        <span class="isw-users"></span><span class="text">Api Manager</span>
                    </a>
                    <ul>
                    	 
                		<li>
                            <a href="<?php echo site_url("admin/apimanager"); ?>">
                                <span class="icon-list-alt"></span><span class="text">Api Manager</span>
                            </a>                  
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin/brand"); ?>">
                                <span class="icon-list-alt"></span><span class="text">Brand</span>
                            </a>                  
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin/servicemodel"); ?>">
                                <span class="icon-list-alt"></span><span class="text">Service Model</span>
                            </a>                  
                        </li>
                                                                                                
                    </ul>                
                </li>
            	            
                <li class="openable">
                    <a href="#">
                        <span class="isw-calc"></span><span class="text">IMEI Service</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo site_url("admin/network"); ?>">
                                <span class="icon-user"></span><span class="text">Networks</span>
                            </a>                  
                        </li>                    	
                        <li>
                            <a href="<?php echo site_url("admin/method"); ?>">
                                <span class="icon-user"></span><span class="text">Methods</span>
                            </a>                  
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin/imeiorder"); ?>">
                                <span class="icon-user"></span><span class="text">IMEI Orders</span>
                            </a>                  
                        </li>                                              
                    </ul>                
            	</li>                
                <li class="openable">
                    <a href="#">
                        <span class="isw-calc"></span><span class="text">Members & Groups</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo site_url("admin/group"); ?>">
                                <span class="icon-user"></span><span class="text">Groups</span>
                            </a>                  
                        </li>                    	
                        <li>
                            <a href="<?php echo site_url("admin/member"); ?>">
                                <span class="icon-user"></span><span class="text">Members</span>
                            </a>                  
                        </li>                                              
                    </ul>                
            	</li>
            	<li class="openable">
                    <a href="#">
                        <span class="isw-calc"></span><span class="text">Files</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo site_url("admin/fileservices"); ?>">
                                <span class="icon-user"></span><span class="text">File Services</span>
                            </a>                  
                        </li>                    	
                        <li>
                            <a href="<?php echo site_url("admin/method"); ?>">
                                <span class="icon-user"></span><span class="text">Methods</span>
                            </a>                  
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin/fileorder"); ?>">
                                <span class="icon-user"></span><span class="text">File Service Orders</span>
                            </a>                  
                        </li>                                              
                    </ul>                
            	</li>
                <li>
                    <a href="<?php echo site_url("admin/supplier"); ?>">
                        <span class="isw-users"></span><span class="text">Suppliers</span>                 
                    </a>
                </li>                
                <li>
                    <a href="<?php echo site_url("admin/employee"); ?>">
                        <span class="isw-users"></span><span class="text">Employees Logins</span>                 
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url("admin/credit"); ?>">
                        <span class="isw-text_document"></span><span class="text">Credit</span>
                    </a>               
            	</li>
                <li>
                    <a href="<?php echo site_url("admin/autoresponder"); ?>">
                        <span class="isw-text_document"></span><span class="text">Autoresponders</span>
                    </a>               
            	</li>                
                <li>
                    <a href="<?php echo site_url("admin/filemanager"); ?>">
                        <span class="isw-up_circle"></span><span class="text">File Manager</span>                 
                    </a>
                </li>                                                                       
            </ul>
            <div class="dr"><span></span></div>

            <div class="widget-fluid">
                <div id="menuDatepicker"></div>
            </div>          
			
        </div>

        <div class="content">


            <div class="breadLine">
				<?php /*
                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Dashboard</li>
                </ul>
				*/ ?>
                <ul class="buttons">
					<li><a href="<?php echo site_url('admin/session/logout'); ?>"><span class="icon-share-alt"></span> Logout</a></li>
					<li><a href="<?php echo site_url('admin/configuration'); ?>"><span class="icon-cog"></span> Settings</a></li>                                    
                    <li>
                        <a href="#" class="link_bcPopupSearch"><span class="icon-search"></span><span class="text">Search</span></a>

                        <div id="bcPopupSearch" class="popup">
                            <div class="head clearfix">
                                <div class="arrow"></div>
                                <span class="isw-zoom"></span>
                                <span class="name">Search</span>
                            </div>
                            <div class="body search">
                                <input type="text" placeholder="Some text for search..." name="search"/>
                            </div>
                            <div class="footer">
                                <button class="btn" type="button">Search</button>
                                <button class="btn btn-danger link_bcPopupSearch" type="button">Close</button>
                            </div>
                        </div>                
                    </li>
                </ul>

            </div>

            <?php $this->load->view($template); ?>

        </div>   
    </div>
</body>
</html>

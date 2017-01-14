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
                <li class="active"><a href="<?php echo site_url('member/dashboard'); ?>">Home</a></li>
                <li>
                	<a data-toggle="dropdown" class="dropdown-toggle" href="#">IMEI Service <b class="caret"></b></a>
	                  <ul class="dropdown-menu">
	                  	<li><a href="<?php echo site_url('member/imeirequest/history'); ?>">History</a></li>
	                    <li><a href="<?php echo site_url('member/imeirequest'); ?>">IMEI Request</a></li>
	                    <li><a href="<?php echo site_url('member/imeirequest/verify'); ?>">Verify IMEI Request</a></li>
	                  </ul>
                </li>
                 <li>
                	<a data-toggle="dropdown" class="dropdown-toggle" href="#">File Service<b class="caret"></b></a>
	                  
	                  <ul class="dropdown-menu">
	                    <li><a href="<?php echo site_url('member/fileservices/history'); ?>">History</a></li>
	                    <li><a href="<?php echo site_url('member/fileservices'); ?>">File Service Request</a></li>
	                  </ul>
                </li>
                <li><a href="#contact">Server Service</a></li>
                <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">Client Area <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
                 <li><a href="#contact">Order History</a></li>
                 
                   <li><a href="#contact">Place Order</a></li>
                    <li><a href="<?php echo site_url('member/dashboard/profile'); ?>">My Account</a></li>
              </ul>
            </div>
          </div>
        </div>
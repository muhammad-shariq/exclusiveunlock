<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Supplier Add</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/supplier/insert",array('id'=>"supplier-validate")); ?>
                            <div class="row-form clearfix">
                                <div class="span3">First Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"FirstName",'id'=>"FirstName", 'value'=>set_value('FirstName', ''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Last Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"LastName",'id'=>"LastName", 'value'=>set_value('LastName', ''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Mobile:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Mobile",'id'=>"Mobile", 'value'=>set_value('Mobile', ''))); ?></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Email:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Email",'id'=>"Email", 'value'=>set_value('Email', ''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Password:</div>
                                <div class="span9"><?php echo form_password(array('name'=>"Password",'id'=>"Password", 'value'=>set_value('Password', ''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Status:</div>
                                <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn", 'id'=>"Status", 'name'=>"Status", 'checked'=>"checked", 'value'=>"Enabled"));?></div>
                            </div>                            
                            <div class="footer tar">
                                <button class="btn">Submit</button>
                            </div>
                        <?php echo form_close(); ?>
                        </div>

                    </div>

                </div>

                <div class="dr"><span></span></div>
            </div>
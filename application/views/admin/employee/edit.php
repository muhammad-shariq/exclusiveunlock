<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Employee Update</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/employee/update",array('id'=>"menu-validate")); ?>
						<input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />                            
                            <div class="row-form clearfix">
                                <div class="span3">First Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"FirstName",'id'=>"FirstName", 'value'=>set_value('FirstName', $data[0]['FirstName']))); ?></div>
                            </div>
							
                            <div class="row-form clearfix">
                                <div class="span3">Last Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"LastName",'id'=>"LastName", 'value'=>set_value('LastName', $data[0]['LastName']))); ?></div>
                            </div>
                            
							<div class="row-form clearfix">
                                <div class="span3">Email:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Email",'id'=>"Email", 'disabled'=>'disabled', 'value'=>set_value('Email', $data[0]['Email']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Password:</div>
                                <div class="span9"><?php echo form_password(array('name'=>"Password",'id'=>"Password", 'value'=>'')); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Status:</div>
                                <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn", 'id'=>"Status", 'name'=>"Status", 'checked'=>($data[0]['Status']=='Enabled'?TRUE:FALSE), 'value'=>"Enabled"));?></div>
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
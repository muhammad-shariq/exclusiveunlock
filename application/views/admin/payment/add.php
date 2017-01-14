<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Payment Add</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/payment/insert",array('id'=>"payment-validate")); ?>                            
                            <div class="row-form clearfix">
                                <div class="span3">Type:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Type",'id'=>"Type", 'value'=>set_value('Type',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">User Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"UserName",'id'=>"UserName", 'value'=>set_value('UserName',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Password:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Password",'id'=>"Password", 'value'=>set_value('Password',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Signature:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Signature",'id'=>"Signature", 'value'=>set_value('Signature',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Percent:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"percent",'id'=>"percent", 'value'=>set_value('percent',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Currency:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Currency",'id'=>"Currency", 'value'=>set_value('Currency',''))); ?></div>
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
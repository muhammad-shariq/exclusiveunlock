<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Payment Update</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/payment/update",array('id'=>"payment-validate")); ?>
						<input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />                            
                            <div class="row-form clearfix">
                                <div class="span3">Type:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Type",'id'=>"Type", 'value'=>set_value('Type', $data[0]['Type']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">User Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"UserName",'id'=>"UserName", 'value'=>set_value('UserName', $data[0]['UserName']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Password:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Password",'id'=>"Password", 'value'=>set_value('Password', $data[0]['Password']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Signature:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Signature",'id'=>"Signature", 'value'=>set_value('Signature', $data[0]['Signature']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Percent:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"percent",'id'=>"percent", 'value'=>set_value('percent', $data[0]['percent']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Currency:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Currency",'id'=>"Currency", 'value'=>set_value('Currency', $data[0]['Currency']))); ?></div>
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
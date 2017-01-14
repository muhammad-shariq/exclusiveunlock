		<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Configuration Update</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/configuration/update",array('id'=>"configuration-validate")); ?>						                            
                            <div class="row-form clearfix">
                                <div class="span3">Application Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"ApplicationName",'id'=>"ApplicationName", 'value'=>set_value('ApplicationName', $data[0]['ApplicationName']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Application URL:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"ApplicationURL",'id'=>"ApplicationURL", 'value'=>set_value('ApplicationURL', $data[0]['ApplicationURL']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Contact Us Email:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Email",'id'=>"Email", 'value'=>set_value('Email', $data[0]['Email']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Facebook:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"FaceBook",'id'=>"FaceBook", 'value'=>set_value('FaceBook', $data[0]['FaceBook']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Twitter:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Twitter",'id'=>"Twitter", 'value'=>set_value('Twitter', $data[0]['Twitter']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Linked In:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"LinkedIn",'id'=>"LinkedIn", 'value'=>set_value('LinkedIn', $data[0]['LinkedIn']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Google Plus:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"GooglePlus",'id'=>"GooglePlus", 'value'=>set_value('Title', $data[0]['GooglePlus']))); ?></div>
                            </div>                                                                                                                                                                        
                            <div class="row-form clearfix">
                                <div class="span3">Skype:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Skype",'id'=>"Skype", 'value'=>set_value('Skype', $data[0]['Skype']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Call Us:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"CallUs",'id'=>"CallUs", 'value'=>set_value('CallUs', $data[0]['CallUs']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Currency Code:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"CurrencyCode",'id'=>"CurrencyCode", 'value'=>set_value('CurrencyCode', $data[0]['CurrencyCode']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Analytics Code:</div>
                                <div class="span9"><?php echo form_textarea(array('name'=>"AnalyticsCode",'id'=>"AnalyticsCode", 'value'=>set_value('AnalyticsCode', $data[0]['AnalyticsCode']))); ?></div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">Status:</div>
                                <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn", 'id'=>"Status", 'name'=>"Status", 'checked'=>($data[0]['Status']=='Online'?TRUE:FALSE), 'value'=>"Enabled"));?></div>
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
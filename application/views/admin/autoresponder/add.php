<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Add Email Template</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/autoresponder/insert",array('id'=>"autoresponder-validate")); ?>
                            <div class="row-form clearfix">
                                <div class="span3">Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title', ''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">From Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"FromName",'id'=>"FromName", 'value'=>set_value('FromName', ''))); ?></div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">From Email:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"FromEmail",'id'=>"FromEmail", 'value'=>set_value('FromEmail', ''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Subject:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Subject",'id'=>"Subject", 'value'=>set_value('Subject', ''))); ?></div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">To Email:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"ToEmail",'id'=>"ToEmail", 'value'=>set_value('ToEmail', ''))); ?></div>
                            </div>                                                         
                            <div class="block-fluid" id="wysiwyg_container">                            	
								<?php echo form_textarea(array('id'=>"Message",'name'=>"Message",  'style' =>"height: 500px;",'value'=>html_entity_decode(set_value('Message', ''))));?>
								<?php echo display_ckeditor($ckeditor); ?>	                            	
	                        </div>                       
                            <div class="row-form clearfix">
                                <div class="span3">Status:</div>
                                <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn",'id'=>"Status",'name'=>"Status",'checked'=>'checked','value'=>"Enabled"));?></div>
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
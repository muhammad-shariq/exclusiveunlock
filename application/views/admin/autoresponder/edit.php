<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Edit Email Template</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/autoresponder/update",array('id'=>"autoresponder-validate")); ?>
						<input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
                            <div class="row-form clearfix">
                                <div class="span3">Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title',$data[0]['Title']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">From Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"FromName",'id'=>"FromName", 'value'=>set_value('FromName',$data[0]['FromName']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">From Email:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"FromEmail",'id'=>"FromEmail", 'value'=>set_value('FromEmail',$data[0]['FromEmail']))); ?></div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">To Email:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"ToEmail",'id'=>"ToEmail", 'value'=>set_value('ToEmail',$data[0]['ToEmail']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Subject:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Subject",'id'=>"Subject", 'value'=>set_value('Subject', $data[0]['Subject']))); ?></div>
                            </div>                                                                                     
                            <div class="block-fluid" id="wysiwyg_container">                            	
								<?php echo form_textarea(array('id'=>"Message",'name'=>"Message",  'style' =>"height: 500px;",'value'=>html_entity_decode(set_value('Message',$data[0]['Message']))));?>
								<?php echo display_ckeditor($ckeditor); ?>	                            	
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
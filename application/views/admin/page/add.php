<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Page Add</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/page/insert",array('id'=>"page-validate")); ?>
                            <div class="row-form clearfix">
                                <div class="span3">Page Name:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"PageName",'id'=>"PageName", 'value'=>set_value('PageName',''))); ?></div>
                            </div> 
                            <div class="row-form clearfix">
                                <div class="span3">Header Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"HeadTitle",'id'=>"HeadTitle", 'value'=>set_value('HeadTitle',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title',''))); ?></div>
                            </div>
                            <div class="block-fluid" id="wysiwyg_container">
								<?php echo form_textarea(array('id'=>"Content",'name'=>"Content",  'style' =>"height: 500px;",'value'=>html_entity_decode(set_value('Content',''))));?>
								<?php echo display_ckeditor($ckeditor); ?>	                            	
	                        </div>
                            <div class="row-form clearfix">
                                <div class="span3">Meta Keyword:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"MetaKeyword",'id'=>"MetaKeyword", 'value'=>set_value('MetaKeyword',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Meta Description:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"MetaDescription",'id'=>"MetaDescription", 'value'=>set_value('MetaDescription',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Banner Image:</div>
                                <div class="span9"><?php echo form_upload(array('name'=>'BannerFile')); ?></div>
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
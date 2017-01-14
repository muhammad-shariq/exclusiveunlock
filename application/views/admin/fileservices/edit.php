			<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>File Service Update</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/fileservices/update",array('id'=>"fileservices-validate")); ?>
						<input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />                            
                            <div class="row-form clearfix">
                                <div class="span3">API:</div>
                                <div class="span9"><?php echo  form_dropdown('ApiID', $api_list, set_value('ApiID', $data[0]['ApiID']), 'id="ApiID"'); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Tool ID:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"ToolID",'id'=>"ToolID", 'value'=>set_value('ToolID', $data[0]['ToolID']))); ?></div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title', $data[0]['Title']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Delivery Time:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"DeliveryTime",'id'=>"DeliveryTime", 'value'=>set_value('DeliveryTime', $data[0]['DeliveryTime']))); ?></div>
                            </div> 
                            <div class="row-form clearfix">
                                <div class="span3">Description:</div>
                                <div class="span9"><?php echo form_textarea(array('name'=>"Description",'id'=>"Description", 'value'=>set_value('Description', $data[0]['Description']))); ?></div>
                            </div>                                                       
                            <div class="row-form clearfix">
                                <div class="span3">Allow Extensions:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"AllowExtension",'id'=>"AllowExtension", 'value'=>set_value('AllowExtension', $data[0]['AllowExtension']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Price:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Price",'id'=>"Price", 'value'=>set_value('Price', $data[0]['Price']))); ?></div>
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
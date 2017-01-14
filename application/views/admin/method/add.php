<div class="workplace">
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>IMEI Method</h1>
                        </div>
                        <div class="block-fluid">                        
							
                    		<?php echo form_open_multipart("admin/method/insert",array('id'=>"method-validate")); ?>                            
                           
                            <div class="row-form clearfix">
                                <div class="span3">API:</div>
                                <div class="span9"><?php echo  form_dropdown('ApiID', $api_list, set_value('ApiID', ''), 'id="ApiID"'); ?></div>
                            </div>
                           
                            <div class="row-form clearfix">
                                <div class="span3">Network:</div>
                                <div class="span9">
                                	<select name="NetworkID" id="NetworkID" >
                                	<option>Select Method</option>
                                	<?php 
                                	foreach($network as $val)
                                	{
                                		?>
                                		<option value="<?php echo $val['ID'] ?>" >
                                			<?php echo $val['Title'] ?></option>
                                		<?php
                                	}
                                	?>
                                	</select>
                                </div>
                            </div>
                           
                            <div class="row-form clearfix">
                                <div class="span3">Tool ID:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"ToolID",'id'=>"ToolID", 'value'=>set_value('ToolID', ''))); ?></div>
                            </div>
                           
                            <div class="row-form clearfix">
                                <div class="span3">Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title', ''))); ?></div>
                            </div>
                           
                            <div class="row-form clearfix">
                                <div class="span3">Delivery Time:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"DeliveryTime",'id'=>"DeliveryTime", 'value'=>set_value('DeliveryTime', ''))); ?></div>
                            </div>
                           
                            <div class="row-form clearfix">
                                <div class="span3">Description:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Description",'id'=>"Description", 'value'=>set_value('Description', ''))); ?></div>
                            </div>
                           
                            <div class="row-form clearfix">
                                <div class="span3">Network Required:</div>
                                <div class="span9">
	                                <select name="Network" id="Network" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                             <div class="row-form clearfix">
                                <div class="span3">Mobile Required:</div>
                                <div class="span9">
	                                <select name="Mobile" id="Mobile" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Provider Required:</div>
                                <div class="span9">
	                                <select name="Provider" id="Provider" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">PIN Required:</div>
                                <div class="span9">
	                                <select name="PIN" id="PIN" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">KBH Required:</div>
                                <div class="span9">
	                                <select name="KBH" id="KBH" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">MEP Required:</div>
                                <div class="span9">
	                                <select name="MEP" id="MEP" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">PRD Required:</div>
                                <div class="span9">
	                                <select name="PRD" id="PRD" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Type Required:</div>
                                <div class="span9">
	                                <select name="Type" id="Type" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Locks Required:</div>
                                <div class="span9">
	                                <select name="Locks" id="Locks" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Reference Required:</div>
                                <div class="span9">
	                                <select name="Reference" id="Reference" >
	                                	<option value="0" >NO</option>
	                                	<option value="1" >YES</option>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Price:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Price",'id'=>"Price", 'value'=>set_value('Price', ''))); ?></div>
                            </div>                           
                            <div class="row-form clearfix">
                                <div class="span3">Status:</div>
                                <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn", 'id'=>"Status", 'value'=>"Enabled"));?></div>
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
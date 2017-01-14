			<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>IMEI Methods</h1>
                        </div>
                        <div class="block-fluid">                        
							
                    		<?php echo form_open_multipart("admin/method/update",array('id'=>"method-validate")); ?>
						
							<input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />                            
                            
                            <div class="row-form clearfix">
                                <div class="span3">API:</div>
                                <div class="span9"><?php echo  form_dropdown('ApiID', $api_list, set_value('ApiID', $data[0]['ApiID']), 'id="ApiID"'); ?></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Network:</div>
                                <div class="span9">
                                	<select name="NetworkID" id="NetworkID" >
                                	<option>Select Network</option>
                                	<?php 
                                	foreach($network as $val)
                                	{
                                		?>
                                		<option value="<?php echo $val['ID'] ?>" 
                                			<?php echo ($val['ID']==$data[0]['NetworkID']?
                                			'selected="selected"':''); ?> >
                                			<?php echo $val['Title'] ?></option>
                                		<?php
                                	}
                                	?>
                                	</select>
                                </div>
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
                                <div class="span9"><?php echo form_input(array('name'=>"Description",'id'=>"Description", 'value'=>set_value('Description', $data[0]['Description']))); ?></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Network Required:</div>
                                <div class="span9">
	                                <select name="Network" id="Network" >
	                                	<?php if($data[0]["Network"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Mobile Required:</div>
                                <div class="span9">
	                                <select name="Mobile" id="Mobile" >
	                                	<?php if($data[0]["Mobile"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Provider Required:</div>
                                <div class="span9">
	                                <select name="Provider" id="Provider" >
	                                	<?php if($data[0]["Provider"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">PIN Required:</div>
                                <div class="span9">
	                                <select name="PIN" id="PIN" >
	                                	<?php if($data[0]["PIN"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">KBH Required:</div>
                                <div class="span9">
	                                <select name="KBH" id="KBH" >
	                                	<?php if($data[0]["KBH"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">MEP Required:</div>
                                <div class="span9">
	                                <select name="MEP" id="MEP" >
	                                	<?php if($data[0]["MEP"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">PRD Required:</div>
                                <div class="span9">
	                                <select name="PRD" id="PRD" >
	                                	<?php if($data[0]["PRD"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Type Required:</div>
                                <div class="span9">
	                                <select name="Type" id="Type" >
	                                	<?php if($data[0]["Type"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Locks Required:</div>
                                <div class="span9">
	                                <select name="Locks" id="Locks" >
	                                	<?php if($data[0]["Locks"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Reference Required:</div>
                                <div class="span9">
	                                <select name="Reference" id="Reference" >
	                                	<?php if($data[0]["Reference"]== 1) : ?>
		                                	<option value="0" >NO</option>
		                                	<option selected="selected" value="1" >YES</option>
	                                	<?php else : ?>
	                                		<option selected="selected" value="0" >NO</option>
	                                		<option value="1" >YES</option>
	                                	<?php endif; ?>
	                                </select>
                                </div>
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
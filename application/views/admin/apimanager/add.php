<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>API Add</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/apimanager/insert",array('id'=>"apimanager-validate")); ?>                            
                            <div class="row-form clearfix">
                                <div class="span3">Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Host:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Host",'id'=>"Host", 'value'=>set_value('Host',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Username:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Username",'id'=>"Username", 'value'=>set_value('Username',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Api Key:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"ApiKey",'id'=>"ApiKey", 'value'=>set_value('ApiKey',''))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Api Type:</div>
                                <div class="span9"><?php echo form_dropdown('ApiType', array('' => 'Select Type', 'Imei' => 'IMEI Service', 'File' => 'File Service', 'Server' => 'Server Service'), set_value('ApiType', ''), 'id="ApiType"'); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Api Library:</div>
                                <div class="span9">
                                	<select name="LibraryID" id="LibraryID" >
                                	<option>Select Api</option>
                                	<?php
                                	foreach($library as $key => $val)
									{
										?>
										<option value="<?php echo $val["ID"] ?>" >
											<?php echo $val["Title"]; ?></option>
										<?Php
									}
                                	?>
                                	</select>
                                </div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">Status:</div>
                                <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn", 'id'=>"Status", 'name'=>"Status", 'checked'=>"checked", 'value'=>"Enabled"));?></div>
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
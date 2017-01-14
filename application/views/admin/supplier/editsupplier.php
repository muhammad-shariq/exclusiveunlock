<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Member Method Price Update</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/supplier/suppliermethod",array('id'=>"member-validate")); ?>
						<input type="hidden" name="ID" value="<?php echo $id; ?>" />                            
                            <?php
                            foreach($methods as $val)
							{
								?>
							 <div class="row-form clearfix">
                                <div class="span3"><?php echo $val['Title']; ?>:</div>
                                <div class="span3"><?php echo form_input(array('name'=>"Price[]",'id'=>$val['MethodID'], 'value'=>set_value('Price', $val['Price']))); ?></div>
                                 <div class="span6"><select name="Status[]">
                                 	<?php
                                 	if($val["Status"] == "Enabled")
									{
										?>
										<option selected="selected" >Enabled</option>
										<option>Disabled</option>
										<?php
									}
									else {
										?>
										<option selected="selected" >Disabled</option>
										<option>Enabled</option>
										<?php
									} 
                                 	?>                                 
                                 </select>
                                 </div>
                                <input type="hidden" value="<?php echo $val['MethodID'] ?>" name="MethodID[]" />
                            </div>	
								<?php
								
							}
                           ?>
                                                                                      
                            <div class="footer tar">
                                <button class="btn">Submit</button>
                            </div>
                        <?php echo form_close(); ?>                            
                        </div>

                    </div>

                </div>

                <div class="dr"><span></span></div>
            </div>
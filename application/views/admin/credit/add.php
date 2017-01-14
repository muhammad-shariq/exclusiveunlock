<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Credit Add</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/credit/insert",array('id'=>"credit-validate")); ?>                            
                            <div class="row-form clearfix">
                                <div class="span3">Member:</div>
                                <div class="span9">
                                	<select name="MemberID" >
                                		<option value="">Select Member</option>
                                		<?php foreach($member as $val): ?>
											<option value="<?php echo $val['ID'] ?>" <?php echo set_select('MemberID', $val['ID']); ?>>
												<?php echo $val['FirstName'] ." ". $val["LastName"] ." (". $val["Email"] .")"; ?>
											</option>
										<?php endforeach; ?>
                                	</select>
                                </div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">Amount:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Amount",'id'=>"Amount", 'value'=>set_value('Amount',''))); ?></div>
                            </div>
                             <div class="row-form clearfix">
                                <div class="span3">Description:</div>
                                <div class="span9"><?php echo form_textarea(array('name'=>"Description",'id'=>"Description", 'value'=>set_value('Description', ''))); ?></div>
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
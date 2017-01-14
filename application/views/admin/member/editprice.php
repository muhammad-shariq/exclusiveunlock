<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Member Price Update</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/member/update_price",array('id'=>"member-validate")); ?>
						<input type="hidden" name="MemberID" value="<?php echo $MemberID ?>" />                            
                            
                            
                            <?php 
                            foreach($methods as $key => $val)
							{
								?>
							<div class="row-form clearfix">
                                <div class="span3"><?php echo $val['MethodID']; ?></div>
                                <div class="span9"><?php echo form_input(array('name'=>$val['MethodID'],'id'=>$val['MethodID'], 'value'=>set_value($val['MethodID'], $val['Price']))); ?></div>
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
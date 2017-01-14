<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Member File Method Price Update</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/member/filemembermethod",array('id'=>"member-validate")); ?>
						<input type="hidden" name="ID" value="<?php echo $MemberID ?>" />                            
                            <?php
                            foreach($file_methods as $val)
							{
								?>
							 <div class="row-form clearfix">
                                <div class="span9"><?php echo $val['Title']; ?>:</div>
                                <div class="span3"><?php echo form_input(array('name'=>"Title[]",'id'=>$val['FileServiceID'], 'value'=>set_value('FirstName', $val['Price']))); ?></div>
                                <input type="hidden" value="<?php echo $val['FileServiceID'] ?>" name="FileServiceID[]" />
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
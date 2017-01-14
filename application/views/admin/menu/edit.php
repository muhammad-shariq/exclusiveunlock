<div class="workplace">                
                <div class="row-fluid">

                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Navigation Menu Add</h1>
                        </div>
                        <div class="block-fluid">                        
						<?php echo form_open_multipart("admin/menu/update",array('id'=>"menu-validate")); ?>
						<input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
                            <div class="row-form clearfix">
                                <div class="span3">Menu Position:</div>
                                <div class="span3">
									<select name="MenuID" id="MenuID">
										<option value="0"></option>
								<?php	foreach ($menu_list as $value){			?>											
                                        <option value="<?php echo $value['ID']; ?>" <?php echo($data[0]['MenuID']==$value['ID']?'selected="selected"':''); ?>><?php echo $value['Title']; ?></option>
								<?php	} ?>		
									</select>                                	
								</div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Parent Menu:</div>
                                <div class="span3">
									<select name="ParentID" id="ParentID">
										<option value="0"></option>
								<?php	foreach ($parent_list as $value){			?>				
                                        <option value="<?php echo $value['ID']; ?>" <?php echo($data[0]['ParentID']==$value['ID']?'selected="selected"':''); ?>><?php echo $value['Title']; ?></option>
								<?php	} ?>		
									</select>                                	
								</div>
                            </div>                            
                            <div class="row-form clearfix">
                                <div class="span3">Title:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title', $data[0]['Title']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">URL:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"Url",'id'=>"Url", 'value'=>set_value('Url', $data[0]['Url']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Sort Order:</div>
                                <div class="span9"><?php echo form_input(array('name'=>"SortOrder",'id'=>"SortOrder", 'value'=>set_value('SortOrder', $data[0]['SortOrder']))); ?></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">Status:</div>
                                <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn",'id'=>"Status",'name'=>"Status", 'checked'=>($data[0]['Status']=='Enabled'?TRUE:FALSE),'value'=>"Enabled"));?></div>
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
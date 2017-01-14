			<div class="workplace">
                   <div class="page-header">
                    <h1>Roles </h1>
                </div>                                
                <div class="row-fluid">
                	
                    <div class="span12">
                    	<?php $this->load->view('admin/includes/message'); ?>
                    	<?php
                        	echo form_open('admin/employee/save_roles',array('method' => 'post','id'=>'form'));
					?>                    
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>Roles Access</h1>                               
                        </div>
                        <div class="block-fluid table-sorting clearfix">
                        	 <!-- for pagination set id = tSortable !-->
                            <table cellpadding="0" cellspacing="0" width="100%" class="table" >
                                <thead>
                                    <tr>                                       
                                        <th width="5%">ID</th>
                                        <th width="35%">Module Name</th>
                                        <th width="15%">Add</th>
                                        <th width="15%">Edit</th>
                                        <th width="15%">View</th>
                                        <th width="15%">Delete</th>                                                                           
                                    </tr>
                                </thead>
                                <tbody>
                                	
                                	<?php
                                	$arr = array();
									echo form_hidden("EmployeeID",$data[0]['EmployeeID']);
                                	foreach($data as $value)
									{
										?>
                                    <tr>
                                         <td><?php echo $id = $value['ID']; ?></td>
                                        <td><?php echo $value['Title']; ?></td>
                                        <td>
                                        <?php  
                                        $check =  $value['Add'] == "Y"?"checked='checked'":"";
										 ?>
                                        	<input type="checkbox" value="Y" name="<?php 
                                        	echo "arr[$id][Add]";
                                        	?>"
                                        	 <?php echo $check ?>   />
                                        </td>
                                        <td>
                                        <?php 
                                        $check =  $value['Edit'] == "Y"?"checked='checked'":""; 
                                        ?>
                                        	<input type="checkbox" value="Y" name="<?php 
                                        	echo "arr[$id][Edit]";
                                        	?>" 
                                        	<?php echo $check ?> />
                                        </td>
                                        <td>
                                        <?php 
                                        $check =  $value['View'] == "Y"?"checked='checked'":""; 
                                        ?>
                                        	<input type="checkbox" value="Y" name="<?php 
                                        	echo "arr[$id][View]";
                                        	?>" 
                                        	 <?php echo $check ?> />
                                        </td>
                                        <td>
                                        <?php 
                                        $check =  $value['Delete'] == "Y"?"checked='checked'":""; 
                                        ?>
                                        	<input type="checkbox" value="Y" name="<?php 
                                        	echo "arr[$id][Delete]";
                                        	?>" 
                                        	 <?php echo $check ?> />
                                        </td>                                                                            
                                    </tr>
                                          <?php
									}
									?>                                                             
                                </tbody>
                            </table>
                            
                        </div>
                        <?php
                          echo form_submit(array('value'=> 'Save Roles','class'=>'btn'));
						  echo form_close();
                        ?>
                    </div>                                
                    
                </div>             
           </div>           
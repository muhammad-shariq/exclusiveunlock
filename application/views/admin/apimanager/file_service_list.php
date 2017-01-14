<div class="workplace">
    <div class="row-fluid">
        <div class="span12">   
              <?php $this->load->view('admin/includes/message'); ?>
              <?php echo form_open('admin/apimanager/add_file_service_list/'.$this->uri->segment(4)); ?>
              <div class="head clearfix">
                  <div class="isw-grid"></div>
                  <h1>File Services List</h1>                      
              </div>
            <div class="block-fluid table-sorting clearfix">
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="">
                    <thead>
                        <tr>                           
                          <th width="5%"><input type="checkbox" name="checkall"/></th>             
                          <th width="24%">Service Name</th>
                          <th width="5%">Price</th>
                          <th width="15%">Info</th>
                          <th width="14%">Time</th>
                          <th width="5%">Set Price</th>                                                                      
                        </tr>
                    </thead>
                    <tbody>
                      <?php
      foreach($service_list as $groups)
      {
        foreach($groups['SERVICES'] as $service )
        {
              $service_id = $service['SERVICEID'];
          ?>
                          <tr>
                            <td><input type="checkbox" value="<?php echo $service_id; ?>" name="chk[]" class="span12" /></td>		
                            <td><input type="text" name="ServiceName[<?php echo $service_id; ?>]" value="<?php echo $service['SERVICENAME']; ?>" class="span12" /></td>
                            <td><input type="text" value="<?php echo $service['CREDIT']; ?>" class="span12" disabled="disabled" /></td>
                            <td><?php echo $service['INFO']; ?></td>
                            <td><input type="text" name="Time[<?php echo $service_id; ?>]" value="<?php echo $service['TIME']; ?>" class="span12" /></td>
                            <td><input type="text" name="Price[<?php echo $service_id; ?>]" value="<?php echo $service['CREDIT']; ?>" class="span12" /></td>                                   
                        </tr>
          <?php
          echo form_hidden("AllowExtension[$service_id]", $service['ALLOW_EXTENSION']);
        }
      }
      ?>
                    </tbody>                                
                </table>
            </div>
            <?php
                echo form_submit(array('value'=> 'Add Selected Services','class'=>'btn'));
    echo form_close();
            ?>         
        </div>                                

    </div>            

    <div class="dr"><span></span></div>            

</div>

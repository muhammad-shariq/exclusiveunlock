<div class="workplace">
    <div class="row-fluid">
        <div class="span12">   
              <?php $this->load->view('admin/includes/message'); ?>
              <?php echo form_open('admin/apimanager/add_imei_service_list/'.$this->uri->segment(4)); ?>
              <div class="head clearfix">
                  <div class="isw-grid"></div>
                  <h1>IMEI Services List</h1>                      
              </div>
            <div class="block-fluid table-sorting clearfix">
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="">
                    <thead>
                        <tr>                           
                          <th width="5%"><input type="checkbox" name="checkall"/></th>             
                          <th width="24%">Service Name</th>
                          <th width="5%">Price</th>
                          <th width="5%">Info</th>
                          <th width="12%">Time</th>
                          <th width="12%">Network</th>
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
                            <td>
                            <select name="NetworkID[<?php echo $service_id; ?>]"  class="span12" >
                            <?php foreach($networks as $val): ?>
                              <option value="<?php echo $val['ID']; ?>" ><?php echo $val['Title']; ?></option>
                            <?php endforeach; ?>	
                            </select>
                            </td>
                            <td><input type="text" name="Price[<?php echo $service_id; ?>]" value="<?php echo $service['CREDIT']; ?>" class="span12" /></td>                                   
                        </tr>
          <?php
          echo form_hidden("Network[$service_id]", $service['Requires.Network']);
          echo form_hidden("Mobile[$service_id]", $service['Requires.Mobile']);
          echo form_hidden("Provider[$service_id]", $service['Requires.Provider']);
          echo form_hidden("PIN[$service_id]", $service['Requires.PIN']);
          echo form_hidden("KBH[$service_id]", $service['Requires.KBH']);
          echo form_hidden("MEP[$service_id]", $service['Requires.MEP']);
          echo form_hidden("PRD[$service_id]", $service['Requires.PRD']);
          echo form_hidden("Type[$service_id]", $service['Requires.Type']);
          echo form_hidden("Locks[$service_id]", $service['Requires.Locks']);
          echo form_hidden("Reference[$service_id]", $service['Requires.Reference']);
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

<div class="workplace">                             
    <div class="row-fluid">
      
        <div class="span12">
          <?php $this->load->view('admin/includes/message'); ?>
          <?php echo form_open('admin/imeiorder/bulk_operation',array('method' => 'post','id'=>'form')); ?>                    
            <div class="head clearfix">
                <div class="isw-grid"></div>
                <h1>Bulk IMEI Order Request</h1>                               
            </div>
            <div class="block-fluid table-sorting clearfix">
                <!-- for pagination set id = tSortable !-->
                <table cellpadding="0" cellspacing="0" width="100%" class="table" >
                    <thead>
                        <tr>
                            <th>Refund<input type="checkbox" name="checkall"/></th>
                            <th width="5%">ID</th>
                            <th width="30%">IMEI</th>
                            <th width="30%">Network</th>
                            <th width="30%"><?php echo form_input(array('id'=> 'code', 'placeholder' => 'Code')); ?></th>                    
                            <th width="30%"><?php echo form_input(array('id'=> 'comments', 'placeholder' => 'Comments')); ?></th>                
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data as $value): ?>
                        <tr>
                            <td><input type="checkbox" name="refund[]" value="<?php echo $value['ID']; ?>"/></td> 
                            <td><?php echo $id = $value['ID']; ?></td>
                            <td><?php echo $value['IMEI']; ?></td>
                            <td><?php echo $value['Title']; ?></td>
                            <td><input type="text" name="<?php echo "Code[$id]"; ?>" class="codes" /></td>
                            <td><input type="text" name="<?php echo "Comments[$id]"; ?>" class="comments" /></td>	                                     
                        </tr>
                     <?php endforeach; ?>                                                             
                    </tbody>
                </table>
                
            </div>
            <?php
              echo form_submit(array('value'=> 'Submit','class'=>'btn'));
  echo form_close();
            ?>
        </div>                                
        
    </div>             
</div>
<script type="text/javascript">
$("#code").keyup(function(){
  var val = $(this).val();
  $(":input[class ^=codes ]").val(val);
});
$("#comments").keyup(function(){
  var val = $(this).val();
  $(":input[class ^=comments ]").val(val);
});
</script>
           
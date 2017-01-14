<div class="workplace">                
    <div class="row-fluid">

        <div class="span12">
            <?php $this->load->view('admin/includes/message'); ?>
            <div class="head clearfix">
                <div class="isw-documents"></div>
                <h1>File Services Order Update</h1>
            </div>
            <div class="block-fluid">                        
            <?php echo form_open_multipart("admin/fileorder/update",array('id'=>"fileorder-validate")); ?>
            <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />                            
                <div class="row-form clearfix">
                    <div class="span3">File Service:</div>
                    <div class="span9"><?php echo  form_dropdown('FileServiceID', $service_list, set_value('FileServiceID', $data[0]['FileServiceID']), 'id="MethodID"'); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">IMEI:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"IMEI",'id'=>"IMEI", 'value'=>set_value('IMEI', $data[0]['IMEI']))); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">File:</div>
                    <div class="span9"><a href="<?php echo $this->config->item('fileservice_url').$data[0]['FileName']; ?>"><?php echo $data[0]['FileName']; ?></a></div>
                </div>                
                <div class="row-form clearfix">
                    <div class="span3">Email:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"Email",'id'=>"Email", 'value'=>set_value('Email', $data[0]['Email']))); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">Mobile No:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"Mobile",'id'=>"Mobile", 'value'=>set_value('Mobile', $data[0]['Mobile']))); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">Note:</div>
                    <div class="span9"><?php echo form_textarea(array('name'=>"Note",'id'=>"Note", 'value'=>set_value('Note', $data[0]['Note']))); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">Comments:</div>
                    <div class="span9"><?php echo form_textarea(array('name'=>"Comments",'id'=>"Comments", 'value'=>set_value('Comments', $data[0]['Comments']))); ?></div>
                </div>
                                                                                                                                                                                        <div class="row-form clearfix">
                    <div class="span3">Status:</div>
                    <div class="span9"><?php echo  form_dropdown('Status', $status_list, set_value('Status', $data[0]['Status']), 'id="Status"'); ?></div>
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
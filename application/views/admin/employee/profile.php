<div class="workplace">                
    <div class="row-fluid">

        <div class="span12">
            <?php $this->load->view('admin/includes/message'); ?>
            <div class="head clearfix">
                <div class="isw-documents"></div>
                <h1>Update Profile</h1>
            </div>
            <div class="block-fluid">                        
            <?php echo form_open("", array('id'=>"menu-validate")); ?>                        
                <div class="row-form clearfix">
                    <div class="span3">First Name:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"FirstName",'id'=>"FirstName", 'value'=>set_value('FirstName', $data[0]['FirstName']))); ?></div>
                </div>
                
                <div class="row-form clearfix">
                    <div class="span3">Last Name:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"LastName",'id'=>"LastName", 'value'=>set_value('LastName', $data[0]['LastName']))); ?></div>
                </div>
                
                <div class="row-form clearfix">
                    <div class="span3">Email:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"Email",'id'=>"Email", 'disabled'=>'disabled', 'value'=>set_value('Email', $data[0]['Email']))); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">Current Password:</div>
                    <div class="span9"><?php echo form_password(array('name'=>"Password",'id'=>"Password", 'value'=>'')); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">New Password:</div>
                    <div class="span9"><?php echo form_password(array('name'=>"NewPassword",'id'=>"NewPassword", 'value'=>'')); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">Confirm Password:</div>
                    <div class="span9"><?php echo form_password(array('name'=>"ConfirmPassword",'id'=>"ConfirmPassword", 'value'=>'')); ?></div>
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
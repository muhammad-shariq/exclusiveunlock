<div class="workplace">                
    <div class="row-fluid">

        <div class="span12">
            <?php $this->load->view('admin/includes/message'); ?>
            <div class="head clearfix">
                <div class="isw-documents"></div>
                <h1>Brand Model Add</h1>
            </div>
            <div class="block-fluid">                        
            <?php echo form_open_multipart("admin/servicemodel/insert",array('id'=>"servicemodel-validate")); ?> 
                <div class="row-form clearfix">
                    <div class="span3">Brand:</div>
                    <div class="span9">
                        <select name="BrandID" id="BrandID" >
                        <option>Select Brand</option>
                        <?php
                        foreach($brand as $key => $val)
                        {
                            ?>
                            <option value="<?php echo $val["BrandID"] ?>" >
                                <?php echo $val["Title"]; ?></option>
                            <?Php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">Api Model ID:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"ApiModelID",'id'=>"ApiModelID", 'value'=>set_value('Host',''))); ?></div>
                </div>
                <div class="row-form clearfix">
                    <div class="span3">Title:</div>
                    <div class="span9"><?php echo form_input(array('name'=>"Title",'id'=>"Title", 'value'=>set_value('Title',''))); ?></div>
                </div>                    
                <div class="row-form clearfix">
                    <div class="span3">Status:</div>
                    <div class="span9"><?php echo form_checkbox(array('class'=>"ibtn", 'id'=>"Status", 'name'=>"Status", 'checked'=>"checked", 'value'=>"Enabled"));?></div>
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
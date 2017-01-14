<div class="dashboard">
<div class="row">
<div class="col-lg-12">
<h2>File Services</h2>

</div>
</div>

<div class="row">
<div class="col-lg-8">
<?php $this->load->view('includes/messages'); ?>

<?php echo form_open_multipart('member/fileservices/insert', array('id' =>'filereq' ,'role' => 'form', 'method' => 'post','name' => 'form2', 'class' => 'form-horizontal')); ?>
  <div class="form-group">
    <label class="col-sm-3 control-label">Services</label>
    <div class="col-sm-9">
    <select name="FileServiceID" id="FileServiceID" class="form-control" required="">
    	<option value="" >Select Services</option>
    	<?php foreach($services as $val): ?>
			<option value="<?php echo $val['ID'] ?>" <?php echo set_select('FileServiceID', $val['ID']); ?>><?php echo $val['Title'] ?></option>
	   <?php endforeach; ?>
    </select>
    </div>
  </div>
  
  <div id="extend" ></div>
  
  <div class="form-group">
    <label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
    <input type="email" name="Email"  id="" placeholder="Email Address" class="form-control" value="<?php echo set_value('Email'); ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Mobile No.</label>
        <div class="col-sm-9">
    <input type="text" name="Mobile"  id="" placeholder="Mobile Number" class="form-control" value="<?php echo set_value('Mobile'); ?>">
  </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Note</label>
        <div class="col-sm-9">
    <textarea name="Note" rows="3" cols="15" class="form-control" ><?php echo set_value('Note'); ?></textarea>
  </div>
  </div>
   <div class="form-group">
    <label class="col-sm-3 control-label">Select File(s)</label>
    <div class="col-sm-9">
        <input type="file" name="File[]" multiple required />    
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-warning btn-lg">Submit</button>
    </div>
  </div>
<?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript" >
$(document).ready(function() {
    var id = $("#FileServiceID").val();
    if(id != "")
    {
        var data = $("#filereq").serialize();
        $.ajax({
            type:"post",
            url: "<?php echo site_url('member/fileservices/filedata'); ?>",
            data: data,
            cache: false,
            success: function(data)
            {
                $("#extend").html('');
                $("#extend").html(data);					
            }
        });				
    }    
	$("#FileServiceID").change(function(){
		var id = $(this).val();
		if(id != "")
		{
			var data = $("#filereq").serialize();
			$.ajax({
				type:"post",
				url: "<?php echo site_url('member/fileservices/filedata'); ?>",
				data: data,
				cache: false,
				success: function(data)
				{
					$("#extend").html('');
					$("#extend").html(data);					
				}
			});				
		}else
		{
			$("#extend").html('');
		}
		
	});
});
</script>
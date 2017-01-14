<div class="dashboard">
<div class="row">
<div class="col-lg-12">
<h2>Verify Imei Request</h2>

</div>
</div>

<div class="row">
<div class="col-lg-8">

	<div class="alert alert-danger fade in">
      	<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
		<strong>Note:- </strong> You Submitted verification code request only 1 time.
	</div>
<?php $this->load->view('includes/messages'); ?>
<?php echo form_open('member/imeirequest/verifyinsert', array('role' => 'form', 'method' => 'post','id' => 'imeireq' ,'name' => 'form2', 'class' => 'form-horizontal')); ?>
     
             
   <div class="form-group">
   	<label class="col-sm-3 control-label">Order Id</label>    	
   	
   	<div class="col-sm-9">
   		<input type="text" name="orderid"  placeholder="Order id" required class="form-control" >
  	</div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-3 control-label">Code</label>
    
    <div class="col-sm-9">
    	<input type="text" name="code"  id="" placeholder="code" required class="form-control">
  	</div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-3 control-label">Imei</label>
    
    <div class="col-sm-9">
    	<input type="text" name="imei" placeholder="Imei " required class="form-control">
  	</div>
  </div>
  
      
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
  <button type="submit" class="btn btn-warning btn-lg"> Verify Request order</button>
  </div>
  </div>
<?php echo form_close(); ?>

    </div>
</div>


<script type="text/javascript">
$("#Title").change(function(){
	var val = $("#Title").val();
	if(val != "")
	{
		var data = $("#imeireq").serialize();
	$.ajax({
		type: "post",
		url: "<?php echo site_url('member/imeirequest/formfields'); ?>",
		data: data,
		cache: false,
		success: function(data)
		{
			$("#load-field").html('');
			$("#load-field").html(data);
		}
	});		
	}	
	else
	{
		$("#load-field").html('');
	}
});	
</script>
<div class="dashboard">
<div class="row">
  <div class="col-lg-12">
  <h2>Add Credits</h2>
  
  </div>
</div>

<div class="row">
<div class="col-lg-8">
<?php $this->load->view('includes/messages'); ?>
<?php echo form_open('member/checkout', array('role' => 'form', 'method' => 'post','id' => 'imeireq' ,'name' => 'form2', 'class' => 'form-horizontal')); ?>      
  <div class="form-group">
    <label class="col-sm-3 control-label">No. of Credits</label>
    <div class="col-sm-3">
    <input type="text" name="Credit"  placeholder="Credits" required class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Payment Type</label>
    <div class="col-sm-3">
      <select name="payment_type" id="payment_type" class="form-control" required >
    	<option value="paypal">PayPal</option>
      </select>
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
  <button type="submit" class="btn btn-warning btn-lg">Add Credit</button>
  </div>
  </div>
  
  <div class="form-group">
  	<div class="col-sm-offset-3 col-sm-9">
  		<p style="color:red;" > Note:- <?php echo $paypal_settings[0]['percent'].'%' ?> will be charged. </p>
  	</div>
  </div>
<?php echo form_close(); ?>
    </div>
</div>
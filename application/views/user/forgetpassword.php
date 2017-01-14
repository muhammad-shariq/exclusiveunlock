<h2><?php echo $heading; ?></h2>
<?php $this->load->view('includes/messages'); ?>
	<?php echo form_open('forgot_password', array('role' =>'form','method' =>'post' )); ?>
  <div class="form-group">
    <label for="">Email</label>
    <input type="email" name="Email" class="form-control" value="" placeholder="Email">
  </div>
  <button type="submit" class="btn btn-warning btn-lg">Submit</button>
<?php echo form_close(); ?>

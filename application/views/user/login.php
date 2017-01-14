<h2><?php echo $heading; ?></h2>
<?php $this->load->view('includes/messages'); ?>
	<?php echo form_open('login',array('role' =>'form','method' =>'post' )); ?>
  <div class="form-group">
    <label for="">Email</label>
    <input type="email" name="Email" value="<?php echo set_value('Email'); ?>" class="form-control" placeholder="Email" required="">
  </div>
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" name="Password" class="form-control" placeholder="Password" required="">
  </div>
  <button type="submit" class="btn btn-warning btn-lg">Login</button>
  
<?php echo form_close(); ?>
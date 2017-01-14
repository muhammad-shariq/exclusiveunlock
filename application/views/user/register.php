<h2><?php echo $heading; ?></h2>
<?php $this->load->view('includes/messages'); ?>
	<?php echo form_open('register',array('role' =>'form','method' =>'post' )); ?>
  <div class="form-group">
    <label for="">First Name</label>
    <input type="text" name="FirstName" value="<?php echo set_value('FirstName'); ?>"  class="form-control" placeholder="First Name" required >
  </div>
  
  <div class="form-group">
    <label for="">Last Name</label>
    <input type="text" name="LastName" value="<?php echo set_value('LastName'); ?>"  class="form-control" placeholder="Last Name" required >
  </div>
  
  <div class="form-group">
    <label for="">Email</label>
    <input type="email" name="Email" value="<?php echo set_value('Email'); ?>" class="form-control" placeholder="Email address" required >
  </div>
  
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" name="Password" class="form-control" placeholder="Password" required >
  </div>
  
  <div class="form-group">
    <label for="">Confirm Password</label>
    <input type="password" name="CPassword" class="form-control" placeholder="Confirm Password" required >
  </div>
  <button type="submit" class="btn btn-warning btn-lg">Sign up</button>
  
<?php echo form_close(); ?>

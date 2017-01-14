<h2><?php echo $heading; ?></h2>
<?php
if($this->session->flashdata("notice"))
{
	 echo $this->session->flashdata("notice"); 
	
}
?>
	<?php echo form_open('User/UserLogin',array('role' =>'form','method' =>'post' )); ?>
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" name="Password" class="form-control" id="" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="">Confirm Password</label>
    <input type="Cpassword" name="Password" class="form-control" id="" placeholder="Confirm Password">
  </div>
  <button type="submit" class="btn btn-warning btn-lg">Set Password</button>
<?php echo form_close(); ?>

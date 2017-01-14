<div class="dashboard">
<div class="row">
<div class="col-lg-12">
<h2>Profile</h2>

</div>
</div>

<div class="row">
<div class="col-lg-8">

<?php
if($this->session->flashdata('success'))
{
	?>
	<div class="alert alert-success fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Success</strong> Updated Successfully.
    </div>
	<?php
}
?>
<?php
if($this->session->flashdata("fail"))
{ ?>
	<div class="alert alert-danger fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<strong>Fail </strong> <?php echo $this->session->flashdata("fail"); ?>
	 </div>
<?php } ?>
<?php echo form_open('member/dashboard/editprofile', array('role' => 'form', 'method' => 'post','id' => 'imeireq' ,'name' => 'form2', 'class' => 'form-horizontal')); ?>
  
  <?php echo form_hidden("ID",$data[0]['ID']); ?>
      
    <div class="form-group">
    <label class="col-sm-3 control-label">First Name</label>
    <div class="col-sm-9">
    <input type="text" name="FirstName"  placeholder="First Name" value="<?php echo $data[0]['FirstName']; ?>" required class="form-control" >
    </div>
  </div>
    
    <div class="form-group">
    <label class="col-sm-3 control-label">Last Name</label>
    <div class="col-sm-9">
    <input type="text" name="LastName"  placeholder="Last Name" value="<?php echo $data[0]['LastName']; ?>" required class="form-control" >
    </div>
  </div>
    
    <div class="form-group">
    <label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
    <input type="email" name="Email" readonly="readonly"  placeholder="Email" value="<?php echo $data[0]['Email']; ?>" required class="form-control" >
    </div>
  </div>
    
    <div class="form-group">
    <label class="col-sm-3 control-label">Current Password</label>
    <div class="col-sm-9">
    <input type="password" name="CurrentPassword" placeholder="Current Password" required class="form-control" >
    </div>
  </div>
    
    <div class="form-group">
    <label class="col-sm-3 control-label">New Password</label>
    <div class="col-sm-9">
    <input type="password" name="NewPassword" placeholder="New Password"  class="form-control" >
    </div>
  </div>
    
    <div class="form-group">
    <label class="col-sm-3 control-label">Confirm New Password</label>
    <div class="col-sm-9">
    <input type="password" name="ConfirmPassword" placeholder="Confirm New Password"  class="form-control" >
    </div>
  </div>
  
   
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
  <button type="submit" class="btn btn-warning btn-lg">Update</button>
  </div>
  </div>
<?php echo form_close(); ?>

    </div>
</div>

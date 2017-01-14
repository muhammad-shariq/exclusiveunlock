<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>SUCCESS! </strong> <?php echo $this->session->flashdata("success"); ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata("fail")): ?>
    <div class="alert alert-danger fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <strong>FAILED! </strong> <?php echo $this->session->flashdata("fail"); ?>
     </div>
<?php endif; ?>
<?php echo validation_errors('<div class="alert alert-danger fade in"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>FAILED! </strong>','</div>'); ?>
<?php /*
<!--
<div class="alert alert-danger fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
    </div>

<div class="alert alert-dismissable fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
    </div>

<div class="alert alert-info fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
    </div>

<div class="alert alert-link fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
    </div>

<div class="alert alert-success fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
    </div>
<div class="alert alert-warning fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
    </div> !-->
*/ ?>    
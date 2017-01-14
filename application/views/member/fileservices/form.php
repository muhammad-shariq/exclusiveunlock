<?php if(!empty($price)): ?>
	<div class="form-group">
    <label class="col-sm-3 control-label">Price</label>
    <div class="col-sm-9 text"><?php echo $price; ?> Credits</div>
  </div>
<?php endif; ?>

<?php if(!empty($delivery_time)) : ?>
	<div class="form-group">
    <label class="col-sm-3 control-label">Delivery Time</label>
    <div class="col-sm-9 text"><?php echo $delivery_time; ?></div>
  </div>
<?php endif; ?>

<?php if(!empty($description) ): ?>
	<div class="form-group">
    <label class="col-sm-3 control-label">Description</label>
    <div class="col-sm-9 text"><?php echo $description; ?>
    </div>
  </div>
<?php endif; ?>
<?php if(!empty($allowed_extension) ): ?>
	<div class="form-group">
    <label class="col-sm-3 control-label">Allowed Extensions</label>
    <div class="col-sm-9 text"><?php echo $allowed_extension; ?>
    </div>
  </div>
<?php endif; ?>
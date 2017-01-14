<?php	if($this->session->flashdata('warning') != ""){ ?>
                <div class="alert alert-block">                
                    <h4>Warning!</h4>
                    <?php echo $this->session->flashdata('warning'); ?>
                </div>            
<?php	}	?>
<?php	if($this->session->flashdata('error') != ""){ ?>
                <div class="alert alert-error">                
                    <h4>Error!</h4>
                    <?php echo $this->session->flashdata('error'); ?> 
                </div>            
<?php	}	?>
<?php	if($this->session->flashdata('success') != ""){ ?>
                <div class="alert alert-success">                
                    <h4>Success!</h4>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>            
<?php	}	?>
<?php	if($this->session->flashdata('info') != ""){ ?>
                <div class="alert alert-info">                
                    <h4>Info!</h4>
                    <?php echo $this->session->flashdata('info'); ?>
                </div>
<?php	}	?> 
<?php echo validation_errors('<div class="alert alert-block"><h4>Warning!</h4>','</div>'); ?>             
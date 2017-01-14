<div class="breadcrum-head">
<div class="row">
<div class="col-lg-6">
<ol class="breadcrumb">
	<li>You Are Here</li>
  <li><a href="#">Home</a></li>
  <li class="active">Dashboard</li>
</ol>
</div>

</div>
</div>

<div class="dashboard">
<div class="row">

<div class="col-lg-2">
<div class="user-image">
<img src="<?php echo base_url(); ?>img/avatar.jpg">
</div>
</div>

<div class="col-lg-3"> 

<div class="user-info">
<ul>
<li class="name"><i class="glyphicon glyphicon-user"></i><span><?php echo $this->session->userdata('MemberFirstName')
." ".$this->session->userdata("MemberLastName"); ?></span></li>
<li><i class="glyphicon glyphicon-envelope"></i><?php echo $this->session->userdata("MemberEmail"); ?></li>

<?php if($this->session->userdata("MemberPhone") != "" ) { ?>
	<li><i class="glyphicon glyphicon-phone"></i><?php echo $this->session->userdata("MemberPhone"); ?></li>
<?php } ?>	
</ul> 
</div>
</div>
<div class="col-lg-7"> 
	<div class="row">
		<div class="circles col-lg-4">
			<input class="knob" data-fgColor="#8dc63f" data-thickness=".07" readonly value="<?php echo intval($appraovedPercentage); ?>">
			<span>Available</span>
		</div>
		<div class="circles col-lg-4">
			<input class="knob" data-fgColor="#00aeef" data-thickness=".07" readonly value="<?php echo intval($rejectPercentage); ?>">
			<span>Rejected</span>
		</div>
		<div class="circles col-lg-4">
			<input class="knob" data-fgColor="#ed145b" data-thickness=".07" readonly value="<?php echo intval($pendingPercentage); ?>">
			<span>Pending</span>
		</div>
	</div>
</div>

</div>

<div class="row">
<div class="col-lg-12">
<div class="status">
<ul>
<li><span><?php echo $credit[0]['credit'] ?> Credits</span> - Available</li>
</ul>

</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">

<div class="order-history">
    <ul class="nav nav-tabs" id="myTab">
      <li class="active"><a data-toggle="tab" href="#imeiorders">IMEI Orders</a></li>
      <li class=""><a data-toggle="tab" href="#pendinginvoices">File Services</a></li>
      <li class=""><a data-toggle="tab" href="#latestnews">Credit</a></li>
    </ul>
    
    <div class="tab-content" id="myTabContent">
      <div id="imeiorders" class="tab-pane fade active in">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="TableDeferLoading">
			<thead>
				<tr>
					<th width="3%">ID</th>
					<th width="15%">IMEI</th>
					<th width="30%">Method</th>
					<th width="22%">Code</th>
					<th width="15%">Note</th>
					<th width="5%">Status</th>
					<th width="10%">Date Time</th>
				</tr>
			</thead>
		</table>
      </div>
      <div id="pendinginvoices" class="tab-pane fade">
         <table cellpadding="0" cellspacing="0" border="0" class="display" id="TableDeferLoading1">
			<thead>
				<tr>
					<th width="3%">ID</th>
					<th width="15%">IMEI</th>
					<th width="30%">Method</th>
					<th width="22%">Code</th>
					<th width="15%">Note</th>
					<th width="5%">Status</th>
					<th width="10%">Date Time</th>
				</tr>
			</thead>
		</table>
      </div>
      <div id="latestnews" class="tab-pane fade">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="Credit">
			<thead>
				<tr>
					<th width="3%">ID</th>
					<th width="7%">ID</th>
					<th width="5%">Amount</th>
					<th width="70%">Description</th>
					<th width="15%">Date Time</th>
				</tr>
			</thead>
		</table>
      </div>
    </div>
  </div>
  
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$(".knob").knob({
		change : function (value) {
			//console.log("change : " + value);
		},
		release : function (value) {
			//console.log(this.$.attr('value'));
			console.log("release : " + value);
		},
		cancel : function () {
			console.log("cancel : ", this);
		},
		/*format : function (value) {
			return value + '%';
		},*/
		draw : function () {
				$(this.i).val(this.cv + '%'); 
			// "tron" case
			if(this.$.data('skin') == 'tron') {
		
				this.cursorExt = 0.3;
		
				var a = this.arc(this.cv)  // Arc
					, pa                   // Previous arc
					, r = 1;
		
				this.g.lineWidth = this.lineWidth;
		
				if (this.o.displayPrevious) {
					pa = this.arc(this.v);
					this.g.beginPath();
					this.g.strokeStyle = this.pColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
					this.g.stroke();
				}
		
				this.g.beginPath();
				this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
				this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
				this.g.stroke();
		
				this.g.lineWidth = 2;
				this.g.beginPath();
				this.g.strokeStyle = this.o.fgColor;
				this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
				this.g.stroke();
		
				return false;
			}
		}
	});
		
	// Example of infinite knob, iPod click wheel
	var v, up=0,down=0,i=0
	,$idir = $("div.idir")
	,$ival = $("div.ival")
	,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
	,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
	$("input.infinite").knob({min : 0, max : 100, stopper : false, change : function () {
			if(v > this.cv){
				if(up){
					decr();
					up=0;
				}else{up=1;down=0;}
			} else {
				if(v < this.cv){
					if(down){
						incr();
						down=0;
					}else{down=1;up=0;}
				}
			}
			v = this.cv;
		}
	});
	
	$('#TableDeferLoading').dataTable
	({			  
			'bProcessing'    : true,
			'bServerSide'    : true,
			'bAutoWidth'     : false,
			'sPaginationType': 'full_numbers',
			'sAjaxSource'    : '<?php echo site_url('member/dashboard/listener'); ?>',
			//'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
			'aLengthMenu': [25, 50, 100, 200, 500, 1000],
			'aaSorting'      : [[0, 'desc']],
			'iDisplayLength': 100,
			'sDom'		   : 'T<"clear">lfrtip', //datatable export buttons
			'oTableTools'	  : 
			{ //datatable export buttons
			"sSwfPath": "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/swf/copy_csv_xls_pdf.swf",
			"sRowSelect": "multi"		      	
			}, 
			'aoColumns'      : 
				[
				{
					'bSearchable': false,
					'bVisible'   : true
				},			        
				null,
				null,
				null,
				null,
				null,
				null
				],
				'fnServerData': function(sSource, aoData, fnCallback)
				{
	<?php if($this->config->item('csrf_protection') === TRUE){	?>
				aoData.push({ name : '<?php echo $this->config->item('csrf_token_name'); ?>', value :  $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>') });
	<?php }	?>			      	
				$.ajax
				({
						'dataType': 'json',
						'type'    : 'POST',
						'url'     : sSource,
						'data'    : aoData,
						'success' : fnCallback
				});
				}
	});
	
	$('#TableDeferLoading1').dataTable
	({			  
			'bProcessing'    : true,
			'bServerSide'    : true,
			'bAutoWidth'     : false,
			'sPaginationType': 'full_numbers',
			'sAjaxSource'    : '<?php echo site_url('member/dashboard/fileorder'); ?>',
			'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
			'aLengthMenu': [25, 50, 100, 200, 500, 1000],
			'aaSorting'      : [[0, 'desc']],
			'iDisplayLength': 100,
			'sDom'		   : 'T<"clear">lfrtip', //datatable export buttons
			'oTableTools'	  : 
			{ //datatable export buttons
			"sSwfPath": "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/swf/copy_csv_xls_pdf.swf",
			"sRowSelect": "multi"		      	
			}, 
			'aoColumns'      : 
				[
				{
					'bSearchable': false,
					'bVisible'   : true
				},			        
				null,
				null,
				null,
				null,
				null,
				null
				],
				'fnServerData': function(sSource, aoData, fnCallback)
				{
	<?php				if($this->config->item('csrf_protection') === TRUE){	?>
				aoData.push({ name : '<?php echo $this->config->item('csrf_token_name'); ?>', value :  $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>') });
	<?php				}	?>			      	
				$.ajax
				({
						'dataType': 'json',
						'type'    : 'POST',
						'url'     : sSource,
						'data'    : aoData,
						'success' : fnCallback
				});
				}
	});

	$('#Credit').dataTable
	({			  
			'bProcessing'    : true,
			'bServerSide'    : true,
			'bAutoWidth'     : false,
			'sPaginationType': 'full_numbers',
			'sAjaxSource'    : '<?php echo site_url('member/dashboard/credit'); ?>',
			//'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 3 ] } ],
			'aLengthMenu': [25, 50, 100, 200, 500, 1000],
			'aaSorting'      : [[0, 'desc']],
			'iDisplayLength': 100,
			'sDom'		   : 'T<"clear">lfrtip', //datatable export buttons
			'oTableTools'	  : 
			{ //datatable export buttons
			"sSwfPath": "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/swf/copy_csv_xls_pdf.swf",
			"sRowSelect": "multi"		      	
			}, 
			'aoColumns'      : 
				[
				{
					'bSearchable': false,
					'bVisible'   : false
				},			        
				null,
				null,
				null,
				null
				
				],
				'fnServerData': function(sSource, aoData, fnCallback)
				{
	<?php				if($this->config->item('csrf_protection') === TRUE){	?>
				aoData.push({ name : '<?php echo $this->config->item('csrf_token_name'); ?>', value :  $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>') });
	<?php				}	?>			      	
				$.ajax
				({
						'dataType': 'json',
						'type'    : 'POST',
						'url'     : sSource,
						'data'    : aoData,
						'success' : fnCallback
				});
				}
	});
	
});	
</script>
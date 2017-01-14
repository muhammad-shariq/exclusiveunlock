<footer class="home-footer">

</footer>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
 <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
 <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.cookie.js'></script>
 <!-- <script type='text/javascript' src='http://gsmworkshop.localhost/assets/js/cookies.js'></script>
 	!-->
 <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
 <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
 <script type="text/javascript" charset="utf-8">
			var asInitVals = new Array();
			
			$(document).ready(function() {
				var oTable = $('#example2').dataTable( {
					"oLanguage": {
						"sSearch": "Search all columns:"
					}
				} );
				
				$("tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					oTable.fnFilter( this.value, $("tfoot input").index(this) );
				} );
				
				
				
				/*
				 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
				 * the footer
				 */
				$("tfoot input").each( function (i) {
					asInitVals[i] = this.value;
				} );
				
				$("tfoot input").focus( function () {
					if ( this.className == "search_init" )
					{
						this.className = "";
						this.value = "";
					}
				} );
				
				$("tfoot input").blur( function (i) {
					if ( this.value == "" )
					{
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				} );
				
				
			} );
			$(document).ready(function() {
				var oTable = $('#example').dataTable( {
					"oLanguage": {
						"sSearch": "Search all columns:"
					}
				} );
				
				$("tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					oTable.fnFilter( this.value, $("tfoot input").index(this) );
				} );
				
				
				
				/*
				 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
				 * the footer
				 */
				$("tfoot input").each( function (i) {
					asInitVals[i] = this.value;
				} );
				
				$("tfoot input").focus( function () {
					if ( this.className == "search_init" )
					{
						this.className = "";
						this.value = "";
					}
				} );
				
				$("tfoot input").blur( function (i) {
					if ( this.value == "" )
					{
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				} );
				
				
			} );
			
			
		</script>
        <!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
        <script src="<?php echo base_url(); ?>js/jquery.knob.js"></script>
        <script>
            $(function($) {

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
                $("input.infinite").knob(
                                    {
                                    min : 0
                                    , max : 100
                                    , stopper : false
                                    , change : function () {
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
            });
            
            
            $('#TableDeferLoading').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/dashboard/listener'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		
		
		
		
		
		$('#TableDeferLoading1').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/dashboard/fileorder'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 3 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		
		
		
		$('#filepending').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/fileservices/fileorder/Pending'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		
		$('#fileapproaved').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/fileservices/fileorder/Issued'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		
		
		$('#filereject').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/fileservices/fileorder/Canceled'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		
		
		$('#imeiapproave').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/imeirequest/fileorder/Issued'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		
		$('#imeipending').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/imeirequest/fileorder/Pending'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		
		$('#imeireject').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/imeirequest/fileorder/Canceled'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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


		$('#imeiverify').dataTable
		({			  
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('member/imeirequest/fileorder/Verified'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
		      'aLengthMenu': [25, 50, 100, 200, 500, 1000],
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
		
		 
   
		
		$("#add_more").click(function(){
			var len = $("input:file").length;
			len = parseInt(len);
			$("#add_file").append('<div id="file_'+len+'" ><input type="file" name="FileName['+len+']" ></div>');
			return false;
		});
		
		$("#remove").click(function(){
			var len = $("input:file").length;
			len = parseInt(len);
			if(len > 1)
			{
				$("#file_"+(len-1)).remove();
			}
			return false;
		});
        </script>
</body>

 
        
</html>
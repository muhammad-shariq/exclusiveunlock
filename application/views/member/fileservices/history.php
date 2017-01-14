<div class="breadcrum-head">
    <div class="row">
        <div class="col-lg-6">
            <ol class="breadcrumb">
                <li>You Are Here</li>
                <li><a href="<?php echo site_url('member/dashboard'); ?>">Home</a></li>
                <li><a href="<?php echo site_url('member/fileservices'); ?>">File Service</a></li>
                <li class="active">Order Hostory</li>
            </ol>
        </div>
        <div class="col-lg-6"></div>
    </div>
</div>

<div class="dashboard">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>

<div class="row">
    <div class="col-lg-12">
        <div class="order-history">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#imeiorders">Approaved</a></li>
                <li class=""><a data-toggle="tab" href="#pendinginvoices">Pending</a></li>
                <li class=""><a data-toggle="tab" href="#latestnews">Canceled</a></li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
            <div id="imeiorders" class="tab-pane fade active in">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="fileapproaved">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IMEI</th>
                            <th>Method</th>
                            <th>Email</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
            <div id="pendinginvoices" class="tab-pane fade">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="filepending">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IMEI</th>
                            <th>Method</th>
                            <th>Email</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Created date</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="latestnews" class="tab-pane fade">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="filereject">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IMEI</th>
                            <th>Method</th>
                            <th>Email</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Created date</th>
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
    $('#filepending').dataTable
    ({			  
        'bProcessing'    : true,
        'bServerSide'    : true,
        'bAutoWidth'     : false,
        'sPaginationType': 'full_numbers',
        'sAjaxSource'    : '<?php echo site_url('member/fileservices/listener/Pending'); ?>',
        'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
        'aLengthMenu': [25, 50, 100, 200, 500, 1000],
        'iDisplayLength': 100,
        'aaSorting'      : [[0, 'desc']],
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
        'sAjaxSource'    : '<?php echo site_url('member/fileservices/listener/Issued'); ?>',
        'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
        'aLengthMenu': [25, 50, 100, 200, 500, 1000],
        'iDisplayLength': 100,
        'aaSorting'      : [[0, 'desc']],
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
        'sAjaxSource'    : '<?php echo site_url('member/fileservices/listener/Canceled'); ?>',
        'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
        'aLengthMenu': [25, 50, 100, 200, 500, 1000],
        'iDisplayLength': 100,
        'aaSorting'      : [[0, 'desc']],
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
});    
</script>




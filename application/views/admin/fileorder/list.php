<div class="workplace">
    <div class="row-fluid">

        <div class="span12">   
      <?php $this->load->view('admin/includes/message'); ?>
        <div class="head clearfix">
                  <div class="isw-grid"></div>
                  <h1>File Services Order</h1>                       
          </div>
          <?php
              echo form_open('admin/fileorder/bulk',array('method' => 'post','id'=>'form'));
?>
            <div class="block-fluid table-sorting clearfix">
              <div class="block-fluid">                        
                  <div class="row-form clearfix">
                      <div class="span1">IMEI:</div>
                      <div class="span3" id="IMEI"></div>
                      <div class="span1">Services:</div>
                      <div class="span2" id="Services"></div>
                      <div class="span1">Status:</div>
                      <div class="span2" id="Status"></div>
                  </div>                                                                             
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="TableDeferLoading">
                    <thead>
                        <tr>                                        
                            <th width="5%">ID</th>
                            <th width="13%">IMEI</th>
                            <th width="18%">Service</th>
                            <th width="20%">Email</th>
                            <th>Comments</th>
                            <th width="5%">Status</th>
                            <th width="15%">Created Date Time</th>         
                            <th width="10%">Options</th>                                
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>                                        
                            <th>ID</th>
                            <th>IMEI</th>
                            <th>Service</th>
                            <th>Email</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th>Created Date Time</th>      
                            <th>Options</th>                                
                        </tr>
                    </tfoot>                                
                </table>
            </div>
                <button type="button" class="btn" onclick="return bulk_issue();">Bulk Operation On Selected</button>
              <?php echo form_close(); ?>
        </div>                                

    </div>        
    <div class="dr"><span></span></div>                    
     <div class="row-fluid">
        <div class="span3">
          <div class="head clearfix">
              <div class="isw-brush"></div>
              <h1>Options Icons</h1>
          </div>
          <div class="block">
            <ul class="the-icons clearfix">
              <li><i class="isb-edit"></i> Edit Order</li>
              <li><i class="isb-cancel"></i> Cancel Order</li>
              <li><i class="isb-delete"></i> Delete Order</li>
            </ul>
          </div>
        </div>
    </div>   
</div>
<script type="text/javascript" charset="utf-8">

$(document).ready(function()
{
    $('#TableDeferLoading').dataTable
    ({			  
            'bProcessing'    : true,
            'bServerSide'    : true,
            'bAutoWidth'     : false,
            'sPaginationType': 'full_numbers',
            'sAjaxSource'    : '<?php echo site_url('admin/fileorder/listener'); ?>',
            'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 7 ] } ],
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
    })
    .columnFilter({
            aoColumns: [ 
                null,
                { sSelector: "#IMEI", type: "number"},
                { sSelector: "#Services", type: "select", values: <?php echo $service_list; ?>},
                null,
                null,
                { sSelector: "#Status", type: "select", values: ["Pending", "Issued", "Canceled"]},
                null,
                null,
                null
            ]				
    });		
});

function bulk_issue()
{
    if(!confirm('Are you sure to issue code for selected records?'))
    {
        return false;
    }
    var oTable = $('#TableDeferLoading').dataTable();
    var oTT = TableTools.fnGetInstance( 'TableDeferLoading' );
    var aSelectedTrs = oTT.fnGetSelected();
    var arr = new Array();
    var anSelectedData;
    if(aSelectedTrs.length > 0)
    {
        for(var i = 0 ; i < aSelectedTrs.length ; i++)
        {
        anSelectedData = oTable.fnGetData( aSelectedTrs[i] ); 	
        arr[i] = parseInt(anSelectedData[0]);
        }
        
        var form = $('<?php echo str_replace (array("\r\n", "\n", "\r"), '', form_open('admin/fileorder/bulk')); ?>' +
        '<input type="text" name="json" value="' + JSON.stringify(arr) + '" />' +
        '</form>');
        $('body').append(form);
        $(form).submit();
    }
    else
    {
        alert("No record selected.");
    }    
}
</script> 
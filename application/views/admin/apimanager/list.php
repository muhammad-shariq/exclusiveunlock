<div class="workplace">
    <div class="row-fluid">

        <div class="span12">   
      <?php $this->load->view('admin/includes/message'); ?>
        <div class="head clearfix">
                  <div class="isw-grid"></div>
                  <h1>API Manager</h1>    
              </div>
            <div class="block-fluid table-sorting clearfix">
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="TableDeferLoading">
                    <thead>
                        <tr>                                        
                            <th width="5%">ID</th>
                            <th width="13%">Title</th>
                            <th width="24%">Host</th>
                            <th width="12%">Username</th>
                            <th width="8%">Api Type</th>
                            <th width="14%">Updated Date Time</th>
                            <th width="14%">Created Date Time</th>                                        
                            <th width="10%">Options</th>                                
                        </tr>
                    </thead>                                
                </table>
            </div>
          <a href="<?php echo site_url('admin/apimanager/add') ?>"><button class="btn" type="button">Add an api</button></a>
            
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
              <li><i class="isb-cloud"></i> Services List</li>
              <li><i class="isb-edit"></i> Edit Record</li>
              <li><i class="isb-delete"></i> Delete Record</li>
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
		      'sAjaxSource'    : '<?php echo site_url('admin/apimanager/listener'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 7 ] } ], 
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
		});
  });		
			
</script>            
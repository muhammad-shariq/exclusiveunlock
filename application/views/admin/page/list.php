			<div class="workplace">
                <div class="row-fluid">

                    <div class="span12">   
                	<?php $this->load->view('admin/includes/message'); ?>
						<div class="head clearfix">
	                            <div class="isw-grid"></div>
	                            <h1>Pages</h1>      
	                            <ul class="buttons">	                                
	                                <li><a href="<?php echo site_url('admin/page/add'); ?>" class="isw-plus"></a></li>
	                            </ul>                        
	                       </div>
                        <div class="block-fluid table-sorting clearfix">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table" id="TableDeferLoading">
                                <thead>
                                    <tr>                                        
                                        <th width="5%">ID</th>
                                        <th width="20%">Title</th>
                                        <th width="20%">Page Name</th>
                                        <th width="20%">Updated Date Time</th>
                                        <th width="20%">Created Date Time</th>
                                        <th width="8%">Status</th>
                                        <th width="7%">Options</th>                                
                                    </tr>
                                </thead>                                
                            </table>
                        </div>
                    </div>                                

                </div>            

                <div class="dr"><span></span></div>            

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
		      'sAjaxSource'    : '<?php echo site_url('admin/page/listener'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ], 
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
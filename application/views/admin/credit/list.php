			<div class="workplace">
                <div class="row-fluid">

                    <div class="span12">   
                	<?php $this->load->view('admin/includes/message'); ?>
                	<?php
                        	echo form_open('admin/credit/add',array('method' => 'post','id'=>'form'));
					?>    
						<div class="head clearfix">
	                            <div class="isw-grid"></div>
	                            <h1>Credits Management</h1>                       
	                       </div>
                        <div class="block-fluid table-sorting clearfix">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table" id="TableDeferLoading">
                                <thead>
                                    <tr>                                        
                                        <th width="5%">ID</th>
                                        <th width="12%">Transaction Code</th>
                                        <th width="20%">Member</th>                                        
                                        <th>Description</th>
                                        <th width="5%">Amount</th>                                        
                                        <th width="15%">Date Time</th>
                                    </tr>
                                </thead>                                
                            </table>
                        </div>
                         <?php
                          echo form_submit(array('value'=> 'Add Credit','class'=>'btn'));
						  echo form_close();
                        ?>
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
		      'sAjaxSource'    : '<?php echo site_url('admin/credit/listener'); ?>',
              'aaSorting'      : [[0, 'desc']],
		      //'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 5 ] } ], 
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
			        null,null,
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
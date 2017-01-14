
  <style type="text/css">

.cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
* html .cf { zoom: 1; }
*:first-child+html .cf { zoom: 1; }

/**
 * Nestable
 */

.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 50px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
 * Nestable Extras
 */

.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

#nestable-menu { padding: 0; margin: 20px 0; }

#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }

@media only screen and (min-width: 700px) { 

    .dd { float: left; width: 100%; }
    .dd + .dd { margin-left: 2%; }

}

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }
</style>   
			<div class="workplace">
                <div class="row-fluid">

                    <div class="span12">   
                	<?php $this->load->view('admin/includes/message'); ?>
						<div class="head clearfix">
	                            <div class="isw-grid"></div>
	                            <h1>Navigation Menus</h1>      
	                            <ul class="buttons">	                                
	                                <li><a href="<?php echo site_url('admin/menu/add'); ?>" class="isw-plus"></a></li>
	                            </ul>                        
	                       </div>
                        <div class="block-fluid table-sorting clearfix">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table" id="TableDeferLoading">
                                <thead>
                                    <tr>                                        
                                        <th width="5%">ID</th>
                                        <th width="16%">Title</th>
                                        <th width="12%">Url</th>
                                        <th width="12%">SortOrder</th>
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
                <div class="row-fluid">                    
<?php
		foreach ($sorted_list as $list)
		{
?>
                    <div class="span6">
                        <div class="head clearfix">
                            <div class="isw-donw_circle"></div>
                            <h1><?php echo $list['Title']; ?></h1>
                        </div>
                        <div class="block-fluid">
<?php
				$arrHidden = array("MenuID"=>$list['ID']);
				echo form_open('admin/menu/update_order',"",$arrHidden); 
?>			
			 <dir class="cf nestable-lists">
						<input type="hidden" id="json_data_<?php echo $list['ID']; ?>" name="JsonData" value="" >
						<div class="dd" id="nestable_<?php echo $list['ID']; ?>">
							<?php echo makeList($list['children']); //Build Tree		?>							
						</div>
			 </dir>				
						<div>
								<?php echo form_button(array('id'=>'sub','content'=>'Save','class'=>'btn btn-primary','type'=>'submit')); ?>
						</div>
						<?php echo form_close(); ?>									 						
                        </div>
                    </div>

<?php	} ?>                    
               </div>
            </div>
<?php 
     //Make a list from an array 
    function makeList($array) 
    { 
        //Base case: an empty array produces no list 
       if (empty($array)) return '';

        //Recursive Step: make a list with child lists 
        $output = '<ol class="dd-list">'; 
        foreach ($array as $key => $subArray) { 
            $output .= '<li class="dd-item dd3-item" data-id="' . $subArray['ID'] .'">
									<div class="dd-handle dd3-handle" >&nbsp;</div>
									<div class="dd3-content" >' . $subArray['Title'] .'</div>'. makeList($subArray['children']) . '
						</li>'; 
        } 
        $output .= '</ol>'; 
         
        return $output; 
    }	 

?>
<!-- Page end here -->
<script >
<?php if(isset($sorted_list)) {?>
	$(document).ready(function()
	{
	    var updateOutput = function(e)
	    {		
	        var list   = e.length ? e : $(e.target),
	            output = list.data('output');
	        if (window.JSON) {
	            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
	        } else {
	            output.val('JSON browser support required for this demo.');
	        }
	    };
	<?php
		foreach ($sorted_list as $list)
	    {			
	?>
	    // activate Nestable for list 1
	    $('#nestable_<?php echo $list['ID']; ?>').nestable({
	        group: 1
	    })
	    .on('change', updateOutput);
	
	    updateOutput($('#nestable_<?php echo $list['ID']; ?>').data('output', $('#json_data_<?php echo $list['ID']; ?>')));
	    
	<?php } 	?>
		$('#nestable3').nestable();
	});
<?php } 	?>
</script>            
<script type="text/javascript" charset="utf-8">

$(document).ready(function()
  {
	    $('#TableDeferLoading').dataTable
		({
		      'bProcessing'    : true,
		      'bServerSide'    : true,
		      'bAutoWidth'     : false,
		      'sPaginationType': 'full_numbers',
		      'sAjaxSource'    : '<?php echo site_url('admin/menu/listener'); ?>',
		      'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 7 ] } ], 
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
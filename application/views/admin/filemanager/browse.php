            <div class="workplace">

                <div class="page-header">
                    <h1>File Manager <small>And Uploader</small></h1>
                </div>                  

                <div class="row-fluid">
                    <div class="span12">
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>File manager</h1>      
                        </div>
                        <div class="block-fluid">
                            <div id="filemanager"></div>
                        </div>                    
                    </div>
                </div>
            </div>
		<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
	    // Helper function to get parameters from the query string.
	function getUrlParam(paramName) {
		var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
		var match = window.location.search.match(reParam) ;
    
		return (match && match.length > 1) ? match[1] : '' ;
	}
	
	$().ready(function() {				
		var funcNum = getUrlParam('CKEditorFuncNum');
		var elf = $('#filemanager').elfinder({
			url : '<?php echo site_url('admin/filemanager/elfinder_init'); ?>',
			commandsOptions : {
				  getfile : {
					onlyURL : true,
					multiple : false,
					folders : false
				  }
			},
			getFileCallback : function(url) {						
				window.opener.CKEDITOR.tools.callFunction(funcNum, url);
				window.close();					
			}
		}).elfinder('instance');
	});
</script>  

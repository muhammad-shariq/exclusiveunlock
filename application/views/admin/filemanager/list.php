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

    <div class="dr"><span></span></div>   
    <div class="row-fluid">

        <div class="span12">                    
            <div class="head clearfix">
                <div class="isw-download"></div>
                <h1>File uploader</h1>      
            </div>
            <div class="block-fluid">
                <div id="uploader_flash"><center>Browser don't support a HTML5</center></div>
            </div>
        </div>                                                                  

    </div>            
</div>
<script>
         //File manager
         
     if($("#filemanager").length > 0){
         $("#filemanager").elfinder({url : '<?php echo site_url('admin/filemanager/elfinder_init'); ?>'}).elfinder('instance');
     }
   
    // Setup flash version
    $("#uploader_flash").pluploadQueue({
        // General settings
        runtimes : 'html5,html4,flash',
        url : '<?php echo site_url("admin/filemanager/plupload"); ?>',
        max_file_size : '10mb',
        chunk_size : '1mb',
        unique_names : true,
 
        // Resize images on clientside if we can
        resize : {width : 320, height : 240, quality : 90},
 
        // Specify what files to browse for
        filters : [
                   {title : "Document files", extensions : "doc,docx,txt,xls,ppt,pdf"},
                   {title : "Image files", extensions : "jpg,jpeg,gif,png"},
                   {title : "Video files", extensions : "avi,wmv,qt"},
                   {title : "Audio files", extensions : "mp3,flac"},
                   {title : "Zip files", extensions : "zip"}       
        ],
 
        // Flash settings			        
		flash_swf_url : '<?php echo $this->config->item('assets_url');?>js/plugins/plupload/plupload.flash.swf'
    });
	
	</script>  

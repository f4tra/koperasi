	<!-- PAGE table -->
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i><?php //echo $this->uri->segment(2); ?></h4> 					
				</div>
				<div class="box-body">
					<form enctype="multipart/form-data" action="<?php echo site_url('apps/itemprice/action_upload/');?>/<?php echo $idx;?>" class="dropzone" id="drop" method="POST"/>
						<div class="fallback">
						<?php echo $idx;?>
							<input name="userfile" type="file" id="userfile" multiple="" />
						</div>
						<!-- <div class="dz-preview dz-file-preview">
							<div class="dz-details">
								<div class="dz-filename">
									<span data-dz-name></span>
								</div>
								<div class="dz-size" data-dz-size></div>
								<img data-dz-thumbnail />
							</div>
							<div class="progress progress-sm progress-striped active">
							<div class="progress-bar progress-bar-success" data-dz-uploadprogress></div>
							</div>
							<div class="dz-success-mark"><span></span></div>
							<div class="dz-error-mark"><span></span></div>
							<div class="dz-error-message"><span data-dz-errormessage></span></div>
						</div> -->
					</form>
				</div>
				
			</div>
			<!-- /BOX -->
		</div>
	</div>
	
	<!-- /PAGE table -->
		
	
	</div>
</div>
<script type="text/javascript">
function upload(){
	try {
        $("#drop").dropzone({
        	init: function() {
       			thisDropzone = this;
        		$.get("<?php echo site_url('apps/itemprice/viewimage')?>", function(data) {
 					$.each(data, function(key,value){
                		var mockFile = { name: value.name,size: value.size};
                		thisDropzone.options.addedfile.call(thisDropzone, mockFile); 
                		thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "<?php echo base_url('/uploader/product/');?>/"+value.name);
            		});
             	});
    		},
            paramName: "userfile",
            addRemoveLinks: true,
            removedfile: function(file) {
    			var name = file.name;        
            	alert(name)
 				$.ajax({
        			type: 'POST',
        			url: "<?php echo site_url('apps/itemprice/remove_file')?>",
        			data: "data_id="+name,
    			});
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
          	 },
            dictResponseError: "Error while uploading file!",
            //previewTemplate: '<div class="dz-preview dz-file-preview">\n  <div class="dz-details">\n    <div class="dz-filename"><span data-dz-name></span></div>\n    <div class="dz-size" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class="progress progress-sm progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div>\n  <div class="dz-success-mark"><span></span></div>\n  <div class="dz-error-mark"><span></span></div>\n  <div class="dz-error-message"><span data-dz-errormessage></span></div>\n</div>'
        })
    } catch(e) {
            alert("Dropzone.js does not support older browsers!")
    }
}
upload();

</script>
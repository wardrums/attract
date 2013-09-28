<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<script>
	$(document).ready(function() {
		
		var file_id = '';
		
		$(document).on("click", ".file_link", function() {
			class_id = $(this).parent().parent().attr('class');
			// we split the file id that and get the secon item of the array (IE the actual ID)
			file_id = class_id.split("_")[1];
			console.log(file_id);
		});
		
		
    	
    	$(document).on("click", ".browser_link", function() {
			if ($(this).parent().hasClass('dir')) {
	       		// we load into the body the link of the folder we clicked on
	       		$('.modal-body').load($(this).attr('href'));
	       		//alert(path);
	       	} else if ($(this).parent().hasClass('file')) {
	       		/*
	       		var path = $(this).attr('href');
	       		var path_split = path.split("/");
	       		var file = path_split[path_split.length - 1];
	       		*/
	       		
	       		var file_path = $(this).parent().attr('path');
	       		var file = $(this).html();
	       		
	       		var file_split = file.split(".");
	       		var file_extension = file_split[file_split.length - 1];
	       		
	       		if (file_extension == 'blend') {
	       			$('li').removeClass('active');
	       			$(this).parent().addClass('active');
	       			$('#new_file_path').val(file_path);
	       			
	       		}
	       		
	       		//console.log(file_extension);
	       		
	       	}
	    	// we prevent the browser to load the actual page we link to 
	    	return false;	
		});
		
		$(document).on("click", "#assign_file", function() {
			var new_path = $('#new_file_path').val();
			//console.log(new_path);
			var properties = {};
			properties['file_path'] = new_path;
						
			$.post("/files/edit/" + file_id, { properties: properties })
				.done(function(data) {
					$('#fileBrowser').modal('hide');
			});
		});
    });
</script>

<!-- Modal -->
<div id="fileBrowser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="fileBrowserLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="fileBrowserLabel">File Browser</h3>
	</div>
	<div class="modal-body">
		<p>File list loads here</p>
	</div>
	<div class="modal-footer">
		<input type="hidden" id="new_file_path" name="file_path" value="" />
		<input type="hidden" id="file_id" name="file_path" value="" />
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button id="assign_file" class="btn btn-primary">Assign File</button>
	</div>
</div>


<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="files">
	<thead>
		<tr>
			<th>Shot</th>
			<th>File path</th>
			<th>File settings</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($files as $file): ?>
    	<tr class="file_<?php echo $file['file_id'] ?>">
    		<td><a href="/scenes/view/<?php echo $file['shot_id'] ?>"><?php echo $file['shot_name'] ?></a></td>
    		<td><a class="file_link" data-target="#fileBrowser" href="/browser/mate/" role="button" data-toggle="modal"><?php echo $file['file_path'] ?></a></td>
    		<td><?php echo $file['file_settings'] ?></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Shot</th>
			<th>File path</th>
			<th>File settings</th>
		</tr>
	</tfoot>
</table>


</div><!--/span-->




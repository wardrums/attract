<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<?php 
if ($this->session->flashdata('message') != '')
	{
	    $flahsdata = $this->session->flashdata('message'); 
	}
?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<?php if (isset($flahsdata)):?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo $flahsdata ?>
</div>
<?php endif ?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>Sequence name</th>
			<th>Sequence description</th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($sequences as $sequence): ?>
    	<tr class="sequence_<?php echo $sequence['sequence_id'] ?>">
    		<td><a href="#" sequence="/sequences/edit/<?php echo $sequence['sequence_id'] ?>" data-toggle="modal"><?php echo $sequence['sequence_name'] ?></a></td>
    		<td><?php echo $sequence['sequence_description'] ?></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Sequence name</th>
			<th>Sequence description</th>
		</tr>
	</tfoot>
</table>

<a class="btn btn-large btn-block" href="/sequences/create">Add sequence</a>
</div><!--/span-->

<script>
$(document).ready(function() {
	// Support for AJAX loaded modal window.
	// Focuses on first input textbox after it loads the window.
	$('[data-toggle="modal"]').click(function(e) {
		e.preventDefault();
		var url = $(this).attr('sequence');
		if (url.indexOf('#') == 0) {
			$(url).modal('open');
		} else {
			$.get(url, function(data) {
				$('<div class="modal hide fade">' + data + '</div>').modal();
			}).success(function() { $('input:text:visible:first').focus(); });
		}
	});
});
</script>


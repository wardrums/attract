<?php 
$span_value = ($use_sidebar == TRUE ? "col-md-9" : "col-md-12"); 
if ($this->session->flashdata('message') != '')
{
	$flahsdata = $this->session->flashdata('message'); 
}

?>
<div class="<?php echo $span_value ?>">
	
	<h2>Shot <?php echo $shot['shot_name'] ?></h2>
	<p><?php echo $shot['shot_description']; ?></p>
	
	<?php if (isset($flahsdata)):?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $flahsdata ?>
	</div>
	<?php endif ?>
		
	<?php if($previews): ?>
		<?php foreach ($previews as $preview): ?>
			<?php if($preview['is_current'] == TRUE): ?>
				<img src="/uploads/thumbnails/400_<?php echo $preview['attachment_path'] ?>" />
				<?php echo anchor('/shots/delete_preview/' . $preview['attachment_id'], 'Delete') ?>
			<?php else: ?>
				<img src="/uploads/thumbnails/200_<?php echo $preview['attachment_path'] ?>" />
				<?php echo anchor('/shots/delete_preview/' . $preview['attachment_id'], 'Delete') ?>
			<?php endif ?>
			
		<?php endforeach ?>
	<?php else: ?>
		<p>NO PREVIEW at the moment</p>
	<?php endif ?>
	
	<?php echo form_open_multipart("shots/post_add_preview"); ?>
	<form class="form">    
		<?php echo form_hidden('shot_id', $shot['shot_id']);?>                
	    <input type="file" name="userfile" size="20" />
	
		<button class="btn btn-default">Add Preview</button>
	</form>
	<?php echo form_close();?>
	
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li><a href="/shots/edit/<?php echo $shot['shot_id'] ?>">Edit</a></li>
			<li class="active"><a href="#">Comments</a></li>
		</ul>
	</div>
	

	<?php foreach ($comments as $comment): ?>
    <div class="media">
	    <a class="pull-left" href="#">
	    	<img class="media-object" src="<?php print_r ($comment['gravatar']); ?>">
	    </a>
	    <div class="media-body">
	    	<h4 class="media-heading"><?php echo $comment['first_name'] ?></h4>
	    	<h5 class="media-heading"><?php echo $comment['comment_creation_date'] ?></h5>
	    	<div class="thread_comment_body"><?php echo $comment['comment_body'] ?></div>
	    	<?php if($comment['attachment_path']): ?>
	    		<a href="/uploads/originals/<?php echo $comment['attachment_path'] ?>">
	    			<img src="/uploads/thumbnails/200_<?php echo $comment['attachment_path'] ?>" />
	    		</a>
	    	<?php endif ?>
	    	<a href="/comments/delete/<?php echo $comment['comment_id'] ?>">Delete</a>
	    	
	    </div>
    </div>
	<?php endforeach ?>
	
	<div class="media">
	    <span class="pull-left">
	    	<img class="media-object" src="<?php echo $gravatar ?>">
	    </span>
	    <?php echo $error;?>
	    <div class="media-body">
	    	<?php echo form_open_multipart("shots/post_add_comment"); ?>
	    	
	    	<form class="form">    
	    		<?php echo form_hidden('shot_id', $shot['shot_id']);?>                
			    <textarea data-provide="markdown" id="comment_body" name="comment_body" required=""></textarea>
			    <input type="file" name="userfile" size="20" />
			
				<button class="btn btn-default">Add Comment</button>
			</form>
	    	<?php echo form_close();?>
	    	
	    </div>
    </div>
</div>

<script>
	//$('.thread_comment_body').html(markdown.toHTML($(this).html()));
	$( '.thread_comment_body' ).each(function() {
		//$(this).html('a');
		var test = markdown.toHTML($(this).html());
		$(this).html(test);
	});
	//console.log($('.thread_comment_body').html());
	console.log(markdown.toHTML('#11'));
	$("#comment_body").markdown({autofocus:false,savable:false});

</script>


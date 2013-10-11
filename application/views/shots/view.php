<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>
<div class="<?php echo $span_value ?>">
	<h2>Shot <?php echo $shot['shot_name'] ?></h2>
	<p><?php echo $shot['shot_description']; ?></p>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li><a href="/shots/edit/<?php echo $shot['shot_id'] ?>">Edit</a></li>
			<li class="active"><a href="#">Comments</a></li>
		</ul>
	</div>
	

	<?php foreach ($comments as $comment): ?>
    <div class="media">
	    <a class="pull-left" href="#">
	    	<img class="media-object" src="http://placehold.it/60x60">
	    </a>
	    <div class="media-body">
	    	<h4 class="media-heading"><?php echo $comment['first_name'] ?></h4>
	    	<h5 class="media-heading"><?php echo $comment['comment_creation_date'] ?></h5>
	    	<?php echo $comment['comment_body'] ?>
	    	<a href="/comments/delete/<?php echo $comment['comment_id'] ?>">Delete</a>
	    	
	    </div>
    </div>
	<?php endforeach ?>
	
	<div class="media">
	    <a class="pull-left" href="#">
	    	<img class="media-object" src="http://placehold.it/60x60">
	    </a>
	    <div class="media-body">
	    	<?php echo form_open("comments/create"); ?>
	    	
	    	<form class="form">    
	    		<?php echo form_hidden('shot_id', $shot['shot_id']);?>                
			    <textarea id="comment_body" name="comment_body"></textarea>
			
				<button class="btn">Add Comment</button>
			</form>
	    	<?php echo form_close();?>
	    </div>
    </div>
</div>


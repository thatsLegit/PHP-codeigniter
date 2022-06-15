<!-- un bouton form va envoyer des données via le submit vers
le controleur class post, method delete(). Ce controleur
va recevoir faire appel au post_model pour générer une requête
DELETE. Cela va ensuite être retourné au controleur qui va
faire un redirect sur la vue posts/ -->

<h2> <?php echo $post['title']; ?> </h2>
<!-- We are getting $post['title'] form the controller -->
<small class='post-date'>Posted on: <?php echo $post['created_at'];?> </small><br>
<img class="post-thumb" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
<div class="post-body">
    <?php echo $post['body']; ?>  
</div>

<?php if($this->session->userdata('user_id') == $post['user_id']):?>
	<hr>
	<a style= "margin-right: 10px" class="btn btn-default pull-left" href="<?php echo base_url(); ?>
	posts/edit/<?php echo $post['slug']; ?>">Edit</a>
	<?php echo form_open('/posts/delete/'.$post['id']); ?>
		<input type="submit" value="Delete" class="btn btn-danger">
	</form>
<?php endif; ?>

<hr>
<h3>Comments</h3>
<?php if ($comments): ?>
    <div class="group-form">
    <?php foreach($comments as $comment) : ?>
    <div class="well">
        <h4> <?php echo $comment['body'] ?> </h4>
        <strong><?php echo $comment['created_at'] ?> by <?php echo $comment['name'] ?>
        </strong>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
    <p> No comments to display </p>
<?php endif; ?>


<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$post['id']); ?>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea name="body" class="form-control"></textarea>
	</div>
    <!-- If the form validation doesn't pass, we wanna reload the same view -->
	<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
	<button class="btn btn-primary" type="submit">Submit</button>
</form>
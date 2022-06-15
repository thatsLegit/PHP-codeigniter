<h2><?=$title; ?></h2><br>

<?php echo validation_errors(); ?>
<!-- On va envoyer des données via le submit vers
le controleur class post, method create(). Ce controleur
va recevoir faire appel au post_model pour générer une requête
DELETE. Cela va ensuite être retourné au controleur qui va
faire un redirect sur la vue posts/ -->
<?php echo form_open('posts/update'); ?>
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Title"
    value="<?php echo $post['title']; ?>">
  </div>
  <div class="form-group">
    <label>Text</label>
    <textarea class="form-control" name="body" placeholder="Write your post">
    <?php echo $post['body']; ?>
    </textarea>
  </div>
  <div class="form-group">
	  <label>Category</label>
    <select name="category_id" class="form-control">
      <?php foreach ($categories as $category) : ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
      <?php endforeach; ?>    
    </select>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
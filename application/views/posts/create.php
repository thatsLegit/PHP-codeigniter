<h2><?=$title; ?></h2><br>

<?php echo validation_errors(); ?>

<!-- On va envoyer des données via le submit vers
le controleur class post, method create(). Ce controleur
va recevoir faire appel au post_model pour générer une requête
DELETE. Cela va ensuite être retourné au controleur qui va
faire un redirect sur la vue posts/ -->

<?php echo form_open_multipart('posts/create'); ?>
<!-- multipart for images -->
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
  </div>
  <div class="form-group">
    <label>Text</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body">
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
  <div class="form-group">
    <label>Upload image</label>
    <!-- Has to be called userfile -->
    <input type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
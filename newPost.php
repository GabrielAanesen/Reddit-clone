<?php require __DIR__.'/views/header.php';  ?>

<form action="app/auth/memes.php" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Title</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="title" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Link</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="link" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description of your post</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit Post</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>

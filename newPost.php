<?php
require __DIR__.'/views/header.php';
  ?>
  <div class="col-m-3 newPost">
  <form action="app/auth/memes.php" method="post">
    <div class="form-group">
      <label for="headline">Headline</label>
      <input  type="text" name="headline" placeholder="" required>
      <br>
      <label for="link">link</label>
      <input  type="text" name="link" placeholder="" required>
    </div>
  <button type="submit" class="btn btn-primary">Submit Post</button>
</form>
</div>
<?php

require __DIR__.'/views/footer.php'; ?>

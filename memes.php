<?php
require __DIR__.'/views/header.php';

$statement = $pdo->query('SELECT * FROM POSTS');
$allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($allPosts as $key => $value) {
    ?><div class="post"> <img class="postImg" src=" <?php echo $value['link']; ?> " alt=""><?php
    ?><h2><?php echo $value['headline'];?> </h2>
    <form class="" action="comments.php" method="GET">
      <a href="comments.php"> <button type="submit" name="hej" value="<?php echo $value['post_id'] ?>" >Comment</button> </a>
    </form></div>
    <?php
}
if (isset($_SESSION['user'])) {
  ?>
  <div class="col-m-3 newPost">
  <form action="app/auth/memes.php" method="post">
    <div class="form-group">
      <label for="headline">Headline</label>
      <input  type="text" name="headline" placeholder="" required>
      <label for="link">link</label>
      <input  type="text" name="link" placeholder="" required>
    </div>
  <button type="submit" class="btn btn-primary">Submit Post</button>
</form>
</div>
<?php
}
require __DIR__.'/views/footer.php'; ?>

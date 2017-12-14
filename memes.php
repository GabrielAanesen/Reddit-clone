<?php
require __DIR__.'/views/header.php';

$statement = $pdo->query('SELECT * FROM POSTS');
$allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($allPosts as $key => $value) {
  if (isset($_SESSION['user']['ID'])) {
    if ($value['user_id'] === $_SESSION['user']['ID']) {
      ?><div class="post"> <img class="postImg" src=" <?php echo $value['link']; ?> " alt="">
        <H2><?php echo $value['headline'];?> </H2>
        <p><?php echo $_SESSION['user']['USERNAME'];?> </p>
        <form class="" action="app/auth/memes.php" method="post">
          <div class="col-xs-4">
            <label for="edit"> <p>Edit Title</p></label>
            <input type="text" name="edit" value="">
            <input type="hidden" name="postId" value=" <?php echo $value['post_id'] ?>">
            <button class ="btn btn-outline-secondary" type="submit" name="button">edit</button>
          </div>
          </form>
        <form class="" action="app/auth/memes.php" method="post">
          <input type="hidden" name="postId" value=" <?php echo $value['post_id'] ?>">
          <button class ="btn btn-outline-secondary" name="delete" type="submit">delete post</button>
        </form>
      </div>
      <?php
    } else {
      ?><div class="post"> <img class="postImg" src=" <?php echo $value['link']; ?> " alt=""><?php
      ?><h2><?php echo $value['headline'];?> </h2></div><?php
    }
  } else {
    ?><div class="post"> <img class="postImg" src=" <?php echo $value['link']; ?> " alt=""><?php
    ?><h2><?php echo $value['headline'];?> </h2></div><?php
  }
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

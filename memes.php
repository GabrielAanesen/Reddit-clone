<?php
require __DIR__.'/views/header.php';
if (isset($_SESSION['user'])) {
  ?>
  <div class="col-md-3 mx-auto">
    <h3>Make a new post!</h3>
    <a href="newPost.php"> <button type="submit" class="btn btn-primary">New post</button></a>
  </div>
<?php
}
$statement = $pdo->query('SELECT * FROM POSTS');
$allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($allPosts as $key => $value) {
    ?><div class="post"> <img class="allPostImg" src=" <?php echo $value['link']; ?> " alt=""><?php
    ?><h2><?php echo $value['headline'];?> </h2>
    <form class="" action="comments.php" method="GET">
      <a href="comments.php"> <button type="submit" name="hej" value="<?php echo $value['post_id'] ?>" >Comment</button> </a>
    </form></div>
    <?php
}

require __DIR__.'/views/footer.php'; ?>

<?php
require __DIR__.'/views/header.php';
$postId = $_GET['id'];

$statement = $pdo->query("SELECT * FROM POSTS WHERE post_id = '$postId' ");
$post = $statement->fetch(PDO::FETCH_ASSOC);
if ($post['user_id'] === $_SESSION['user']['ID']) {
  ?>
  <div class="form-group">
  <form class="" action="app/auth/editPost.php" method="post">
    <label for="edit"> <p>Edit Title</p></label>
    <input class="form-control" type="text" name="edit">
    <input type="hidden" name="postId" value=" <?php echo $post['post_id'] ?>">
    <button class ="btn btn-outline-secondary" type="submit" name="button">edit</button>
  </form>
</div>
  <div class="form-group">
   <form class="" action="app/auth/editPost.php" method="post">
      <input type="hidden" name="postId" value=" <?php echo $post['post_id'] ?>">
      <button class="btn btn-outline-dark" onclick="return confirm('Are you sure you want to delete the post?')" name="delete" type="submit">delete post</button>
  </form>
</div>

  <?php
}

require __DIR__.'/views/footer.php'; ?>

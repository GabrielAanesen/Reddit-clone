<?php
require __DIR__.'/views/header.php';
$postId = $_GET['id'];

$statement = $pdo->query("SELECT * FROM POSTS WHERE post_id = '$postId' ");
$post = $statement->fetch(PDO::FETCH_ASSOC);
if ($post['user_id'] === $_SESSION['user']['ID']) {
  ?>
<form class="" action="app/auth/editPost.php" method="post">
  <div class="form-group">
    <label for="editTitle"> <p>Title</p></label>
    <input class="form-control" type="text" name="editTitle" value="<?php echo $post['title'] ?>">
    <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
  </div>
  <div class="form-group">
    <label for="editDesc"> <p>Description</p></label>
    <input class="form-control" type="text" name="editDesc" value="<?php echo $post['description'] ?>">
    <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
  </div>
  <button class ="btn btn-primary" type="submit" name="button">edit</button>
</form>
<div class="form-group mt-5">
  <form class="" action="app/auth/editPost.php" method="post">
    <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
    <button class="btn btn-outline-dark" onclick="return confirm('Are you sure you want to delete the post?')" name="delete" type="submit">delete post</button>
  </form>
</div>

  <?php
}

require __DIR__.'/views/footer.php'; ?>

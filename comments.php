<?php
require __DIR__.'/views/header.php';
$postId = $_GET['id'];
$statement = $pdo->query("SELECT * FROM POSTS WHERE post_id = '$postId' ");
$commentTable = $pdo->query("SELECT USERNAME, comment, comment_date FROM USERS INNER JOIN COMMENTS ON USERS.ID = COMMENTS.user_id WHERE post_id = '$postId'; ");
$comment = $commentTable->fetchAll(PDO::FETCH_ASSOC);
$post = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class="col-xs-4">
  <img class="postImg" src=" <?php echo $post['link']; ?> ">
  <H2><?php echo $post['headline'];?> </H2>
<?php
 foreach ($comment as $key => $value) {
   echo $value['USERNAME'].": ".$value['comment'].$value['comment_date']."<br>";
 }
?> </div> <?php
 if (isset($_SESSION['user']['ID'])) { ?>
      <form class="" action="app/auth/comments.php" method="post">
        <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
        <textarea  type="text" name="comment" value=""> </textarea>
        <button class ="btn btn-outline-secondary" type="submit" name="button">Post comment</button>
      </form>
<?php
 if ($post['user_id'] === $_SESSION['user']['ID']) {
   ?>
   <a href="editPost.php?id= <?php echo $postId ?> "> <button class="btn btn-outline-secondary" type="submit" name="id" value="<?php echo $value['post_id'] ?>" >EDIT</button> </a>
   <?php
 }
}
require __DIR__.'/views/footer.php'; ?>

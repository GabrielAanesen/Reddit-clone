<?php
require __DIR__.'/views/header.php';
$postId = intval($_GET['hej']);
$statement = $pdo->query("SELECT * FROM POSTS WHERE post_id = '$postId' ");
$commentTable = $pdo->query("SELECT USERNAME, comment FROM USERS INNER JOIN COMMENTS ON USERS.ID = COMMENTS.user_id WHERE post_id = '$postId';
 ");
$comment = $commentTable->fetchAll(PDO::FETCH_ASSOC);
$post = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class="col-xs-4">
<img class="postImg" src=" <?php echo $post['link']; ?> " alt="">
 <H2><?php echo $post['headline'];?> </H2>
 <?php
 foreach ($comment as $key => $value) {
   echo $value['USERNAME'].": ".$value['comment']."<br>";
 }
 if (isset($_SESSION['user']['ID'])) {
   ?>

   <form class="" action="app/auth/comments.php" method="post">
     <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
     <textarea  type="text" name="comment" value=""> </textarea>
     <button class ="btn btn-outline-secondary" type="submit" name="button">Post comment</button>
   </form>
 </div>

<?php
 if ($post['user_id'] === $_SESSION['user']['ID']) {
   ?>
   <form class="" action="app/auth/memes.php" method="post">
     <div class="col-xs-4">
       <label for="edit"> <p>Edit Title</p></label>
       <input type="text" name="edit" value="">
       <input type="hidden" name="postId" value=" <?php echo $post['post_id'] ?>">
       <button class ="btn btn-outline-secondary" type="submit" name="button">edit</button>
     </div>
     </form>
   <form class="" action="app/auth/memes.php" method="post">
     <input type="hidden" name="postId" value=" <?php echo $post['post_id'] ?>">
     <button class ="btn btn-outline-secondary" name="delete" type="submit">delete post</button>
   </form>
   <?php
 }
}
require __DIR__.'/views/footer.php'; ?>

<?php
require __DIR__.'/views/header.php';
$postId = $_GET['id'];
$statement = $pdo->query("SELECT * FROM POSTS WHERE post_id = '$postId' ");
$commentTable = $pdo->query("SELECT USERNAME, IMAGE , comment, comment_date FROM USERS INNER JOIN COMMENTS ON USERS.ID = COMMENTS.user_id WHERE post_id = '$postId' ORDER BY comment_id DESC");
$comment = $commentTable->fetchAll(PDO::FETCH_ASSOC);
$post = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class="mx-auto col-4">
<div class="card" style="width: 20rem;">
  <div class="card-body">
    <h4 class="card-title"><?php echo $post['title'];?></h4>
    <hr>
    <p class="card-text"><?php echo $post['description'] ?></p>
    <hr>
    <a href=" <?php echo $post['link']; ?> "> <?php echo $post['link']; ?> <a/>
  <?php  if (isset($_SESSION['user'])) {
    if ($post['user_id'] === $_SESSION['user']['ID']) { ?>
        <a href="editPost.php?id= <?php echo $postId ?> "> <button class="btn btn-outline-secondary" type="submit" name="id" value="<?php echo $post['post_id'] ?>" >EDIT</button> </a>
      <?php
    }
  } ?>
  </div>
</div>
<div class="detailBox">
  <div class="titleBox">
    <label>Comments</label>
  </div>
  <div class="commentBox">
    <p class="taskDescription">Remember to read our <a href="#">rules</a> before posting and always be civil!</p>
  </div>
  <div class="actionBox">
    <ul class="commentList">
<?php foreach ($comment as $key => $value) { ?>
      <li>
        <p> <?php echo $value['USERNAME']; ?></p>
        <div class="commenterImage">
          <img src="<?php
          if ($value['IMAGE']){
            echo "images/".$value['IMAGE'];
          } else {
            echo "https://s3.amazonaws.com/wll-community-production/images/no-avatar.png";
          } ?>" />
        </div>
        <div class="commentText">
          <p class=""><?php echo $value['comment'] ?></p> <span class="date sub-text"> <?php echo $value['comment_date'] ?></span>
        </div>
      </li>
      <?php
    }
    ?>
  </ul>
<?php  if (isset($_SESSION['user'])) { ?>
  <form class="" action="app/auth/comments.php" method="post">
    <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
    <textarea  type="text" name="comment" value=""> </textarea>
    <button class ="btn btn-outline-secondary" type="submit" name="button">Post comment</button>
  </form>
<?php } ?>
  </div>
</div>

<?php if (!isset($_SESSION['user'])){
?><h3>Want to comment?</h3> <?php
?><a href="register.php"> <button class="btn btn-outline-secondary" type="button" name="button">Register!</button> </a><?php
  }
?></div><?php
require __DIR__.'/views/footer.php'; ?>

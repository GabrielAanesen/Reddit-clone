<?php
require __DIR__.'/views/header.php';
$postId = $_GET['id'];
$statement = $pdo->query("SELECT * FROM POSTS
                          WHERE post_id = '$postId'");

$commentTable = $pdo->prepare("SELECT USERNAME, IMAGE, comment, comment_date, comment_id, USERS.ID
                             FROM COMMENTS
                             INNER JOIN USERS
                             ON COMMENTS.user_id = USERS.ID
                             WHERE post_id = :postId
                             ORDER BY comment_id DESC");

$commentTable->bindParam(':postId', $postId, PDO::PARAM_INT);
$commentTable->execute();
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
    </div>
  </div>
  <?php  if (isset($_SESSION['user'])) {
            if ($post['user_id'] === $_SESSION['user']['ID']) { ?>
              <div class="mx-auto">
                <a href="editPost.php?id=<?php echo $postId ?> "><button class="btn btn-outline-secondary" type="submit" name="id" value="<?php echo $post['post_id'] ?>" >EDIT</button></a>
              </div>
      <?php
    }
  } ?>
<div class="detailBox">
  <div class="titleBox">
    <label>Comments</label>
  </div>
  <div class="commentBox">
    <p class="taskDescription">Remember to read our <a href="#">rules</a> before posting and always be civil!</p>
  </div>
  <div class="actionBox">
    <ul class="commentList">
<?php foreach ($comment as $key => $allComments) { ?>
      <li>
      <a href="viewProfile.php?id=<?php echo $value['ID'] ?>"><p><?php echo $allComments['USERNAME']; ?></p></a>
        <div class="commenterImage">
          <img src="<?php
          if ($allComments['IMAGE']){
            echo "images/".$allComments['IMAGE'];
          } else {
            echo "https://s3.amazonaws.com/wll-community-production/images/no-avatar.png";
          } ?>" />
        </div>
        <div class="commentText comment">
          <p class=""><?php echo $allComments['comment'] ?></p> <span class="date sub-text"> <?php echo $allComments['comment_date'] ?></span>
        </div>
      </li>
      <?php $allReplys = allReplies($pdo, $allComments['comment_id']);
          foreach ($allReplys as $key => $value){ ?>
          <div class="ml-5 comment">
            <a href="viewProfile.php?id=<?php echo $value['ID'] ?>"><p><?php echo $value['USERNAME']; ?></p></a>
            <div class="commenterImage">
              <img src="<?php
              if ($value['IMAGE']){
                echo "images/".$value['IMAGE'];
              } else {
                echo "https://s3.amazonaws.com/wll-community-production/images/no-avatar.png";
              } ?>" />
            </div>
            <div class="commentText">
              <p class=""><?php echo $value['reply_comment'] ?></p> <span class="date sub-text"> <?php echo $value['reply_date'] ?></span>
            </div>
          </div>
            <?php } ?>
            <div class="mb-2">
              <form action="app/auth/replyComment.php" method="post">
                <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
                <input type="hidden" name="commentId" value="<?php echo $allComments['comment_id'] ?>">
                <input type="text" name="comment" required>
                <button class ="btn btn-outline-secondary" type="submit" name="button">reply to comment</button>
              </form>
            </div>
            <hr>
            <?php } ?>
    </ul>
    <?php  if (isset($_SESSION['user'])) { ?>
      <form class="" action="app/auth/comments.php" method="POST">
        <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>">
        <textarea type="text" name="comment" required></textarea>
        <button class ="btn btn-outline-secondary" type="submit" name="button">Post comment</button>
      </form>
    <?php } ?>
  </div>
</div>

<?php if (!isset($_SESSION['user'])){
    ?><h3>Want to comment?</h3> <?php
    ?><a href="register.php"> <button class="btn btn-outline-secondary" type="button" name="button">Register!</button> </a>
    <?php } ?>
</div>
<?php
require __DIR__.'/views/footer.php'; ?>

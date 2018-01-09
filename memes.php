<?php
require __DIR__.'/views/header.php';
if (isset($_SESSION['user'])) {
  ?>
  <div class="card mx-auto mb-5 text-center" style="width: 15rem;">
  <div class="card-body">
    <h4 class="card-title">Make a new post!</h4>
    <a href="newPost.php"> <button type="submit" class="btn btn-primary">New post</button></a>
  </div>
</div>
<?php
}
if (!isset($_SESSION['user'])) { ?>
  <div class="card mx-auto mb-5 text-center" style="width: 15rem;">
  <div class="card-body">
  <h2>Want to contribute?</h2>
  <a href="register.php"> <button class="btn btn-primary" type="button" name="button">Register!</button> </a>
</div>
</div>
<?php
}
$statement = $pdo->query('SELECT USERNAME, ID, title, link, post_date, post_id from USERS inner join POSTS ON USERS.ID = POSTS.user_id ORDER BY post_id DESC');
$allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($allPosts as $key => $value) { ?>
<div class="card text-center">
  <div class="card-header">
    Posted by: <a href="viewProfile.php?id=<?php echo $value['ID'] ?>"><?php echo $value['USERNAME'] ?></a>
  </div>
  <div class="card-body">
    <div class="">
      <button class="upvote" type="button"  name="upvotes" data-rating="1" value="<?php echo $value['post_id'] ?>">
      <img class="vote voteUp" src="images/upvote.svg">
      </button>
      <?php $voteSum = voteSum($pdo, $value['post_id']) ?>
      <input type="hidden" name="voteTot" value="<?php echo $_POST['voteTot'] ?>">
      <p class="voteSums" name="voteSums"><?php echo $voteSum['voteTot'] ?></p>
      <button type="button" class="downvote" name="downvotes" data-rating="-1" value="<?php echo $value['post_id'] ?>">
      <img class="vote voteDown" src="images/downvote.svg">
      </button>
    </div>
    <h4 class="card-title"><?php echo $value['title'];?></h4>
    <p class="card-text"><a href="<?php echo $value['link']; ?> "><?php echo $value['link']; ?></a></p>
    <form class="" action="comments.php" method="GET">
      <a href="comments.php"><button class="btn btn-primary" type="submit" name="id" value="<?php echo $value['post_id'] ?>">Comment</button></a>
    </form>
  </div>
  <div class="card-footer text-muted">
    <?php echo $value['post_date'] ?>
  </div>
</div>
<div class="margin"></div>

<?php }
require __DIR__.'/views/footer.php'; ?>

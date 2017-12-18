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
if (!isset($_SESSION['user'])) {
  ?><h2>Want to contribute?</h2> <?php
  ?><a href="register.php"> <button class="btn btn-outline-secondary" type="button" name="button">Register!</button> </a><?php
}
$statement = $pdo->query('SELECT USERNAME, headline, link, post_date, post_id from USERS inner join POSTS ON USERS.ID = POSTS.user_id');
$allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($allPosts as $key => $value) {
    ?><div class="post"> <img class="allPostImg" src=" <?php echo $value['link']; ?> "><?php
    ?><h2><?php echo $value['headline'];?> </h2>
    <form class="" action="comments.php" method="GET">
      <a href="comments.php"> <button class="btn btn-outline-secondary" type="submit" name="id" value="<?php echo $value['post_id'] ?>" >Comment</button> </a>
    </form>
    <p>Posted:  <?php echo $value['post_date'] ?> By: <?php echo $value['USERNAME'] ?> </p>
    </div>
    <?php
}

require __DIR__.'/views/footer.php'; ?>

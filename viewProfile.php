<?php
require __DIR__.'/views/header.php';
$userID = $_GET['id'];
$statement = $pdo->query("SELECT * FROM USERS WHERE ID = '$userID'");
$userProfile = $statement->fetch(PDO::FETCH_ASSOC);
$myPosts = $pdo->query("SELECT * FROM POSTS WHERE user_id = '$userID' ");
$myPosts2 = $myPosts->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="row">
<div class="col-md-6">
<div class="card" style="width: 20rem;">
  <?php if (!$userProfile['IMAGE']) {
    ?> <img class="card-img-top" src="https://s3.amazonaws.com/wll-community-production/images/no-avatar.png" alt=""> <?php
  } else {
    ?> <img class="card-img-top" src=" <?php echo "images/".$userProfile['IMAGE']; ?>">
  <?php }  ?>
  <div class="card-body">
    <h4 class="card-title"><?php echo $userProfile['USERNAME'] ?></h4>
    <p class="card-text"><?php echo $userProfile['BIO'];
    if (!$userProfile['BIO']) {
        echo $userProfile['USERNAME']." hasn't written a bio yet.";
    } ?></p>
  </div>
</div>
</div>
<div class="col-md-6">
<div class="activity-feed">
  <h2><?php echo $userProfile['USERNAME'] ?>s posts</h2>
<?php
foreach ($myPosts2 as $key => $value) {
  ?>
  <div class="feed-item">
    <div class="date"> <?php echo $value['post_date'] ?></div>
    <div class="text"><a href="comments.php?id=<?php echo $value['post_id'] ?>"> <h2><?php echo $value['title'];?></a></div>
  </div>

<?php } ?>
</div>
</div>
</div>
<?php

require __DIR__.'/views/footer.php'; ?>

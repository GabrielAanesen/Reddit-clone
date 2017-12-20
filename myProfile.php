<?php require __DIR__.'/views/header.php';

$info = userInfo($pdo);
$id = $_SESSION['user']['ID'];
$myPosts = $pdo->query("SELECT * FROM POSTS WHERE user_id = '$id' ");
$myPosts2 = $myPosts->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
<div class="col-md-6">
<div class="card" style="width: 20rem;">
  <?php if (!$info['IMAGE']) {
    ?> <img class="card-img-top" src="https://s3.amazonaws.com/wll-community-production/images/no-avatar.png" alt=""> <?php
  } else {
    ?> <img class="card-img-top" src=" <?php echo "images/".$info['IMAGE']; ?>">
  <?php }  ?>
  <div class="card-body">
    <h4 class="card-title"><?php echo $info['USERNAME'] ?></h4>
    <p class="card-text"><?php echo $info['BIO'];
    if (!$info['BIO']) {
        echo "Please write something about yourself.";
    } ?></p>
  </div>
</div>
</div>
<div class="col-md-6">

<div class="activity-feed">
  <h2>My posts</h2>
<?php
foreach ($myPosts2 as $key => $value) {
  ?>
  <div class="feed-item">
    <div class="date"> <?php echo $value['post_date'] ?></div>
    <div class="text"><a href="comments.php?id=<?php echo $value['post_id'] ?>"> <h2><?php echo $value['title'];?></a></div>
  </div>

<?php } ?>
<p class="mt-5">
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Edit settings
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <form action="app/auth/myProfile.php" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" placeholder="">
        <small class="form-text text-muted">edit your email.</small>
      </div>
      <button type="submit" class="btn btn-primary">Update email</button>
    </form>
    <form action="app/auth/myProfile.php" method="post">
      <div class="form-group">
        <label for="username">username</label>
        <input class="form-control" type="text" name="username">
        <small class="form-text text-muted">Edit your username.</small>
        <button type="submit" class="btn btn-primary">Update username</button>
      </div>
    </form>
    <form action="app/auth/myProfile.php" method="post">
      <div class="form-group">
        <label for="bio">bio</label>
        <input class="form-control" type="text" name="bio">
        <small class="form-text text-muted">Edit your bio.</small>
        <button type="submit" class="btn btn-primary">Update bio</button>
      </div>
    </form>
    <form action="app/auth/myProfile.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleFormControlFile1">image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" accept=".jpg, .png">
        <button type="submit" class="btn btn-primary">Update image</button>
        <small class="form-text text-muted">Edit your image.</small>
      </div>
    </form>
  </div>
</div>
</div>
</div>

<?php require __DIR__.'/views/footer.php'; ?>

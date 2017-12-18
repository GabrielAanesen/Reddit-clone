<?php require __DIR__.'/views/header.php';

$info = userInfo($pdo);

$id = $_SESSION['user']['ID'];
$myPosts = $pdo->query("SELECT * FROM POSTS WHERE user_id = '$id' ");
$myPosts2 = $myPosts->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</a>
  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Posts</a>
  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
</div>
<div class="tab-content" id="v-pills-tabContent">
  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="col-md- mx-rigth">

    <?php echo $info['BIO'];
    if (!$info['BIO']) {
        echo "Please write something about yourself.";
    } ?>

    <img src=" <?php echo "images/".$info['IMAGE']; ?>" alt="">
    <?php if (!$info['IMAGE']) {
      ?> <img src="https://s3.amazonaws.com/wll-community-production/images/no-avatar.png" alt=""> <?php
      echo "Upload profile picture";
    }
    ?>

    </div>
  </div>
  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
    <div class="post">

      <h2>Your posts</h2>
    </div>
    <?php
    foreach ($myPosts2 as $key => $value) {
      ?><div class="post"> <img class="allPostImg" src=" <?php echo $value['link']; ?> " alt=""><?php
      ?><h2><?php echo $value['headline'];?> </h2><?php
    }
     ?>

   </div>
  </div>
  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

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




<?php require __DIR__.'/views/footer.php'; ?>

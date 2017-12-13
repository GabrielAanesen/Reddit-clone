<?php require __DIR__.'/views/header.php';

//
// $id = $_SESSION['user']['ID'];
//
// $statement = $pdo->prepare('SELECT * FROM USERS WHERE ID = :id');
// $statement->bindParam(':id', $id, PDO::PARAM_STR);
// $statement->execute();
// $user = $statement->fetch(PDO::FETCH_ASSOC);
// foreach ($postArray as $key => $value) {
//   echo $value['user_id'];
// }
$info = userInfo($pdo);

echo $info['BIO'];
?><img src=" <?php echo "images/".$info['IMAGE']; ?>" alt=""> <?php

?>



<p>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Edit my profile
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



<?php require __DIR__.'/views/footer.php'; ?>

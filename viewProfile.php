<?php
require __DIR__.'/views/header.php';
$userID = $_GET['id'];
$statement = $pdo->query("SELECT * FROM USERS WHERE ID = '$userID'");
$userProfile = $statement->fetch(PDO::FETCH_ASSOC);
?>
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
        echo "Please write something about yourself.";
    } ?></p>
  </div>
</div>
<?php

require __DIR__.'/views/footer.php'; ?>

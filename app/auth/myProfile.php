<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'])) {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $id = $_SESSION['user']['ID'];
  $statement = $pdo->prepare('UPDATE users SET MAIL = :email WHERE ID = :id');
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
}
if (isset($_POST['username'])) {
  $user = filter_var($_POST['username']);
  $id = $_SESSION['user']['ID'];
  $statement = $pdo->prepare('UPDATE users SET USERNAME = :user WHERE ID = :id');
  $statement->bindParam(':user', $user, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
}
if (isset($_POST['bio'])) {
  $bio = filter_var($_POST['bio']);
  $id = $_SESSION['user']['ID'];
  $statement = $pdo->prepare('UPDATE users SET BIO = :bio WHERE ID = :id');
  $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
}
if (isset($_FILES['image'])) {
  $avatar = $_FILES['image'];
  $name = $avatar['name'];

  move_uploaded_file($avatar['tmp_name'],"../../images/".$name);
  $id = $_SESSION['user']['ID'];
  $statement = $pdo->prepare('UPDATE users SET IMAGE = :image WHERE ID = :id');
  $statement->bindParam(':image', $name, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
}
redirect('/myProfile.php');

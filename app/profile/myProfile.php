<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
if (!isset($_SESSION['user'])) {
  redirect('/myProfile.php');
}
if (isset($_POST['email'], $_POST['username'], $_POST['bio'] )) {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
  $id = $_SESSION['user']['ID'];
  $statement = $pdo->prepare('UPDATE users
                              SET MAIL = :email, USERNAME = :user, BIO = :bio
                              WHERE ID = :id');
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':user', $user, PDO::PARAM_STR);
  $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
}

if (isset($_FILES['image'])) {
  $avatar = $_FILES['image'];
  $name = $avatar['name'];
  move_uploaded_file($avatar['tmp_name'],"../../images/".$name);
  $id = $_SESSION['user']['ID'];
  $statement = $pdo->prepare('UPDATE users
                              SET IMAGE = :image
                              WHERE ID = :id');
  $statement->bindParam(':image', $name, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
}
redirect('/myProfile.php');

<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['user'], $_POST['password'], $_POST['email'])) {
  unset($_SESSION['MAIL']);
  $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $statement = $pdo->prepare("INSERT INTO USERS (USERNAME, MAIL, PASSWORD, BIO, IMAGE) 
                              VALUES (:user, :email, :password, :BIO, :IMAGE)");
  $statement->bindParam(':user', $user, PDO::PARAM_STR);
  $statement->bindParam(':email', $email,PDO::PARAM_STR);
  $statement->bindParam(':password', $password,PDO::PARAM_STR);

  $checkIfExist = $pdo->prepare("SELECT * FROM USERS
                                 WHERE MAIL=:email");
  $checkIfExist->bindParam(':email', $email,PDO::PARAM_STR);
  $checkIfExist->execute();
  $check = $checkIfExist->fetch(PDO::FETCH_ASSOC);

  if ($check) {
    $_SESSION['MAIL'] = true;
    redirect('/register.php');
  } else{
    $statement->execute();
    redirect('/login.php');
  }
}
redirect('/');

<?php
declare(strict_types=1);

$pdo = new PDO('sqlite:database.db');

if (isset($_POST['user'], $_POST['password'], $_POST['email'])) {
  $user = $_POST['user'];
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $statement = $pdo->prepare("INSERT INTO USERS (USERNAME, MAIL, PASSWORD) VALUES (:user, :email, :password)");
  $statement->bindParam(':user', $user, PDO::PARAM_STR);
  $statement->bindParam(':email', $email,PDO::PARAM_STR);
  $statement->bindParam(':password', $password,PDO::PARAM_STR);
  $statement->execute();

  // $allUsers = $pdo->prepare('SELECT * FROM USERS');
  // $allUsers->execute();
  // $checkExist = $allUsers->fetchAll(PDO::FETCH_ASSOC);
  //
  // foreach ($checkExist as $key => $value) {
  //     if ($value['MAIL'] === $email ) {
  //         echo "email already exist";
  //         exit();
  //     } if ($value['USERNAME'] === $user) {
  //         echo "usernamer already exist";
  //         exit();
  //     } else {
  //         echo 'hej';
  //       exit();
  //     }
  // }



}

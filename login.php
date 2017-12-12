<?php
declare(strict_types=1);
$pdo = new PDO('sqlite:database.db');


session_start();


if (isset($_POST['email'], $_POST['password'])) {
   $email = filter_var($_POST['email']);
   $password = filter_var($_POST['password']);

   $allUsers = $pdo->prepare('SELECT * FROM USERS where MAIL = :email');

   $allUsers->bindParam(':email', $email, PDO::PARAM_STR);

   $allUsers->execute();

   $checkExist = $allUsers->fetch(PDO::FETCH_ASSOC);

   if (!$checkExist) {
     echo "user doesnt exist";

   }

  if (password_verify($password, $checkExist["PASSWORD"]))  {

    $_SESSION['users'] = [
         'username' => $user['username'],
         'email' => $user['email'],
         'ID' => $user['ID']
       ];
  }
  }

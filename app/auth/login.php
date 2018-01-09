<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $statement = $pdo->prepare('SELECT * FROM USERS
                                WHERE MAIL = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        $_SESSION['wrong'] = true;
        redirect('/login.php');
    }
    if ($user && !password_verify($_POST['password'], $user['PASSWORD'])){
        $_SESSION['pass'] = true;
        redirect('/login.php');
    }
    if (password_verify($_POST['password'], $user['PASSWORD'])) {
        unset($user['PASSWORD']);
        unset($user['MAIL']);
        unset($user['IMAGE']);
        unset($user['BIO']);
        $_SESSION['user'] = $user;
    }
}
redirect('/myProfile.php');

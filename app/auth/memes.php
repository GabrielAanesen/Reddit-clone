<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'],$_POST['link'], $_POST['description'])) {
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $id = $_SESSION['user']['ID'];
  $link = filter_var($_POST['link'], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $date = date("F j, Y, g:i a");
  $statement = $pdo->prepare('INSERT INTO POSTS (title, user_id, link, post_date, description) VALUES (:title, :user_id, :link, :post_date, :description)');
  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
  $statement->bindParam(':link', $link, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->bindParam(':post_date', $date, PDO::PARAM_STR);
  $statement->execute();
}

redirect('/memes.php');

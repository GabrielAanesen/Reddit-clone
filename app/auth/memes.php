<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['headline'],$_POST['link'])) {
  $headline = filter_var($_POST['headline'], FILTER_SANITIZE_STRING);
  $id = $_SESSION['user']['ID'];
  $link = filter_var($_POST['link'], FILTER_SANITIZE_STRING);
  $date = date("F j, Y, g:i a");
  $statement = $pdo->prepare('INSERT INTO POSTS (headline, user_id, link, post_date) VALUES (:headline, :user_id, :link, :post_date)');
  $statement->bindParam(':headline', $headline, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
  $statement->bindParam(':link', $link, PDO::PARAM_STR);
  $statement->bindParam(':post_date', $date, PDO::PARAM_STR);
  $statement->execute();
}

redirect('/memes.php');

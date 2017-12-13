<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['headline'],$_POST['link'])) {
  $headline = $_POST['headline'];
  $id = $_SESSION['user']['ID'];
  $link = $_POST['link'];

  $statement = $pdo->prepare('INSERT INTO POSTS (headline, user_id, link) VALUES (:headline, :user_id, :link)');
  $statement->bindParam(':headline', $headline, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
  $statement->bindParam(':link', $link, PDO::PARAM_STR);
  $statement->execute();
}
redirect('/memes.php');
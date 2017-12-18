<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['comment'])) {
  $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
  $id = $_SESSION['user']['ID'];
  $postId = filter_var($_POST['postId']);
  $date = date("F j, Y, g:i a");
  $statement = $pdo->prepare('INSERT INTO COMMENTS (user_id, comment, post_id, comment_date) VALUES (:id, :comment, :postId, :comment_date)');
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
  $statement->bindParam(':comment_date', $date, PDO::PARAM_STR);
  $statement->execute();

}
redirect("/comments.php?id=$postId");

<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['comment'])) {
  $comment = filter_var($_POST['comment']);
  $id = $_SESSION['user']['ID'];
  $postId = filter_var($_POST['postId']);

  $statement = $pdo->prepare('INSERT INTO COMMENTS (user_id, comment, post_id) VALUES (:id, :comment, :postId)');
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
  $statement->execute();

}
redirect('/memes.php');

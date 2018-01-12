<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['comment'])) {
  $replyComment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
  $id = $_SESSION['user']['ID'];
  $postId = filter_var($_POST['postId']);
  $commentId = filter_var($_POST['commentId']);
  $date = date("F j, Y, g:i a");
  $statement = $pdo->prepare('INSERT INTO REPLY (user_id, reply_comment, post_id, reply_date, comment_id)
                              VALUES (:id, :comment, :postId, :comment_date, :comment_id)');
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->bindParam(':comment', $replyComment, PDO::PARAM_STR);
  $statement->bindParam(':comment_date', $date, PDO::PARAM_STR);
  $statement->bindParam(':comment_id', $commentId, PDO::PARAM_STR);
  $statement->execute();

}
redirect("/comments.php?id=$postId");

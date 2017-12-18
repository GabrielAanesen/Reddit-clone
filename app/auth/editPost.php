<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['edit'])) {
  $newHead = filter_var($_POST['edit'], FILTER_SANITIZE_STRING);
  $id = $_POST['postId'];
  $statement = $pdo->prepare('UPDATE POSTS SET headline = :newHead WHERE post_id = :id');
  $statement->bindParam(':newHead', $newHead, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();

}

if (isset($_POST['delete'])) {
  $id = $_POST['postId'];
  $statement = $pdo->prepare('DELETE FROM POSTS WHERE post_id = :id');
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();

}

redirect("/comments.php?id=$id");

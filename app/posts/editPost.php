<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['editTitle'], $_POST['editDesc'])) {
  $newTitle = filter_var($_POST['editTitle'], FILTER_SANITIZE_STRING);
  $newDesc = filter_var($_POST['editDesc'], FILTER_SANITIZE_STRING);
  $id = $_POST['postId'];
  $statement = $pdo->prepare('UPDATE POSTS
                              SET title = :newTitle, description = :newDesc
                              WHERE post_id = :id');
  $statement->bindParam(':newTitle', $newTitle, PDO::PARAM_STR);
  $statement->bindParam(':newDesc', $newDesc, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
  redirect("/comments.php?id=$id");

}

if (isset($_POST['delete'])) {
  $id = $_POST['postId'];
  $statement = $pdo->prepare('DELETE FROM POSTS
                              WHERE post_id = :id');
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
  redirect("/memes.php");

}

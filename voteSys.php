<?php

declare(strict_types=1);

require __DIR__.'/app/autoload.php';

if (isset($_POST['upvote'])) {
  $postId = (int)$_POST['upvote'];
  $voteDir = (int)$_POST['rating'];
  $userId = $_SESSION['user']['ID'];
  $statement = $pdo->prepare("SELECT user_id, vote_dir
                              FROM Votes
                              WHERE user_id = :userId
                              AND post_id = :postId");
  $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->execute();

  $resultUpVote = $statement->fetch(PDO::FETCH_ASSOC);

  if ($resultUpVote) {
    if ($resultUpVote['vote_dir'] == $voteDir || $resultUpVote['vote_dir'] == -1) {
      $neutralDir = 0;
      $statement = $pdo->prepare("UPDATE Votes
                                  SET vote_dir = :neutral
                                  WHERE user_id = :userId
                                  AND post_id = :postId");
      $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
      $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
      $statement->bindParam(':neutral', $neutralDir, PDO::PARAM_INT);
      $statement->execute();
    }
    else {
      $statement = $pdo->prepare("UPDATE Votes
                                  SET vote_dir = :vote_dir
                                  WHERE user_id = :userId
                                  AND post_id = :postId");
      $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
      $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
      $statement->bindParam(':vote_dir', $voteDir, PDO::PARAM_INT);
      $statement->execute();
    }
  }
  else {
    $statement = $pdo->prepare("INSERT INTO Votes (post_id, user_id, vote_dir)
                                VALUES (:postId, :userId, :vote_dir)");
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':vote_dir', $voteDir, PDO::PARAM_INT);
    $statement->execute();
  }
}

if (isset($_POST['downvote'])) {
  $postId = (int)$_POST['downvote'];
  $voteDir = (int)$_POST['rating'];
  $userId = $_SESSION['user']['ID'];
  $statement = $pdo->prepare("SELECT user_id, vote_dir
                              FROM Votes
                              WHERE user_id = :userId
                              AND post_id = :postId");
  $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->execute();

  $resultDownVote = $statement->fetch(PDO::FETCH_ASSOC);


  if ($resultDownVote) {
    if ($resultDownVote['vote_dir'] == $voteDir || $resultDownVote['vote_dir'] == 1 ) {
      $neutralDir = 0;
      $statement = $pdo->prepare("UPDATE Votes
                                  SET vote_dir = :neutral
                                  WHERE user_id = :userId
                                  AND post_id = :postId");
      $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
      $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
      $statement->bindParam(':neutral', $neutralDir, PDO::PARAM_INT);
      $statement->execute();
    }
    else {
      $statement = $pdo->prepare("UPDATE Votes
                                  SET vote_dir=:vote_dir
                                  WHERE user_id = :userId
                                  AND post_id = :postId");
      $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
      $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
      $statement->bindParam(':vote_dir', $voteDir, PDO::PARAM_INT);
      $statement->execute();
    }
  }
  else {
    $statement = $pdo->prepare("INSERT INTO Votes (post_id, user_id, vote_dir)
                                VALUES (:postId, :userId, :vote_dir)");
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':vote_dir', $voteDir, PDO::PARAM_INT);
    $statement->execute();
  }
}

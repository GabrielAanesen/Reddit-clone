<?php
declare(strict_types=1);
require __DIR__.'/app/autoload.php';
$postId = $_POST['post_id'];
$userId = $_SESSION['user']['ID'];
$statement = $pdo->prepare("SELECT vote_dir, sum(vote_dir)
                            AS voteTot
                            FROM Votes
                            WHERE post_id = :postId
                            AND user_id = :userId");
$statement->bindParam('userId', $userId, PDO::PARAM_INT);
$statement->bindParam('postId', $postId, PDO::PARAM_INT);
$statement->execute();
$voteDir = $statement->fetch(PDO::FETCH_ASSOC);
echo json_encode($voteDir);

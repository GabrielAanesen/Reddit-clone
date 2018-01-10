<?php
declare(strict_types=1);
require __DIR__.'/app/autoload.php';
$postId = $_POST['post_id'];
$statement = $pdo->prepare("SELECT vote_dir, sum(vote_dir)
                            AS voteTot
                            FROM Votes
                            WHERE post_id=:postId");
$statement->bindParam('postId', $postId, PDO::PARAM_INT);
$statement->execute();
$voteTot = $statement->fetch(PDO::FETCH_ASSOC);
echo json_encode($voteTot);

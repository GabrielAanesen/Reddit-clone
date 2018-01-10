<?php
declare(strict_types=1);


if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

function userInfo($pdo){
  $id = $_SESSION['user']['ID'];
  $statement = $pdo->prepare('SELECT * FROM USERS WHERE ID = :id');
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);
  unset($user['PASSWORD']);
  unset($user['ID']);
  return $user;
};

$today = date("F j, Y, g:i a");

function voteSum($pdo, $postId){
$statement = $pdo->prepare("SELECT sum(vote_dir)
                            AS voteTot
                            FROM Votes
                            WHERE post_id=:postId");
$statement->bindParam('postId', $postId, PDO::PARAM_INT);
$statement->execute();
$resultTot = $statement->fetch(PDO::FETCH_ASSOC);
return $resultTot;
}

function voteDir($pdo, $postId){
  $userId = $_SESSION['user']['ID'];
  $statement = $pdo->prepare("SELECT vote_dir
                              FROM Votes
                              WHERE post_id=:postId
                              AND user_id=:userId");
  $statement->bindParam('postId', $postId, PDO::PARAM_INT);
  $statement->bindParam('userId', $userId, PDO::PARAM_INT);
  $statement->execute();
  $resVotDir = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $resVotDir;
}
// function postInfo($pdo){
//   $id = $_SESSION['user']['ID'];
//   $statement = $pdo->prepare('SELECT * FROM POSTS WHERE user_id = :id');
//   $statement->bindParam(':id', $id, PDO::PARAM_INT);
//   $statement->execute();
//   $checkPost = $statement->fetchAll(PDO::FETCH_ASSOC);
//   foreach ($checkPost as $key => $value) {
//     echo $value['headline'];
//   }
// };


// function matrix($postArray){
//   foreach ($postArray as $key => $value) {
//     return $value['user_id'];
//   }
// };


// function (){
//   if ($_SESSION['user']['ID'] ) {
//
//   }
// };

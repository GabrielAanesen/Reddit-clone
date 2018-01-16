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
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
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
if (!$statement) {
  die(var_dump($pdo->errorInfo()));
}
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
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  return $resVotDir;
}

function allReplies($pdo, $commentId) {
  $statement = $pdo->prepare("SELECT USERNAME, ID, IMAGE, reply_comment, reply_date
                               FROM USERS INNER JOIN REPLY
                               ON USERS.ID = REPLY.user_id
                               WHERE comment_id = '$commentId'");
  // $statement = $pdo->prepare("SELECT * FROM REPLY
  //                             WHERE comment_id = '$commentId'");
  $statement->execute();
  $replyComment = $statement->fetchAll(PDO::FETCH_ASSOC);
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  return $replyComment;
}

function allComments($pdo, $postId) {
  $commentTable = $pdo->prepare("SELECT USERNAME, IMAGE, comment, comment_date, comment_id, USERS.ID
                               FROM COMMENTS
                               INNER JOIN USERS
                               ON COMMENTS.user_id = USERS.ID
                               WHERE post_id = :postId
                               ORDER BY comment_id DESC");

  $commentTable->bindParam(':postId', $postId, PDO::PARAM_INT);
  $commentTable->execute();
  $comment = $commentTable->fetchAll(PDO::FETCH_ASSOC);
  if (!$commentTable) {
    die(var_dump($pdo->errorInfo()));
  }
  return $comment;
}

function singlePost($pdo, $postId){
  $statement = $pdo->query("SELECT * FROM POSTS
                            WHERE post_id = '$postId'");
  $post = $statement->fetch(PDO::FETCH_ASSOC);
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  return $post;
}

function allPosts($pdo){
  $statement = $pdo->query('SELECT USERNAME, ID, title, link, post_date, post_id
                            FROM USERS
                            INNER JOIN POSTS
                            ON USERS.ID = POSTS.user_id
                            ORDER BY post_id DESC');
  $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  return $allPosts;
}

function userPosts($pdo, $id){
  $statement = $pdo->query("SELECT * FROM POSTS WHERE user_id = '$id'");
  $myPosts2 = $statement->fetchAll(PDO::FETCH_ASSOC);
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  return $myPosts2;
}

function userProfile($pdo, $id){
  $statement = $pdo->query("SELECT * FROM USERS WHERE ID = '$id'");
  $userProfile = $statement->fetch(PDO::FETCH_ASSOC);
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  return $userProfile;
}

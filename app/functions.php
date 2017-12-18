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

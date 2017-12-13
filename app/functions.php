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
  $statement->bindParam(':id', $id, PDO::PARAM_STR);
  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);
  unset($user['PASSWORD']);
  unset($user['ID']);
  return $user;

};

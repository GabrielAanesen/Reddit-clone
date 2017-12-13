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
// function myProfile(string $what)
//     {
//
//       $id = $_SESSION['user']['ID'];
//       $pdo = new PDO("sqlite:../database/database.db");
//
//       $statement = $pdo->prepare('SELECT * FROM USERS WHERE ID = :id');
//       $statement->bindParam(':id', $id, PDO::PARAM_STR);
//       $statement->execute();
//       $user = $statement->fetch(PDO::FETCH_ASSOC);
//       echo $user['${what}'];
// }

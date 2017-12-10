<?php
declare(strict_types=1);
require __DIR__.'/header.php';

$pdo = new PDO('sqlite:database.db');


if (isset($_POST['email']) && isset($_POST['password'])) {
   $user = filter_var($_POST['email']);
   $password = filter_var($_POST['password']);

   $allUsers = $pdo->prepare('SELECT * FROM USERS WHERE :email, :password');

   $allUsers->bindParam(':user', $user, PDO::PARAM_STR);
   $allUsers->bindParam(':password', $password, PDO::PARAM_STR);

   $allUsers->execute();
   $checkExist = $allUsers->fetchAll(PDO::FETCH_ASSOC);

   if (!$checkExist) {
     echo "user doesnt exist";
   }
}

?>

<?php
require __DIR__.'/footer.php';

?>

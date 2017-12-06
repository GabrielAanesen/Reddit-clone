<?php
declare(strict_types=1);

if (isset($_POST['user']) && isset($_POST['password'])) {
   $user = $_POST['user'];
   $password = $_POST['password'];

   echo $user.$password;
}

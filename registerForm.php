<?php
declare(strict_types=1);
require __DIR__.'/header.php';
?>

<form action="register.php" method="post">
  <input type="text" name="user" value=""><p>USER</p>
  <input type="text" name="email" value=""><p>EMAIL</p>
  <input type="text" name="password" value=""><p>PASSWORD</p>
  <button type="submit" name="button">REGISTER</button>
</form>

<?php
require __DIR__.'/footer.php';
?>

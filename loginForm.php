<?php
declare(strict_types=1);
require __DIR__.'/header.php';
?>
<form action="login.php" method="post">
<input type="text" name="email" value=""><p>EMAIL</p>
<input type="text" name="password" value=""><p>PASSWORD</p>
<button type="submit" name="button">LOGIN</button>

<?php
require __DIR__.'/footer.php';

?>

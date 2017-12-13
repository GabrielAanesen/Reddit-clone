<?php require __DIR__.'/views/header.php';

if (isset($_SESSION['MAIL'])) {
  echo "email already exist please pick another one";
}
?>

<form action="app/auth/register.php" method="post">
  <input type="text" name="user" value=""><p>USER</p>
  <input type="text" name="email" value=""><p>EMAIL</p>
  <input type="text" name="password" value=""><p>PASSWORD</p>
  <button type="submit" name="button">REGISTER</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>

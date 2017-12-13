<?php require __DIR__.'/views/header.php';

if (isset($_SESSION['MAIL'])) {
  echo "email already exist please pick another one";
}
?>

<form action="app/auth/register.php" method="post">
  <div class="form-group">
    <label for="user">Username</label>
  <input class="form-control" type="text" name="user" value="" required>
  <label for="email">Email</label>

  <input class="form-control" type="email" name="email" value="" required>
  <label for="password">Password</label>

  <input class="form-control" type="password" name="password" value="" required>
</div>
<button class="btn btn-outline-secondary" type="submit" name="button">REGISTER</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>

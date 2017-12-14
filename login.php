<?php require __DIR__.'/views/header.php';
?>

<article>
  <div class="col-md-6 mx-auto">
    <h1>Login</h1>
    <form action="app/auth/login.php" method="post">
        <div class="form-group">
          <?php   if (isset($_SESSION['wrong'])) {
              echo "EMAIL DOESNT EXIST";
              unset($_SESSION['wrong']);
            } ?>
            <br>
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter mail" required>
        </div>
        <div class="form-group">
          <?php  if (isset($_SESSION['pass'])) {
              echo "Wrong";
              unset($_SESSION['pass']);
          } ?>
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-outline-secondary">Login</button>
    </form>
  </div>
</article>

<?php require __DIR__.'/views/footer.php'; ?>

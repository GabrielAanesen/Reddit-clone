<?php require __DIR__.'/views/header.php';
?>

<article>
    <h1>Login</h1>

    <form action="app/auth/login.php" method="post">
        <div class="form-group">
          <?php   if (isset($_SESSION['wrong'])) {
              echo "EMAIL DOESNT EXIST";
              var_dump($_SESSION['wrong']);
            } ?>
            <br>
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter mail" required>
        </div><!-- /form-group -->

        <div class="form-group">
          <?php  if (isset($_SESSION['pass'])) {
              echo "Wrong";
              var_dump($_SESSION['pass']);

          } ?>
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter password" required>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-outline-secondary">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>

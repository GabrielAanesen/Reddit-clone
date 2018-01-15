<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/memes.php">MEMES</a>
        </li>
        <li class="nav-item">
          <?php if (!isset($_SESSION['user'])): ?>
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/register.php' ? 'active' : ''; ?>" href="/register.php">Register</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/app/auth/logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
            <?php endif; ?>
        </li>
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/myProfile.php">My profile</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>

<?php
require __DIR__.'/views/header.php';

$statement = $pdo->query('SELECT * FROM POSTS');
$allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($allPosts as $key => $value) {
  ?><p><?php echo $value['headline'];?> </p><?php
  ?> <img src=" <?php echo $value['link']; ?> " alt=""><?php
}
if (isset($_SESSION['user'])) {


?>
<form action="app/auth/memes.php" method="post">
  <div class="form-group">
    <label for="headline">Headline</label>
    <input class="form-control" type="text" name="headline" placeholder="">
    <label for="link">link</label>
    <input class="form-control" type="text" name="link" placeholder="">
    <!-- <label for="exampleFormControlSelect1">Subject</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Funny</option>
      <option>Cats</option>
      <option>Science</option>
      <option>Politics</option>
    </select> -->
  </div>
  <button type="submit" class="btn btn-primary">Submit Post</button>
</form>

<?php
}
require __DIR__.'/views/footer.php'; ?>

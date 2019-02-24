<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/02/2019
 * Time: 14:21
 */
?>

<?php
    $sql = "SELECT * FROM photos ORDER BY id DESC LIMIT 5";
    $top_photos = Photo::find_this_query($sql);
?>
<h1 class="my-5">Sidebar menu</h1>

<a href="admin/login.php" class="btn btn-primary my-3">Login</a>
<h2>Last 5 posts</h2>
<ul>
    <?php foreach ($top_photos as $top_photo) : ?>
    <li><a href="photo.php?id=<?= $top_photo->id; ?>"><?= $top_photo->title; ?></a></li>
    <?php endforeach; ?>
</ul>

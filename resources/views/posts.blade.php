<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Jan-Pieter Martin Ott">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app.css">
    <title>Mijn blog</title>
  </head>
    <body>

    <?php foreach ($posts as $post) : ?>
        <article>
            <h1>
                <a href="posts/<?= $post->slug; ?>">
                <?= $post->title; ?></a>
            </h1>
            <div><?= $post->excerpt; ?></div>
        </article>
    <?php endforeach; ?>
    </body>
</html>

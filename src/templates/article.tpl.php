<?php
if($article) {
    $title = $article['title'];
} else {
    $title = 'Статья не найдена';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
</head>
<body>
<?php if(!$article) { ?>
    <section class="hero">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Новость не найдена
                    </h1>
                </div>
            </div>
        </section>
<?php } ?>
    <div class="container">
        <div class="columns">
            <div class="column is-2"></div>
            <div class="column is-8">
                <article class="article content">
                    <header class="article__header">
                        <h1 class="title is-1"><?= $article['title'] ?></h1>
                    </header>
                    <?php if($article['img']) { ?>
                        <figure>
                            <img
                                src="<?= $article['img'] ?>"
                                alt="<?= $article['title'] ?>"
                            />
                        </figure>
                    <?php } ?>
                    <p class="article__text">
                        <?= $article['fulltext'] ?>
                    </p>
                    <footer>
                        <?= $article['date'] ? date("d.m H:i", strtotime($article['date'])) : '' ?>
                    </footer>
                </article>
            </div>
            <div class="column is-2"></div>
        </div>
    </div>
</body>
</html>
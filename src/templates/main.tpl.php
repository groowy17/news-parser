<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новости</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
</head>
<body>
    <div class="news container">
        <section class="hero">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Все новости
                    </h1>
                    <?php if(!count($articles)) {?>
                        <h2 class="subtitle">
                            Нет новостей в базе
                        </h2>
                    <?php } ?>
                    <div>
                        <a href="/parser.php" class="button is-primary is-outlined">Парсить новые</a>
                    </div>
                </div>
            </div>
        </section>
        <div class="columns">
            <div class="column is-1"></div>
            <div class="column is-10">
                <?php foreach($articles as $article) {?>
                    <article class="news__item article content">
                        <header class="article__header">
                            <h2 class="title is-5"><?= $article['title'] ?></h2>
                        </header> 
                        <p class="article__description">
                            <?= $article['description'] ?>
                        </p>
                        <footer class="article__footer">
                            <a href="/?id=<?=$article['id']?>">Подробнее</a>
                        </footer>
                    </article>
                <?php } ?>
            </div>
            <div class="column is-1"></div>
        </div>
    </div>
</body>
</html>
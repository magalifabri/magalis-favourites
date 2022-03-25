<?php require_once 'Views/includes/header.php' ?>

<main>
    <?php foreach ($movies as $movie) : ?>
        <p><?= $movie->title ?></p>
        <p><?= $movie->year ?></p>
        <p><?= $movie->imdbRating ?></p>
        <img src="<?= $movie->imdbPosterUrl ?>" alt="">
        <ul>
            <?php foreach ($movie->genres as $genre) : ?>
                <li><?= $genre ?></li>
            <?php endforeach ?>
        </ul>
    <?php endforeach ?>
</main>

<?php require_once 'Views/includes/footer.php' ?>
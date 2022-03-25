<?php require_once 'Views/includes/header.php' ?>

<main>
    <form action="?page=add-movie" method="POST">
        <button type="submit" name="page" value="add-movie">+</button>
        <input type="hidden" name="serialized-movie" value="<?= urlencode(serialize($movie)) ?>">
    </form>

    <p><?= $movie->title ?></p>
    <p><?= $movie->year ?></p>
    <p><?= $movie->imdbRating ?></p>
    <img src="<?= $movie->imdbPosterUrl ?>" alt="">
    <ul>
        <?php foreach ($movie->genres as $genre) : ?>
            <li><?= $genre ?></li>
        <?php endforeach ?>
    </ul>
</main>

<?php require_once 'Views/includes/footer.php' ?>
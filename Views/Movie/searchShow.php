<?php require_once 'Views/includes/header.php' ?>

<button class="back" onclick="history.back()"> ↩︎ </button>
<br>
<br>
<main>
    <?php if (empty($_SESSION['loggedIn'])) : ?>
        <p>permission denied</p>
    <?php else : ?>
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
        <p><?= $movie->plot ?></p>
    <?php endif ?>

</main>

<?php require_once 'Views/includes/footer.php' ?>
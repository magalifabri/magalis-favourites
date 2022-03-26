<?php require_once 'Views/includes/header.php' ?>

<main>
    <?php if (empty($_SESSION['loggedIn'])) : ?>
        <p>permission denied</p>
    <?php else : ?>
        <!-- get movie title to search for  -->

        <form action="" method="GET">
            <input type="text" name="title" value="<?= $_GET['title'] ?? '' ?>">
            <button type="submit" name="page" value="admin">search</button>
        </form>

        <!-- load search results if they're available -->

        <?php if (!empty($movies)) : ?>
            <?php foreach ($movies as $movie) : ?>

                <p>
                    <a href="?page=movie-details&imdb-id=<?= $movie->imdbId ?>">
                        <?= $movie->title ?>
                    </a>
                </p>

                <p><?= $movie->imdbId ?></p>

                <?php if (!empty($movie->imdbPosterUrl)) : ?>
                    <img height="200" src="<?= $movie->imdbPosterUrl ?>">
                <?php endif ?>

            <?php endforeach ?>
        <?php endif ?>
    <?php endif ?>

</main>

<?php require_once 'Views/includes/footer.php' ?>
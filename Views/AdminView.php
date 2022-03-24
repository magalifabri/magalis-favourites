<?php require_once 'Views/includes/header.php' ?>

<main>
    <!-- get movie title to search for  -->

    <form action="" method="POST">
        <input type="text" name="title" value="<?= $_POST['title'] ?>">
    </form>

    <!-- load search results if they're available -->

    <?php if (!empty($this->movies)) : ?>
        <?php foreach ($this->movies as $movie) : ?>

            <p>
                <a href="?page=movie-details&imdb-id=<?= $movie->imdbId ?>">
                    <?= $movie->title ?>
                </a>
            </p>
            <p><?= $movie->imdbId ?></p>
            <img height="200" src="<?= $movie->imdbPosterUrl ?>">
        <?php endforeach ?>
    <?php endif ?>
</main>

<?php require_once 'Views/includes/footer.php' ?>
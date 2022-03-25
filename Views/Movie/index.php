<!-- <?php require_once 'Views/includes/header.php' ?> -->


<!-- <?php require_once 'Views/includes/footer.php' ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Roboto:wght@400;900&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Views/sass/style.css">
    <script defer src="script.js"></script>

    <title>Magali's Collection</title>
</head>

<body>
    <header>
        <h1>Magali's<br>Collection</h1>
    </header>

    <main>
        <hr class="filter-border above">
        <section class="filter-buttons">
            <button class="show-all-button">show all</button>
            <button class="filter-button Drama">Drama</button>
            <button class="filter-button Sci-Fi">Sci-Fi</button>
            <button class="filter-button Adventure">Adventure</button>
            <button class="filter-button Action">Action</button>
            <button class="filter-button Thriller">Thriller</button>
            <button class="filter-button Comedy">Comedy</button>
            <button class="filter-button Romance">Romance</button>
            <button class="filter-button Crime">Crime</button>
            <button class="filter-button Mystery">Mystery</button>
            <button class="filter-button Horror">Horror</button>
        </section>
        <input type="text" class="search-bar" placeholder="title / year">
        <hr class="filter-border below">

        <section class="cards-container">
            <?php foreach ($movies as $movie) : ?>
                <div class="card">
                    <img src="<?= $movie->imdbPosterUrl ?>" alt="" class="cover-img">
                    <p class="title"> <?= $movie->title ?></p>
                    <div class="genres-container">
                        <?php foreach ($movie->genres as $genre) : ?>
                            <p class="genre <?= $genre ?>"><?= $genre ?></p>
                        <?php endforeach ?>
                    </div>
                    <p class="description"><?= $movie->plot ?></p>
                    <hr>
                    <div class="data-container">
                        <p class="year"><?= $movie->year ?></p>
                        <a class="link" href="<?= "https://www.imdb.com/title/{$movie->imdbId}/" ?>">
                            IMDb: <?= $movie->imdbRating ?>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
    </main>

    <!-- <script type="module" src="./script.js"></script> -->
</body>

</html>
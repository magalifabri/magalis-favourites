<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Views/sass/style.css">
    <script defer src="script.js"></script>

    <title>Magali's Favourites</title>
</head>

<body>
    <header>
        <h1>Magali's<br>Favourites</h1>
    </header>

    <main>
        <hr class="filter-border above">
        <input type="text" class="search-bar" placeholder="title / year / genre">
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

    <footer>
        <hr>
        <p>made by Magali Fabri</p>
        <p>view code on <a href="">GitHub</a>[INSERT LINK]</p>
        <p>deployed on <a href="https://www.heroku.com/home">Heroku</a></p>
        <p>icons from <a href="https://icons8.com/">Icons8</a></p>
        <p>data from <a href="https://www.imdb.com/">IMDb</a> and <a href="http://www.omdbapi.com/">OMDb API</a></p>
        <a class="login" href="?page=login"><img src="./Views/images/login.png" alt=""></a>
    </footer>

</body>

</html>
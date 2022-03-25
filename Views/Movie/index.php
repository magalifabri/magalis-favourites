<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <footer>
        <hr>
        <p>made by Magali Fabri</p>
        <p>view code on <a href="">GitHub</a>[INSERT LINK]</p>
        <p>deployed on <a href="https://www.heroku.com/home">Heroku</a></p>
        <p>icons from <a href="https://icons8.com/">Icons8</a></p>
        <p>data from <a href="https://www.imdb.com/">IMDb</a> and <a href="http://www.omdbapi.com/">OMDb API</a></p>
        <a class="login" href="#"><img src="./Views/images/login.png" alt=""></a>
    </footer>

</body>

</html>
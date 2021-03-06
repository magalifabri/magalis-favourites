<?php

class MovieModel
{
    private DatabaseManager $dbConn;

    public function __construct()
    {
        $this->dbConn = new DatabaseManager();
    }


    public function getMovies(): array
    {
        $query =
            'SELECT *
            FROM magalis_favourites__movies;';
        $stmt = $this->dbConn->connection->query($query);
        $moviesRaw = $stmt->fetchAll();

        $movies = [];

        foreach ($moviesRaw as $movieRaw) {
            $imdbId = $movieRaw['imdb_id'];
            $title = $movieRaw['title'];
            $year = $movieRaw['year'];
            $genres = $movieRaw['genres'];
            $rating = $movieRaw['rating'];
            $poster = $movieRaw['poster'];
            $plot = $movieRaw['plot'];

            $movie = new Movie($title, $imdbId, $poster);
            $movie->imdbRating = $rating;
            $movie->year = $year;
            $movie->genres = json_decode($genres);
            $movie->plot = $plot;

            $movies[] = $movie;
        }

        return $movies;
    }


    public function getSearchResults()
    {
        $query = $_GET['title'];
        $firstLetter = $query[0];
        $apiUrl = "https://v2.sg.media-imdb.com/suggestion/{$firstLetter}/{$query}.json";
        $searchResults = $this->curlApi($apiUrl);
        // $_SESSION['data'] = $searchResults;
        // $searchResults = $_SESSION['data']; // dummy data
        $movies = $this->parseSearchResults($searchResults);

        return $movies;
    }

    private function curlApi($url): array
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $responseJSON = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($responseJSON, true);

        return $data;
    }

    private function parseSearchResults($searchResults): array
    {
        $movies = [];

        foreach ($searchResults['d'] as $movie) {
            $mediaType = $movie['q'] ?? 'none';

            if ($mediaType === 'feature') {
                $title = $movie['l'];
                $imdbId = $movie['id'];
                $imdbPosterUrl = $movie['i']['imageUrl'] ?? '';

                $movies[$imdbId] = new Movie($title, $imdbId, $imdbPosterUrl);
            }
        }

        return $movies;
    }


    public function getDetails(): Movie
    {
        // get movie details from OMDB API
        $imdbId = $_GET['imdb-id'];
        $apiKey = 'f2a26a58';
        $url = "http://www.omdbapi.com/?i={$imdbId}&apikey={$apiKey}";

        $data = $this->curlApi($url);

        // fill class with parsed data
        $movie = $this->parseData($data, $imdbId);

        return $movie;
    }

    private function parseData($data, $imdbId): Movie
    {
        $title = $data['Title'];
        $year = $data['Year'];
        $genres = $data['Genre'];
        $rating = $data['imdbRating'];
        $poster = $data['Poster'];
        $plot = $data['Plot'];

        $movie = new Movie($title, $imdbId, $poster);
        $movie->imdbRating = $rating;
        $movie->year = $year;
        $movie->genres = explode(', ', $genres);
        $movie->plot = $plot;

        return $movie;
    }


    public function create()
    {
        $movie = unserialize(urldecode($_POST['serialized-movie']));
        $genresJson = json_encode($movie->genres);

        if ($this->movieInDb($movie->imdbId)) {
            echo 'movie already in db';
            die;
        }

        $query =
            'INSERT INTO magalis_favourites__movies
                (imdb_id, title, year, genres, poster, rating, plot)
            VALUES (:imdb_id, :title, :year, :genres, :poster, :rating, :plot)';
        $stmt = $this->dbConn->connection->prepare($query);
        $stmt->bindParam(':imdb_id', $movie->imdbId);
        $stmt->bindParam(':title', $movie->title);
        $stmt->bindParam(':year', $movie->year);
        $stmt->bindParam(':genres', $genresJson);
        $stmt->bindParam(':poster', $movie->imdbPosterUrl);
        $stmt->bindParam(':rating', $movie->imdbRating);
        $stmt->bindParam(':plot', $movie->plot);
        $stmt->execute();
    }

    private function movieInDb($imdbId): bool
    {
        $query =
            "SELECT *
            FROM magalis_favourites__movies
            WHERE imdb_id = :imdb_id;";
        $stmt = $this->dbConn->connection->prepare($query);
        $stmt->bindParam(':imdb_id', $imdbId);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

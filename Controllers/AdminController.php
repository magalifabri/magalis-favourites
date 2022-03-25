<?php

class AdminController
{
    public function index()
    {
        // check for form
        if (!empty($_GET['title'])) {
            // $query = $_GET['title'];
            // $firstLetter = $query[0];
            // $apiUrl = "https://v2.sg.media-imdb.com/suggestion/{$firstLetter}/{$query}.json";
            // $searchResults = $this->curlApi($apiUrl);
            $searchResults = $_SESSION['data']; // dummy data
            $movies = $this->parseSearchResults($searchResults);
        }

        require_once 'Views/AdminView.php';
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


    public function show()
    {
        // get movie details from OMDB API
        $imdbId = $_GET['imdb-id'];
        $apiKey = 'f2a26a58';
        $url = "http://www.omdbapi.com/?i={$imdbId}&apikey={$apiKey}";

        $data = $this->curlApi($url);

        // fill class with parsed data
        $movie = $this->parseData($data, $imdbId);

        require_once 'Views/MovieDetailsView.php';
    }

    private function parseData($data, $imdbId): Movie
    {
        $title = $data['Title'];
        $year = $data['Year'];
        $genres = $data['Genre'];
        $rating = $data['imdbRating'];
        $poster = $data['Poster'];

        $movie = new Movie($title, $imdbId, $poster);
        $movie->imdbRating = $rating;
        $movie->year = $year;
        $movie->genres = explode(', ', $genres);

        return $movie;
    }


    public function addMovie()
    {
        $movie = unserialize(urldecode($_POST['serialized-movie']));
        $genresJson = json_encode($movie->genres);
        $dbConn = new DatabaseManager();

        $query =
            'INSERT INTO movies
                (title, year, genres, poster, rating)
            VALUES (:title, :year, :genres, :poster, :rating)';
        $stmt = $dbConn->connection->prepare($query);
        $stmt->bindParam(':title', $movie->title);
        $stmt->bindParam(':year', $movie->year);
        $stmt->bindParam(':genres', $genresJson);
        $stmt->bindParam(':poster', $movie->imdbPosterUrl);
        $stmt->bindParam(':rating', $movie->imdbRating);
        $stmt->execute();

        die;
    }
}

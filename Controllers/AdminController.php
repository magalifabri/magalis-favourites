<?php

class AdminController
{
    public function index()
    {
        // check for form
        if (!empty($_POST['title'])) {
            $query = $_POST['title'];

            // $firstLetter = $query[0];
            // $apiUrl = "https://v2.sg.media-imdb.com/suggestion/{$firstLetter}/{$query}.json";
            // $searchResults = $this->getSearchResults($apiUrl);
            $searchResults = $_SESSION['data']; // dummy data
            $movies = $this->parseSearchResults($searchResults);
        }

        require_once 'Views/AdminView.php';
    }

    private function getSearchResults($url): array
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
                $imdbPosterUrl = $movie['i']['imageUrl'];

                $movies[] = new Movie($title, $imdbId, $imdbPosterUrl);
            }
        }

        return $movies;
    }
}

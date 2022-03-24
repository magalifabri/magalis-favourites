<?php

class Movie
{
    public string $title;
    public string $imdbId;
    public string $imdbPosterUrl;

    public string $year;
    public array $genres;
    public string $imdbRating;

    public function __construct($title, $imdbId, $imdbPosterUrl)
    {
        $this->title = $title;
        $this->imdbId = $imdbId;
        $this->imdbPosterUrl = $imdbPosterUrl;
    }
}

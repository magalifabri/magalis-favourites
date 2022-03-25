<?php

class MovieController
{
    private MovieModel $movieModel;

    public function __construct()
    {
        $this->movieModel = new MovieModel();
    }


    // show grid of movies in db
    public function index()
    {
        $movies = $this->movieModel->getMovies();

        require_once 'Views/Movie/index.php';
    }

    // show list of search results
    public function search()
    {
        // check for form
        if (!empty($_GET['title'])) {
            $movies = $this->movieModel->getSearchResults();
        }

        require_once 'Views/Movie/searchIndex.php';
    }

    // show details of selected search result
    public function show()
    {
        $movie = $this->movieModel->getDetails();

        require_once 'Views/Movie/searchShow.php';
    }

    // create movie in db
    public function addMovie()
    {
        $this->movieModel->create();

        die;
    }
}

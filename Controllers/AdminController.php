<?php

class AdminController
{
    private MovieModel $movieModel;

    public function __construct()
    {
        $this->movieModel = new MovieModel();
    }


    // show list of search results
    public function index()
    {
        // check for form
        if (!empty($_GET['title'])) {
            $movies = $this->movieModel->getSearchResults();
        }

        require_once 'Views/AdminView.php';
    }

    // show details of selected search result
    public function show()
    {
        $movie = $this->movieModel->getDetails();

        require_once 'Views/MovieDetailsView.php';
    }

    // create movie in db
    public function addMovie()
    {
        $this->movieModel->create();

        die;
    }
}

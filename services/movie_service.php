<?php

class MovieService {
    private MovieRepository $movie_repo;

    public function __construct(MovieRepository $movie_repo) {
        $this->movie_repo = $movie_repo;
    }

    public function get_movies() {
        return $this->movie_repo->get_movies();
    }
}
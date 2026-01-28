<?php

class MovieController {
    private MovieService $movie_service;

    public function __construct(MovieService $movie_service) {
        $this->movie_service = $movie_service;
    }

    public function get_movies() {
        return $this->movie_service->get_movies();
    }

    public function store_movie(StoreMovieRequest $request) {
        return $this->movie_service->store_movie($request);
    }
}
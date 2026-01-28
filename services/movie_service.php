<?php

class MovieService {
    private MovieRepository $movie_repo;

    public function __construct(MovieRepository $movie_repo) {
        $this->movie_repo = $movie_repo;
    }

    public function get_movies() {
        return $this->movie_repo->get_movies();
    }

    public function store_movie(StoreMovieRequest $request) {
        if (!empty($request->errors)) {
            return false;
        }

        $movie_data = [
            'title' => $request->title,
            'release_date' => $request->releaseDate->format('Y-m-d'),
            'rating' => $request->rating,
            'duration' => $request->duration,
            'genres' => $request->genres
        ];

        return $this->movie_repo->store_movie($movie_data);
    }
}
<?php

require_once '../../bootstrap.php';

$movies = $movie_repo->get_movies();

foreach ($movies as $movie) {
    echo "ID: " . $movie->id . "</br>";
    echo "Title: " . $movie->title . "</br>";
    echo "Genre: " . $movie->genre . "</br>";
    echo "Duration: " . $movie->duration . "</br>";
    echo "Rating: " . $movie->rating . "</br>";
    echo "Release Date: " . $movie->release_date . "</br>";
    echo "-------------------------</br>";
}

?>

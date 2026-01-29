<?php

require_once '_.php';

$allowed_genres = array(
    'action',
    'adventure',
    'comedy',
    'fantasy',
    'horror',
    'romance',
    'sci-fi',
);

$movie_id = (int) ($_GET['id'] ?? 0);

if ($movie_id <= 0) {
    header('Location: index.php?error=movie_not_found');
    exit;
}

$movie = get_movie_by_id($movie_id);

if (!$movie) {
    header('Location: index.php?error=movie_not_found');
    exit;
}
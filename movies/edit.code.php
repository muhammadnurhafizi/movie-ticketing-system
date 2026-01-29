<?php

require_once '_.php';

$old = [];
$errors = [];

$allowed_genres = [
    'action',
    'adventure',
    'comedy',
    'fantasy',
    'horror',
    'romance',
    'sci-fi',
];

/* -----------------------
   GET: Load movie
----------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $movie_id = (int) $_GET['id'];
    $movie = get_movie_by_id($movie_id);

    if (!$movie) {
        header('Location: index.php?error=movie_not_found');
        exit;
    }
}

/* -----------------------
   POST: Update movie
----------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_movie'])) {

    $old = $_POST;
    $old['genres'] = $_POST['genres'] ?? [];

    $id = (int) ($_POST['id'] ?? 0);

    if ($id <= 0 || !get_movie_by_id($id)) {
        header('Location: index.php?error=movie_not_found');
        exit;
    }

    $title        = sanitize_title($old['title'] ?? '', $errors);
    $release_date = sanitize_release_date($old['release_date'] ?? '', $errors);
    $rating       = sanitize_rating($old['rating'] ?? null, $errors);
    $duration     = sanitize_duration($old['duration'] ?? '', $errors);
    $genres       = sanitize_genres($old['genres'], $allowed_genres, $errors);

    if (!empty($errors)) {
        return;
    }

    $result = update_movie_by_id(
        $id,
        $title,
        $duration,
        $rating,
        $release_date,
        $genres
    );

    if (!$result) {
        $errors['general'] = 'Failed to update movie. Please try again.';
        return;
    }

    header('Location: index.php?success=updated');
    exit;
}
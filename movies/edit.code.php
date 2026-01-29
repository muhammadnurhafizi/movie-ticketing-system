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

function sanitize_title($title, array &$errors): string
{
    $title = trim(strip_tags($title));

    if ($title === '') {
        $errors['title'] = 'Title is required';
    }

    return $title;
}

function sanitize_release_date($date, array &$errors): ?string
{
    $date = trim($date);

    if ($date === '') {
        $errors['release_date'] = 'Release date is required';
        return null;
    }

    $dt = DateTime::createFromFormat('Y-m-d', $date);

    if (!$dt) {
        $errors['release_date'] = 'Invalid release date format';
        return null;
    }

    return $dt->format('Y-m-d');
}

function sanitize_rating($rating, array &$errors): ?float
{
    if ($rating === '' || $rating === null) {
        return null;
    }

    if (!is_numeric($rating) || $rating < 0 || $rating > 10) {
        $errors['rating'] = 'Rating must be between 0 and 10';
        return null;
    }

    return (float) $rating;
}

function sanitize_duration($duration, array &$errors): ?int
{
    if ($duration === '') {
        $errors['duration'] = 'Duration is required';
        return null;
    }

    $duration = filter_var($duration, FILTER_VALIDATE_INT);

    if ($duration === false || $duration <= 0) {
        $errors['duration'] = 'Duration must be more than 0 minutes';
        return null;
    }

    return $duration;
}

function sanitize_genres(array $genres, array $allowed, array &$errors): array
{
    if (empty($genres)) {
        $errors['genres'] = 'At least one genre must be selected';
        return [];
    }

    return array_values(array_unique(
        array_intersect($genres, $allowed)
    ));
}
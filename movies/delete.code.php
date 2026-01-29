<?php

require_once '_.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete_movie'])) {
    header('Location: index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?error=movie_not_found');
    exit;
}

$movie = get_movie_by_id($id);

if (!$movie) {
    header('Location: index.php?error=movie_not_found');
    exit;
}

if (!delete_movie_by_id($id)) {
    header('Location: index.php?error=delete_failed');
    exit;
}

header('Location: index.php?success=deleted');
exit;

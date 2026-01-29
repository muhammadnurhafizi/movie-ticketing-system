<?php

require_once '_.php';

$movies = get_movies();

if (isset($_GET['success'])) {
    if ($_GET['success'] == 'created')
        $success = "Movie created successfully";

    if ($_GET['success'] == 'updated')
        $success = "Movie updated successfully";

    if ($_GET['success'] == 'deleted')
        $success = "Movie deleted successfully";
}

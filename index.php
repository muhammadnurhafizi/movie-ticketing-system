<?php

$conn = get_db_connection();

get_movies($conn);

function get_db_connection() {
    $hostname = "localhost";
    $username = "root";
    $password = "AquaCrystal3012";
    $database = "movie-ticketing-system";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

function get_movies($conn) {
    echo "<h3>Movie List</h3>";

    $sql = "SELECT * FROM movie;";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "- Title: " . format_title($row['title']) . "</br>";
            echo "- Genre: "  . format_genre($row['genre']) . "</br>";
            echo "- Duration: "  . format_duration($row['duration']) . "</br>";
            echo "- Rating: "  . format_rating($row['rating']) . "</br>";
            echo "- Release Date: "  . format_release_date($row['release_date']) . "</br>";
            echo "</br>";
        }
    } else {
        echo "0 results";
    }
}

function format_title($title) {
    return ucwords(strtolower($title));
}

function format_duration($duration) {
    $hours = floor($duration / 60);
    $minutes = $duration % 60;
    return "{$hours}h {$minutes}m";
}

function format_rating($rating) {
    return "{$rating}/10";
}

function format_release_date($release_date) {
    return date("F j, Y", strtotime($release_date));
}

function format_genre($genre) {
    $json_genre = json_decode($genre, true);
    $arr_genre = array_column($json_genre, 'name');
    $str_genre = implode(", ", $arr_genre);
    return ucwords(strtolower($str_genre));
}
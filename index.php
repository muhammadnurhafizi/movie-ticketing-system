<?php

$conn = get_db_connection();

get_movies();

add_movie();

get_movie();

update_movie();

get_movie();

delete_movie();

get_movies();



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

function get_movies() {
    global $conn;

    echo "<h3>Movie List</h3>";

    $stmt = $conn->prepare("SELECT * FROM movie;");
    $stmt->execute();

    $result = $stmt->get_result();
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

function add_movie() {
    global $conn;

    echo "<h3>Add New Movie</h3>";

    $data = [
        "title"         => "boku no kokoro no yabai yatsu movie",
        "genre"         => array("Comedy", "Romance"),
        "duration"      => 105,
        "rating"        => null,
        "release_date"  => "2026-02-13"
    ];

    $title          = parse_title($data['title']);
    $genre          = parse_genre($data['genre']);
    $duration       = parse_duration($data['duration']);
    $rating         = parse_rating($data['rating']);
    $release_date   = parse_release_date($data['release_date']);

    $stmt = $conn->prepare("INSERT INTO movie (title, genre, duration, rating, release_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssids", $title, $genre, $duration, $rating, $release_date);
    if ($stmt->execute()) {
        echo "New movie added successfully. Movie ID: " . $stmt->insert_id . "</br>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

function get_movie() {
    global $conn;

    echo "<h3>Get Movie By ID</h3>";

    $movie_id = 4;

    $stmt = $conn->prepare("SELECT * FROM movie WHERE id = ?;");
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();

    $result = $stmt->get_result();
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

function update_movie() {
    global $conn;

    echo "<h3>Update Movie</h3>";

    $data = [
        "id"            => 4,
        "title"         => "boku no kokoro no yabai yatsu movie 2",
        "genre"         => array("Romance", "Drama"),
        "duration"      => 120,
        "rating"        => 8.5,
        "release_date"  => "2027-01-23"
    ];

    $id             = (int) $data['id'];
    $title          = parse_title($data['title']);
    $genre          = parse_genre($data['genre']);
    $duration       = parse_duration($data['duration']);
    $rating         = parse_rating($data['rating']);
    $release_date   = parse_release_date($data['release_date']);

    $stmt = $conn->prepare("UPDATE movie SET title = ?, genre = ?, duration = ?, rating = ?, release_date = ? WHERE id = ?");
    $stmt->bind_param("ssidsi", $title, $genre, $duration, $rating, $release_date, $id);
    if ($stmt->execute()) {
        echo "Movie updated successfully. Movie ID: " . $id . "</br>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

function delete_movie() {
    global $conn;

    echo "<h3>Delete Movie</h3>";

    $movie_id = 4;

    $stmt = $conn->prepare("DELETE FROM movie WHERE id = ?;");
    $stmt->bind_param("i", $movie_id);
    if ($stmt->execute()) {
        echo "Movie deleted successfully. Movie ID: " . $movie_id . "</br>";
    } else {
        echo "Error: " . $stmt->error;
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
    if ($rating === null)
        return "N/A";
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

function parse_title($title) {
    return strtolower(trim($title));
}

function parse_genre($genre) {
    return json_encode(array_map(function($g) {
        return ['name' => trim($g)];
    }, $genre));
}

function parse_duration($duration) {
    return (int) $duration;
}

function parse_rating($rating) {
    if ($rating == null) {
        return null;
    }

    return is_numeric($rating) ? (float) $rating : null;
}

function parse_release_date($release_date) {
    $release_date = trim($release_date);
    $date = DateTime::createFromFormat('Y-m-d', $release_date);
    return $date ? $date->format('Y-m-d') : null;
}
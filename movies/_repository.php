<?php

// crud functions
function get_movies() : array
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM movie;");
    $stmt->execute();

    $result = $stmt->get_result();
    
    $stmt->close();

    $movies = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movie = new stdClass;
            $movie->id              = (int) $row['id'];
            $movie->title           = format_title($row['title']);
            $movie->duration        = format_duration_string($row['duration']);
            $movie->rating          = format_rating_string($row['rating']);
            $movie->release_date    = format_release_date_string($row['release_date']);
            $movie->genre           = format_genre_string($row['genre']);

            $movies[] = $movie;
        }
    }

    return $movies;
}

function get_movie_by_id($id) : ?stdClass
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM movie WHERE id = ?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    
    $stmt->close();

    $movie = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $movie = new stdClass;
        $movie->id              = (int) $row['id'];
        $movie->title           = format_title($row['title']);
        $movie->duration        = format_duration($row['duration']);
        $movie->rating          = format_rating($row['rating']);
        $movie->release_date    = format_release_date($row['release_date']);
        $movie->genre           = format_genre($row['genre']);
    }

    return $movie;
}

function add_movie($title, $duration, $rating, $release_date, $genre): ?int
{
    global $conn;

    $title          = parse_title($title);
    $duration       = parse_duration($duration);
    $rating         = parse_rating($rating);
    $release_date   = parse_release_date($release_date);
    $genre          = parse_genre($genre);

    $stmt = $conn->prepare("INSERT INTO movie (title, duration, rating, release_date, genre) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $title, $duration, $rating, $release_date, $genre);

    $movie_id = null;
    if ($stmt->execute()) {
        $movie_id = $stmt->insert_id;
    }

    $stmt->close();

    return $movie_id;
}

function update_movie_by_id($id, $title, $duration, $rating, $release_date, $genre) : ?int
{
    global $conn;

    $id             = (int) $id;
    $title          = parse_title($title);
    $duration       = parse_duration($duration);
    $rating         = parse_rating($rating);
    $release_date   = parse_release_date($release_date);
    $genre          = parse_genre($genre);

    $stmt = $conn->prepare("UPDATE movie SET title = ?, duration = ?, rating = ?, release_date = ?, genre = ? WHERE id = ?");
    $stmt->bind_param("sisssi", $title, $duration, $rating, $release_date, $genre, $id);

    $movie_id = null;
    if ($stmt->execute()) {
        $movie_id = $id;
    }

    $stmt->close();

    return $movie_id;
}

function delete_movie_by_id($id) : bool
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM movie WHERE id = ?;");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = true;
    } else {
        $result = false;
    }

    $stmt->close();

    return $result;
}
<?php

// helper functions
function format_title($title) : string
{
    return ucwords(strtolower($title));
}

function format_duration($duration) : int
{
    return $duration;
}

function format_duration_string($duration) : string
{
    $hours = floor($duration / 60);
    $minutes = $duration % 60;
    return "{$hours}h {$minutes}m";
}

function format_rating($rating) : float
{
    return (float) $rating;
}

function format_rating_string($rating) : string
{
    if ($rating === null)
        return "N/A";

    $rating = (float) $rating;

    return "{$rating}/10";
}

function format_release_date($release_date) : ?string
{
    if (!$release_date) return null;

    $timestamp = strtotime($release_date);

    return $timestamp ? date("Y-m-d", $timestamp) : null;
}

function format_release_date_string($release_date) : ?string
{
    if (!$release_date) return null;

    $timestamp = strtotime($release_date);

    return $timestamp ? date("F j, Y", $timestamp) : null;
}

function format_genre($genre) : array
{
    if (!$genre) return [];

    $json_genre = json_decode($genre, true);

    if (!is_array($json_genre)) return [];

    return array_column($json_genre, 'name');
}

function format_genre_string($genre) : string
{
    if (!$genre) return 'N/A';

    $json_genre = json_decode($genre, true);

    if (!is_array($json_genre)) return 'N/A';

    $arr_genre = array_column($json_genre, 'name');
    
    return ucwords(strtolower(implode(", ", $arr_genre)));
}

function parse_title($title) : string
{
    return strtolower(trim($title));
}

function parse_genre($genre) : string
{
    if (!is_array($genre)) {
        return json_encode([]);
    }

    return json_encode(array_map(function($g) {
        return ['name' => trim($g)];
    }, $genre));
}

function parse_duration($duration) : int
{
    return (int) $duration;
}

function parse_rating($rating) : ?string
{
    if ($rating == null) {
        return null;
    }

    return is_numeric($rating) ? (string) $rating : null;
}

function parse_release_date($release_date) : ?string
{
    $release_date = trim($release_date);
    $date = DateTime::createFromFormat('Y-m-d', $release_date);
    return $date ? $date->format('Y-m-d') : null;
}
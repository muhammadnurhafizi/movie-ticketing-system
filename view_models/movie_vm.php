<?php

class MovieViewModel {
    public $id;
    public $title;
    public $genre;
    public $duration;
    public $rating;
    public $release_date;

    public function __construct($id, $title, $genre, $duration, $rating, $release_date) {
        $this->id = $id;
        $this->title = $title;
        $this->genre = $genre;
        $this->duration = $duration;
        $this->rating = $rating;
        $this->release_date = $release_date;
    }

    public static function fromArray($arr) {
        return new self(
            $arr['id'],
            self::format_title($arr['title']),
            self::format_genre($arr['genre']),
            self::format_duration($arr['duration']),
            self::format_rating($arr['rating']),
            self::format_release_date($arr['release_date'])
        );
    }

    private static function format_title($title) {
        return ucwords(strtolower($title));
    }

    private static function format_duration($duration) {
        $hours = floor($duration / 60);
        $minutes = $duration % 60;
        return "{$hours}h {$minutes}m";
    }

    private static function format_rating($rating) {
        if ($rating === null)
            return "N/A";
        return "{$rating}/10";
    }

    private static function format_release_date($release_date) {
        return date("F j, Y", strtotime($release_date));
    }

    private static function format_genre($genre) {
        $json_genre = json_decode($genre, true);
        $arr_genre = array_column($json_genre, 'name');
        $str_genre = implode(", ", $arr_genre);
        return ucwords(strtolower($str_genre));
    }
}
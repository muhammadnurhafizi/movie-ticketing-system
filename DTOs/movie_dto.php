<?php

class MovieDTO {
    public int $id;
    public string $title;
    public DateTime $release_date;
    public ?float $rating;
    public int $duration;
    public string $genre;

    public function __construct($id, $title, $genre, $duration, $rating, $release_date) {
        $this->id           = $id;
        $this->title        = $title;
        $this->genre        = $genre;
        $this->duration     = $duration;
        $this->rating       = $rating;
        $this->release_date = $release_date;
    }
}
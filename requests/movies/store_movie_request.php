<?php

class StoreMovieRequest
{
    public string $title;
    public DateTime|bool $releaseDate;
    public ?float $rating;
    public int $duration;
    public array $genres = [];

    public array $data = [];
    public array $errors = [];

    private const ALLOWED_GENRES = [
        'action',
        'adventure',
        'comedy',
        'fantasy',
        'horror',
        'romance',
        'sci-fi',
        'slice of life'
    ];

    public function __construct(array $data)
    {
        $this->title        = $this->sanitizeTitle($data['title'] ?? '');
        $this->releaseDate  = $this->sanitizeReleaseDate($data['release_date'] ?? '');
        $this->rating       = $this->sanitizeRating($data['rating'] ?? null);
        $this->duration     = $this->sanitizeDuration($data['duration'] ?? '');
        $this->genres       = $this->sanitizeGenres($data['genres'] ?? []);

        $this->data         = $data;
    }

    public function is_valid() 
    {
        if (sizeof($this->errors) == 0) return true;
        return false;
    }

    public function old(string $key, $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function has_error(string $key): bool
    {
        return isset($this->errors[$key]);
    }

    public function error(string $key): ?string
    {
        return $this->errors[$key] ?? null;
    }

    private function sanitizeTitle(string $title): string
    {
        if (empty($title)) {
            $this->errors['title'] = 'Title is required';
        }
        return trim(strip_tags($title));
    }

    private function sanitizeReleaseDate(string $date): DateTime|bool
    {
        if (empty($date)) {
            $this->errors['release_date'] = 'Release date is required';
            return false;
        }

        $dt = DateTime::createFromFormat('Y-m-d', $date);

        if (!$dt) {
            $this->errors['release_date'] = 'Invalid release date format';
        }

        return $dt;
    }

    private function sanitizeRating($rating): ?float
    {
        if ($rating === null || $rating === '') {
            return null;
        }

        if ($rating < 0 || $rating > 10) {
            $this->errors['rating'] = 'Rating must be between 0 and 10';
            return null;
        }

        $rating = filter_var($rating, FILTER_VALIDATE_FLOAT);

        return $rating === false ? null : $rating;
    }

    private function sanitizeDuration($duration): int
    {
        if ($duration == '') {
            $this->errors['duration'] = 'Duration is required';
            return false;
        }

        if ($duration <= 0) {
            $this->errors['duration'] = 'Duration must be more than 0 minutes';
            return false;
        }

        $duration = filter_var($duration, FILTER_VALIDATE_INT);

        if ($duration === false || $duration <= 0) {
            throw new InvalidArgumentException('Invalid duration');
        }

        return $duration;
    }

    private function sanitizeGenres($genres): array
    {
        if (sizeof($genres) === 0) {
            $this->errors['genres'] = 'At least one genre must be selected';
            return [];
        }

        return array_values(array_unique(
            array_intersect($genres, self::ALLOWED_GENRES)
        ));
    }
}

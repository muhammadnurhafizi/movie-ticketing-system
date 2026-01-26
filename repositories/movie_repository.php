<?php

class MovieRepository {
    private mysqli $conn;

    public function __construct(mysqli $dbConnection) {
        $this->conn = $dbConnection;
    }

    public function get_movies() {
        $stmt = $this->conn->prepare("SELECT * FROM movie;");
        $stmt->execute();
        $result = $stmt->get_result();

        $movies = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $movie = MovieViewModel::fromArray($row);
                $movies[] = $movie;
            }
        }
        
        return $movies;
    }
}
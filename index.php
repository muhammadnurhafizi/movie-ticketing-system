<?php

$hostname = "localhost";
$username = "root";
$password = "AquaCrystal3012";
$database = "movie-ticketing-system";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM movie;";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "- Title: " . $row["title"] . "</br>";
        echo "- Genre: "  . $row["title"] . "</br>";
        echo "- Duration: "  . $row["duration"] . "</br>";
        echo "- Rating: "  . $row["rating"] . "</br>";
        echo "- Release Date: "  . $row["release_date"] . "</br>";
        echo "</br>";
    }
} else {
    echo "0 results";
}
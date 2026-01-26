<?php

class Database {
    private string $hostname;
    private string $username;
    private string $password;
    private string $database;
    private int $port;
    private ?mysqli $connection = null;

    public function __construct(
        string $hostname,
        string $username,
        string $password,
        string $database,
        int $port
    ) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }

    public function getConnection(): mysqli {
        if ($this->connection === null) {
            $this->connection = new mysqli(
                $this->hostname,
                $this->username,
                $this->password,
                $this->database,
                $this->port
            );

            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        }

        return $this->connection;
    }
}
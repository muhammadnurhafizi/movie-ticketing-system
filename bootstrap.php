<?php

// include configuration
$config_db = require_once 'config/database.php';

// include core functions
require_once 'core/database.php';

// initialize database connection
$conn = (new Database(
    $config_db['hostname'], 
    $config_db['username'],
    $config_db['password'],
    $config_db['database'],
    $config_db['port'],
))->getConnection();

// include view models
require_once 'view_models/movie_vm.php';

// include repositories
require_once 'repositories/movie_repository.php';

// initialize repositories
$movie_repo = new MovieRepository($conn);
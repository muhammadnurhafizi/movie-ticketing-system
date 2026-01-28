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

// include services
require_once 'services/movie_service.php';

// include controllers
require_once 'controllers/movie_controller.php';

// include requests
require_once 'requests/movies/store_movie_request.php';

// initialize repositories
$movie_repo = new MovieRepository($conn);

// initialize services  
$movie_service = new MovieService($movie_repo);

// initialize controllers
$movie_controller = new MovieController($movie_service);
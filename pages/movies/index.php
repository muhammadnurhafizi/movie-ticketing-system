<?php

require_once '../../bootstrap.php';

$movies = $movie_repo->get_movies();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
        crossorigin="anonymous">

    <title>Movies</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-12">
                <h3>Movies</h3>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Movie List</h5>
                            <a href="/pages/movies/create.php" class="btn btn-primary">Add New Movie</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Release Year</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Ratiing</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($movies as $index => $movie) : ?>
                                        <tr>
                                            <td scope="row"><?= $index + 1 ?></td>
                                            <td><?php echo htmlspecialchars($movie->title); ?></td>
                                            <td><?php echo htmlspecialchars($movie->release_date); ?></td>
                                            <td><?php echo htmlspecialchars($movie->genre); ?></td>
                                            <td><?php echo htmlspecialchars($movie->rating); ?></td>
                                            <td>
                                                <a 
                                                    href="<?php echo '/pages/movies/show.php?id=' . urlencode($movie->id); ?>" 
                                                    class="btn btn-sm btn-info">
                                                    View
                                                </a>
                                                <a 
                                                    href="<?php echo '/pages/movies/edit.php?id=' . urlencode($movie->id); ?>" 
                                                    class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>
                                                <a 
                                                    href="<?php echo '/pages/movies/delete.php?id=' . urlencode($movie->id); ?>" 
                                                    class="btn btn-sm btn-danger">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous">
    </script>
</body>

</html>
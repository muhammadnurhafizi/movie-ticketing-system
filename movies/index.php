<?php require_once 'index.code.php'; ?>

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
        <?php if (isset($success)): ?>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        <?= $success ?>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if (isset($error)): ?>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
        
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
                            <a href="/movies/create.php" class="btn btn-primary">Add New Movie</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Release Date</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Duration</th>
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
                                            <td><?php echo htmlspecialchars($movie->duration); ?></td>
                                            <td>
                                                <a 
                                                    href="<?php echo '/movies/show.php?id=' . urlencode($movie->id); ?>" 
                                                    class="btn btn-sm btn-info">
                                                    View
                                                </a>
                                                <a 
                                                    href="<?php echo '/movies/edit.php?id=' . urlencode($movie->id); ?>" 
                                                    class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-<?= htmlspecialchars($movie->id) ?>">Delete</button>

                                                <form action="/movies/delete.php" method="post">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($movie->id) ?>">

                                                    <div class="modal fade" id="modal-delete-<?= htmlspecialchars($movie->id) ?>" tabindex="-1" aria-labelledby="modal-delete-<?= htmlspecialchars($movie->id) ?>-title" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="modal-delete-<?= htmlspecialchars($movie->id) ?>-title">Delete Movie</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Delete movie <?= htmlspecialchars($movie->title); ?>?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="delete_movie" class="btn btn-danger">Yes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
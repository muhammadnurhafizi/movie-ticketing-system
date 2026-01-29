<?php require_once 'show.code.php'; ?>

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
                        <h5 class="card-title">Movie Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" value="<?= htmlspecialchars($movie->title) ?>" disabled>
                                <div class="text-danger mt-1" style="min-height: 1.5em;"></div>
                            </div>
                            <div class="col-12">
                                <label for="release_date" class="form-label">Release Date</label>
                                <input type="date" class="form-control" id="release_date" value="<?= htmlspecialchars($movie->release_date) ?>" disabled>
                                <div class="text-danger mt-1" style="min-height: 1.5em;"></div>
                            </div>
                            <div class="col-12">
                                <label for="rating" class="form-label">Rating</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="rating" step="0.01" value="<?= htmlspecialchars($movie->rating) ?>" disabled>
                                    <label for="rating" class="input-group-text">/ 10</label>
                                </div>
                                <div class="text-danger mt-1" style="min-height: 1.5em;"></div>
                            </div>
                            <div class="col-12">
                                <label for="duration" class="form-label">Duration</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="duration" step="1" value="<?= htmlspecialchars($movie->duration) ?>" disabled>
                                    <label for="duration" class="input-group-text">minutes</label>
                                </div>
                                <div class="text-danger mt-1" style="min-height: 1.5em;"></div>
                            </div>
                            <div class="col-12">
                                <label for="genre" class="form-label">Genre</label>
                                <div class="row">
                                    <?php foreach ($allowed_genres as $genre) : ?>
                                        <div class="col-12 col-md-4 col-lg-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="genre_<?= $genre ?>" <?= in_array($genre, $movie->genre, true) ? 'checked' : '' ?> disabled>
                                                <label for="genre_<?= $genre ?>" class="form-check-label"><?= htmlspecialchars(ucwords($genre)) ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="text-danger mt-1" style="min-height: 1.5em;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="<?= '/movies/index.php'; ?>" class="btn btn-secondary">Back</a>
                            <a href="<?php echo '/movies/edit.php?id=' . urlencode($movie->id); ?>" class="btn btn-warning">Edit</a>
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
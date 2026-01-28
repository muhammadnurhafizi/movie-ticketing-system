<?php

require_once '../../bootstrap.php';

$request = null;

$genres = array(
    'action',
    'adventure',
    'comedy',
    'fantasy',
    'horror',
    'romance',
    'sci-fi',
    'slice of life'
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = new StoreMovieRequest($_POST);

    if ($request->is_valid()) {
        $movie_controller->store_movie($request);
        header('Location: /pages/movies/index.php');
        exit;
    }
}

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
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Movie Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?= $request?->old('title') ?>">
                                        <?php if ($request?->has_error('title')): ?>
                                            <div class="text-danger mt-1">
                                                <small><?= $request?->error('title') ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="release_date" class="form-label">Release Date</label>
                                        <input type="date" class="form-control" id="release_date" name="release_date" value="<?= $request?->old('release_date') ?>">
                                        <?php if ($request?->has_error('release_date')): ?>
                                            <div class="text-danger mt-1">
                                                <small><?= $request?->error('release_date') ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Rating</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="rating" name="rating" step="0.01" value="<?= $request?->old('rating') ?>">
                                            <label for="rating" class="input-group-text">/ 10</label>
                                        </div>
                                        <?php if ($request?->has_error('rating')): ?>
                                            <div class="text-danger mt-1">
                                                <small><?= $request?->error('rating') ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="duration" name="duration" step="1" value="<?= $request?->old('duration') ?>">
                                            <label for="duration" class="input-group-text">minutes</label>
                                        </div>
                                        <?php if ($request?->has_error('duration')): ?>
                                            <div class="text-danger mt-1">
                                                <small><?= $request?->error('duration') ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="genre" class="form-label">Genre</label>
                                        <div class="row">
                                            <?php foreach ($genres as $genre) : ?>
                                                <div class="col-12 col-md-4 col-lg-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" value="<?= $genre ?>" id="genre_<?= $genre ?>" name="genres[]" <?= in_array($genre, $request?->old('genres')) ? 'checked' : '' ?>>
                                                        <label for="genre_<?= $genre ?>" class="from-check-label"><?= ucwords($genre) ?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                        <?php if ($request?->has_error('genres')): ?>
                                            <div class="text-danger mt-1">
                                                <small><?= $request?->error('genres') ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Create Movie</button>
                            </div>
                        </div>
                    </div>
                </form>
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
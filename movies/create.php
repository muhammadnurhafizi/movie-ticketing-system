<?php require_once 'create.code.php'; ?>

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
        <?php if (isset($errors['general'])): ?>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $errors['general'] ?>
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
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Movie Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>">
                                    <div class="text-danger mt-1" style="min-height: 1.5em;">
                                        <small><?= htmlspecialchars($errors['title'] ?? '') ?></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="release_date" class="form-label">Release Date</label>
                                    <input type="date" class="form-control" id="release_date" name="release_date" value="<?= htmlspecialchars($old['release_date'] ?? '') ?>">
                                    <div class="text-danger mt-1" style="min-height: 1.5em;">
                                        <small><?= htmlspecialchars($errors['release_date'] ?? '') ?></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="rating" class="form-label">Rating</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="rating" name="rating" step="0.01" value="<?= htmlspecialchars($old['rating'] ?? '') ?>">
                                        <label for="rating" class="input-group-text">/ 10</label>
                                    </div>
                                    <div class="text-danger mt-1" style="min-height: 1.5em;">
                                        <small><?= htmlspecialchars($errors['rating'] ?? '') ?></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="duration" class="form-label">Duration</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="duration" name="duration" step="1" value="<?= htmlspecialchars($old['duration'] ?? '') ?>">
                                        <label for="duration" class="input-group-text">minutes</label>
                                    </div>
                                    <div class="text-danger mt-1" style="min-height: 1.5em;">
                                        <small><?= htmlspecialchars($errors['duration'] ?? '') ?></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="genre" class="form-label">Genre</label>
                                    <div class="row">
                                        <?php foreach ($allowed_genres as $genre) : ?>
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="<?= htmlspecialchars($genre) ?>" id="genre_<?= $genre ?>" name="genres[]" <?= in_array($genre, $old['genres'] ?? [], true) ? 'checked' : '' ?>>
                                                    <label for="genre_<?= $genre ?>" class="form-check-label"><?= htmlspecialchars(ucwords($genre)) ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="text-danger mt-1" style="min-height: 1.5em;">
                                        <small><?= htmlspecialchars($errors['genres'] ?? '') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="<?= '/movies/index.php'; ?>" class="btn btn-secondary">Cancel</a>
                                <button type="submit" name="add_movie" class="btn btn-success">Save</button>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Galería - Usuario</title>
</head>

<body>
    <h1>Galería</h1>
    <div class="gallery-preview">
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $image): ?>
                    <div class="gallery-item">
                        <!-- Imagen -->
                        <div class="image-container">
                            <img src="<?= base_url('uploads/' . $image['filename']); ?>" class="custom-image">
                        </div>

                        <!-- Descripción -->
                        <div class="image-description">
                            <p><?= $image['description']; ?></p>
                        </div>

                        <!-- Acciones de Editar y Eliminar -->
                        <div class="image-actions">
                            <!-- Botón para abrir el modal de editar -->
                            <a href="<?= site_url('gallery/edit/' . $image['id']); ?>" class="btn btn-warning btn-sm">
                                </i> Edit
                            </a>

                            <a href="<?= site_url('gallery/delete/' . $image['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="container text-center mt-5">No images uploaded yet.</p>
            <?php endif; ?>
        </div>

</body>
<!-- Footer Section -->
<footer class="container text-center mt-5">
    <p>&copy; <?= date('Y'); ?> Your Application Name. All rights reserved.</p>
</footer>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
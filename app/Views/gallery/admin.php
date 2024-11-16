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
    <a href="<?= site_url('gallery/upload') ?> " class="btn btn-info mb-3">Subir Imagen</a>
    <?php if (!empty($images)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>               
                    <?php foreach ($images as $image): ?>
                        <tr>
                            <td>
                                <img src="<?= base_url('uploads/' . $image['filename']); ?>"  width="100">
                            </td>
                            <td><?= esc($image['description']); ?></td>
                            <td><?= esc($image['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>           
            </tbody>
        </table>

    <?php else: ?>
        <p>No hay imágenes para mostrar.</p>
    <?php endif; ?>


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
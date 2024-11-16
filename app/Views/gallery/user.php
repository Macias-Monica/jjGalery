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
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">
        Subir Imagen
    </button>

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
                            <img src="<?= base_url('uploads/' . $image['filename']); ?>">
                        </td>
                        <td><?= esc($image['description']); ?></td>
                        <td><?= esc($image['created_at']); ?></td>
                        <td>
                            <!-- Botón de editar -->
                            <button class="btn btn-info" title="Editar">
                               Editar
                            </button>
                            <!-- Botón de eliminar -->
                            <button class="btn btn-danger ml-2" title="Eliminar">
                                Eliminar
                            </button>
                            <!-- Botón de organizar -->
                            <button class="btn btn-primary ml-2" title="Organizar">
                                Organizar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>No hay imágenes para mostrar.</p>
    <?php endif; ?>


    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Subir Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="/gallery/uploadImage">
                        <div class="form-group">
                            <label for="image">Seleccionar Imagen</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="description">Descripción de la Imagen</label>
                            <input type="text" name="description" id="description" class="form-control">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Subir Imagen</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
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
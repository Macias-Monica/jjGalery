<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        h2,
        h1 {
            color: #007bff;
        }

        .btn-container {
            display: flex;
            gap: 15px;
        }

        .logout-link {
            float: right;
            color: #dc3545;
        }

        .logout-link:hover {
            text-decoration: underline;
        }


        /* Footer Section */
        footer {
            margin-top: 50px;
        }

        /* Contenedor de la galería */
        .gallery-preview {
            display: flex;
            flex-wrap: wrap;
            /* Para que las imágenes se acomoden en varias filas */
            justify-content: space-around;
            /* Para distribuir uniformemente las imágenes */
            gap: 20px;
            /* Espacio entre las imágenes */
        }

        /* Cada item de la galería */
        .gallery-item {
            width: 200px;
            /* Ancho fijo para las imágenes */
            text-align: center;
            /* Centrar el contenido dentro de cada imagen */
            border: 1px solid #ddd;
            /* Opcional, agregar un borde a la imagen */
            padding: 10px;
            /* Espaciado interno */
            border-radius: 10px;
            /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra sutil */
            background-color: #fff;
            /* Fondo blanco */
        }

        /* Estilo de la imagen */
        .custom-image {
            width: 100%;
            /* Hacer que la imagen ocupe todo el ancho disponible */
            height: auto;
            /* Mantener la relación de aspecto de la imagen */
            object-fit: cover;
            /* Cubrir el área sin deformar */
            border-radius: 8px;
            /* Bordes redondeados a la imagen */
        }

        /* Estilo para la descripción */
        .image-description {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .image-userName {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        /* Contenedor para los botones de acción (editar y borrar) */
        .image-actions {
            margin-top: 10px;
        }

        /* Botones de acción */
        .image-actions .btn {
            margin-right: 5px;
            font-size: 12px;
            padding: 5px 10px;
        }

        /* Asegurar que las imágenes no se desborden en pantallas pequeñas */
        @media (max-width: 768px) {
            .gallery-item {
                width: 45%;
                /* En pantallas pequeñas, las imágenes ocupan el 45% */
            }
        }

        @media (max-width: 480px) {
            .gallery-item {
                width: 100%;
                /* En pantallas muy pequeñas, cada imagen ocupa todo el ancho */
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Welcome, <?= session()->get('username'); ?></h2>
            <a href="/auth/logout" class="logout-link">Logout</a>
        </div>
        <p>This is the user dashboard, where you can manage your information and download data.</p>
    </header>

    <div class="container text-center mt-5">

    <h3>Admin Dashboard</h3>

    <!-- Tabla colapsable -->
    <div class="accordion" id="userImagesAccordion">
        <?php if (!empty($images)): ?>
            <?php 
            // Agrupar imágenes por usuario
            $groupedImages = [];
            foreach ($images as $image) {
                $groupedImages[$image['user_name']][] = $image;
            }
            ?>
            <?php foreach ($groupedImages as $userName => $userImages): ?>
                <div class="card">
                    <div class="card-header" id="heading-<?= esc($userName); ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?= esc($userName); ?>" aria-expanded="false" aria-controls="collapse-<?= esc($userName); ?>">
                                <?= esc($userName); ?> Gallery
                            </button>
                        </h5>
                    </div>
                    <div id="collapse-<?= esc($userName); ?>" class="collapse" aria-labelledby="heading-<?= esc($userName); ?>" data-parent="#userImagesAccordion">
                        <div class="card-body">
                            <div class="gallery-preview">
                                <?php foreach ($userImages as $image): ?>
                                    <div class="gallery-item">
                                        <!-- Imagen -->
                                        <div class="image-container">
                                            <img src="<?= base_url('uploads/' . $image['filename']); ?>" class="custom-image">
                                        </div>
                                        <!-- Descripción -->
                                        <div class="image-description">
                                            <p><?= esc($image['description']); ?></p>
                                        </div>
                                        <!-- Acciones -->
                                        <div class="image-actions">
                                            <a href="<?= site_url('gallery/edit/' . $image['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="<?= site_url('gallery/delete/' . $image['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta imagen?');">Eliminar</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay imágenes disponibles.</p>
        <?php endif; ?>
    </div>
</div>

        <!-- Modal de Editar Imagen -->
        <?php if (!empty($editImage)): ?>
            <div class="modal fade show d-block" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Imagen</h5>
                            <a href="<?= site_url('dashboard') ?>" class="close" aria-label="Close">&times;</a>
                        </div>
                        <form action="<?= site_url('gallery/update/' . $editImage['id']); ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <input type="text" name="description" id="description" class="form-control" value="<?= esc($editImage['description']); ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <!-- Footer Section -->
        <footer class="container text-center mt-5">
            <p>&copy; <?= date('Y'); ?> Your Application Name. All rights reserved.</p>
        </footer>

        <!-- Bootstrap JS and dependencies (optional) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
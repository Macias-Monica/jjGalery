<?php

namespace App\Controllers;

use App\Models\UserExportModel;
use CodeIgniter\Controller;

class ImageExportController extends Controller
{
    public function downloadUserDataImage()
    {
        // Cargar el modelo
        $userModel = new UserExportModel();
        $users = $userModel->findAll(); // Obtener todos los usuarios

        // Configuración de la imagen
        $width = 900;
        $height = 400 + (count($users) * 40); // Ajustar altura en base a la cantidad de usuarios
        $image = imagecreatetruecolor($width, $height);

        // Colores
        $bgColor = imagecolorallocate($image, 245, 245, 245); // Fondo gris claro
        $headerColor = imagecolorallocate($image, 40, 116, 240); // Azul para el encabezado
        $textColor = imagecolorallocate($image, 0, 0, 0); // Texto en negro
        $lineColor = imagecolorallocate($image, 200, 200, 200); // Color de líneas separadoras

        // Rellenar fondo
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

        // Dibujar encabezado
        imagefilledrectangle($image, 0, 0, $width, 80, $headerColor);
        
        // Usar fuente integrada en GD, Arial es una opción común disponible
        $fontSize = 5; // tamaño de fuente con imágenes de GD
        imagestring($image, $fontSize, 20, 30, 'Lista de Usuarios', $bgColor);

        // Posición inicial del texto
        $yPosition = 120;

        // Imprimir encabezados de columnas
        imagestring($image, $fontSize, 20, $yPosition, "ID", $textColor);
        imagestring($image, $fontSize, 100, $yPosition, "Nombre de Usuario", $textColor);
        imagestring($image, $fontSize, 300, $yPosition, "Email", $textColor);
        imagestring($image, $fontSize, 500, $yPosition, "Rol", $textColor);
        imagestring($image, $fontSize, 650, $yPosition, "Fecha de Creacion", $textColor);
        $yPosition += 20;

        // Dibujar una línea horizontal bajo los encabezados
        imageline($image, 20, $yPosition, $width - 20, $yPosition, $lineColor);
        $yPosition += 10;

        // Imprimir la información de cada usuario
        foreach ($users as $user) {
            imagestring($image, $fontSize, 20, $yPosition, $user['id'], $textColor);
            imagestring($image, $fontSize, 100, $yPosition, $user['username'], $textColor);
            imagestring($image, $fontSize, 300, $yPosition, $user['email'], $textColor);
            imagestring($image, $fontSize, 500, $yPosition, $user['role'], $textColor);
            imagestring($image, $fontSize, 650, $yPosition, $user['created_at'], $textColor);
            $yPosition += 30;

            // Dibujar línea horizontal entre cada usuario
            imageline($image, 20, $yPosition, $width - 20, $yPosition, $lineColor);
            $yPosition += 10;
        }

        // Preparar encabezados de descarga de imagen
        header("Content-type: image/png");
        header("Content-Disposition: attachment; filename=UserData.png");

        // Generar la imagen y enviarla al navegador
        imagepng($image);
        imagedestroy($image);
        exit;
    }
}

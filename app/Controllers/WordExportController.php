<?php

namespace App\Controllers;

use App\Models\UserExportModel;
use CodeIgniter\Controller;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class WordExportController extends Controller
{
    public function downloadUserDataWord()
    {
        // Cargar el modelo
        $userModel = new UserExportModel();
        $users = $userModel->findAll();  // Obtener todos los usuarios

        // Crear una instancia de PHPWord
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Agregar título
        $section->addText('Lista de Usuarios', ['bold' => true, 'size' => 16]);
        $section->addTextBreak(1);

        // Agregar la tabla y encabezados
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000)->addText("ID");
        $table->addCell(4000)->addText("Nombre de Usuario");
        $table->addCell(4000)->addText("Email");
        $table->addCell(2000)->addText("Rol");
        $table->addCell(3000)->addText("Fecha de Creación");

        // Rellenar la tabla con los datos de los usuarios
        foreach ($users as $user) {
            $table->addRow();
            $table->addCell(2000)->addText($user['id']);
            $table->addCell(4000)->addText($user['username']);
            $table->addCell(4000)->addText($user['email']);
            $table->addCell(2000)->addText($user['role']);
            $table->addCell(3000)->addText($user['created_at']);
        }

        // Crear el archivo Word en memoria
        $filename = "UserData.docx";
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Cache-Control: max-age=0');
        header('Expires: 0');
        header('Pragma: public');

        // Guardar el archivo en formato Word y enviarlo al navegador
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save("php://output");
        exit;
    }
}

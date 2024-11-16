<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\GalleryModel;
use CodeIgniter\Controller;

class Gallery extends Controller
{
    // Método principal para mostrar la galería
    public function index()
    {
        $username = session()->get('username');
        // Crear una instancia del UserModel
        $userModel = new UserModel();
        // Obtener el ID del usuario desde el UserModel
        $user = $userModel->getUserByUsername($username);
        $userId = $user['id']; // Obtener el ID del usuario
        $role = session()->get('role');
        // Cargar el modelo
        $galleryModel = new GalleryModel();

        // Obtener las imágenes de la base de datos
        $images = $galleryModel->getImages($role, $userId);
        if ($role == 'admin') {
            return view('gallery/admin', ['images' => $images]); // Cargar la vista de admin
        } elseif ($role == 'user') {
            return view('gallery/user', ['images' => $images]); // Cargar la vista de usuario
        } else {
            return redirect()->to('/error')->with('error', 'Acceso denegado.');
        }
    }
    // Método para subir una nueva imagen
    public function uploadImage()
    {
        // Obtener el archivo subido
        $file = $this->request->getFile('image');

        // Verificar si el archivo fue subido correctamente
        if ($file->isValid() && !$file->hasMoved()) {
            // Generar un nombre único para el archivo
            $newName = $file->getRandomName();

            // Mover el archivo al directorio de uploads
            $file->move(WRITEPATH . 'uploads', $newName);

            // Obtener la descripción
            $description = $this->request->getPost('description');

            // Obtener el id del usuario desde la sesión
            $user_id = session()->get('id');

            // Guardar la información de la imagen en la base de datos
            $model = new GalleryModel();
            $model->save([
                'user_id' => $user_id,
                'filename' => $newName,
                'description' => $description,
            ]);

            //cerrar el modal
            return view('gallery/user'); // Cargar la vista de usuario

        } 
    }
    
    
}

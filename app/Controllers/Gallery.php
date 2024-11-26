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
            // return view('gallery/admin', ['images' => $images]); // Cargar la vista de admin
            return view('gallery/admin', ['images' => $images]); // Cargar la vista de admin
        } elseif ($role == 'user') {
            // return view('gallery/user', ['images' => $images]); // Cargar la vista de usuario
            return view('dashboard/user', ['images' => $images]);
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
            $file->move(FCPATH . 'uploads', $newName);
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

            //redirecciona al dashboard principal
            return redirect()->to('/dashboard');
        }
    }
    // Método para actualizar la imagen
    public function update()
    {
        // Obtener datos del formulario
        $imageId = $this->request->getPost('image_id');
        $description = $this->request->getPost('description');
        $file = $this->request->getFile('image');

        // Cargar el modelo
        $model = new GalleryModel();

        // Verificar si la imagen existe
        $image = $model->find($imageId);
        if (!$image) {
            return redirect()->to('/gallery')->with('error', 'Imagen no encontrada');
        }

        // Procesar nueva imagen si se cargó
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $newName);

            // Actualizar imagen y descripción
            $model->update($imageId, [
                'filename' => $newName,
                'description' => $description,
            ]);
        } else {
            // Solo actualizar descripción
            $model->update($imageId, [
                'description' => $description,
            ]);
        }

        return redirect()->to('/gallery')->with('success', 'Imagen actualizada correctamente');
    }
    public function delete($id)
    {
        // Lógica para eliminar la imagen
        $model = new GalleryModel();
        if ($model->delete($id)) {
            return redirect()->to('/gallery')->with('success', 'Image deleted successfully.');
        }

        return redirect()->to('/gallery')->with('error', 'Image not found.');
    }
    public function edit($imageId)
    {
        // Cargar el modelo
        $model = new GalleryModel();

        // Obtener los datos de la imagen
        $image = $model->find($imageId);

        // Verificar si la imagen existe
        if (!$image) {
            return redirect()->to('/dashboard')->with('error', 'Imagen no encontrada.');
        }

        // Pasar la información al dashboard
        return view('dashboard/user', ['images' => $this->getUserImages(), 'editImage' => $image]);
    }

    // Método auxiliar para obtener las imágenes del usuario
    private function getUserImages()
    {
        $galleryModel = new GalleryModel();
        $role = session()->get('role');
        $userId = session()->get('id');
        return $galleryModel->getImages($role, $userId);
    }
}

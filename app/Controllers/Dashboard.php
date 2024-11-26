<?php

namespace App\Controllers;
use App\Models\GalleryModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $role = session()->get('role');
        $userId =session()->get('id'); // Obtener el ID del usuario
    
        //obtenemos las imagenes del usuario
        $galleryModel = new GalleryModel();
        $images = $galleryModel->getImages($role, $userId);
        if ($role === 'admin') {
          //  return view('dashboard/admin');
             return view('dashboard/admin', ['images' => $images]);

        } else {
           // return view('dashboard/user');
             return view('dashboard/user', ['images' => $images]);

        }
    }
}

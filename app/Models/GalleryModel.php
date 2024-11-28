<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','user_name','filename', 'description','create_at','update_at'];

   // Método para obtener imágenes basadas en el rol
   public function getImages($role,$userId)
   {
       if ($role === 'admin') {
           // Para el admin, puedes obtener todas las imágenes
           //return $this->findAll();
           return $this->select('user_id, user_name, id, filename, description')
           ->orderBy('user_name')
           ->findAll();
       } elseif ($role === 'user') {
           // Para el usuario, puedes filtrar las imágenes (ejemplo: solo las que son visibles)
           return $this->where('user_id', $userId)->findAll(); 
       } else {
           // En caso de rol desconocido, devolver vacío o manejar según sea necesario
           return [];
       }
   }
   public function saveImage($data)
   {
       return $this->save($data); // Guarda la imagen en la base de datos
   }

   

}

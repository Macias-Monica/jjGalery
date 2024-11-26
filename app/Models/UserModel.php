<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','username', 'email', 'password', 'role'];
    protected $useTimestamps = true;
    
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
    public function createUser($data)
    {
        return $this->insert($data);
    }
}

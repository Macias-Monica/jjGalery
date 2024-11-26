<?php

namespace App\Controllers;

use App\Models\UserModel;

use CodeIgniter\Controller;
use CodeIgniter\Encryption\Encryption;

class Auth extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerUser()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            return redirect()->to('/auth/register')->with('error', 'Passwords do not match');
        }

        $userModel = new UserModel();

        // Check if the username or email already exists
        if ($userModel->getUserByUsername($username)) {
            return redirect()->to('/auth/register')->with('error', 'Username already taken');
        }

        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user'  // Default role is user
        ];

        if ($userModel->createUser($data)) {
            //return redirect()->to('/auth/login')->with('success', 'Account created successfully');
            return redirect()->to('/')->with('success', 'Account created successfully');
        }

        return redirect()->to('/auth/register')->with('error', 'Registration failed');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginUser()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            //return redirect()->to('/auth/login')->with('error', 'Invalid username or password');
            return redirect()->to('/')->with('error', 'Invalid username or password');
        }

        // Store user info in session
        session()->set([
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ]);
    
        return redirect()->to('/dashboard');
    }



    public function logout()
    {
        session()->destroy();
        //return redirect()->to('/auth/login');
        return redirect()->to('/');
    }
}

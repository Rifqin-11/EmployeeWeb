<?php

namespace App\Controllers;

use App\Models\EmployeesModel;

class LoginController extends BaseController
{
    public function index(): string
    {
        return view('pages/LoginPage',);
    }

    public function auth()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = [
            'username' => $username,
            'password' => $this->request->getVar('password')
        ];

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $employeeModel = new EmployeesModel;
        $user = $employeeModel->getUser($username);
        
        if ($user){
            if ($password == $user['password']){
                $sessionData = [
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin'],  
                ];
                session()->set($sessionData);

                return redirect()->to('/Home');
            }
        }

        session()->setFlashdata('error', 'You have entered an invalid username or password');
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
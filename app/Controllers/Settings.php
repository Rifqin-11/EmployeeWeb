<?php

namespace App\Controllers;

use App\Database\Migrations\GuestBook;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;

class Settings extends BaseController
{
    public function index()
    {
        $employeesModel = new EmployeesModel();

        $email = session()->get('email');
        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        return view("pages/Settings", $data);
    }

    public function changeProfile()
    {
        
    }

}

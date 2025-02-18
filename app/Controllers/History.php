<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;

class History extends BaseController
{
    public function index()
    {
        $guestBookModel = new GuestBooksModel();
        $employeesModel = new EmployeesModel();

        $email = session()->get('email');
        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            $data['guests'] = $guestBookModel->getGuests(search: $keyword)->findAll();
        } else {
            $data['guests'] = $guestBookModel->getGuests($email, $keyword)->findAll();
        }

        return view("pages/History", $data);
    }

}

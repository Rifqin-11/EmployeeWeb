<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;

class History extends BaseController
{
    public function index()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }

        $guestBookModel = new GuestBooksModel();
        $employeesModel = new EmployeesModel();

        $email = session()->get('email');
        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            $data["totalVisitors"] = $guestBookModel->getTotalVisitors();
            $data['guests'] = $guestBookModel->getGuests(search: $keyword);
            
        } else {
            $data["totalVisitors"] = $guestBookModel->getTotalVisitors($user['id']);
            $data['guests'] = $guestBookModel->getGuests($email, $keyword);
        }

        return view("pages/History", $data);
    }

}

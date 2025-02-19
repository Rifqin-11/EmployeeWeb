<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;

class History extends BaseController
{
    protected $guestBookModel;
    protected $employeesModel;

    public function __construct()
    {
        $this->guestBookModel = new GuestBooksModel();
        $this->employeesModel = new EmployeesModel();
    }

    public function index()
    {
        $email = session()->get('email');

        $user = $this->employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            $data["totalVisitors"] = $this->guestBookModel->getTotalVisitors();

            $data['guests'] = $this->guestBookModel->getGuests(search: $keyword)->findAll();
            
        } else {
            $data["totalVisitors"] = $this->guestBookModel->getTotalVisitors($user['id']);

            $data['guests'] = $this->guestBookModel->getGuests($email, $keyword)->findAll();   
        }

        return view("pages/History", $data);
    }

}
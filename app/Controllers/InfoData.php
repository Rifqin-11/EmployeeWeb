<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;
use App\Models\RoomModel;

class InfoData extends BaseController
{
    public function index($id=null)
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }

        $guestBookModel = new GuestBooksModel();
        $employeesModel = new EmployeesModel();
        

        $email = session()->get('email');
        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        if ($id) {
            $roomModel = new RoomModel();
            $data['rooms'] = $roomModel->findAll();

            $data['guest'] = $guestBookModel->find($id);
            return view("pages/InfoData", $data);
        }

        // Tangkap keyword dari input pencarian
        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            if (!empty($keyword)) {
                $data['guests'] = $guestBookModel->searchGuests($keyword);
            } else {
                $data['guests'] = $guestBookModel->orderBy('created_at', 'DESC')->findAll();
            }
        } else {
            if (!empty($keyword)) {
                $data['guests'] = $guestBookModel->searchGuests($keyword);
            } else {
                $data['guests'] = $guestBookModel->getGuestsByEmail($email);
            }
        }

        return view("pages/InfoData", $data);
    }

}

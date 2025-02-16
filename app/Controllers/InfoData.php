<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;
use App\Models\RoomModel;
use App\Models\DocumentationsModel;

class InfoData extends BaseController
{
    protected $guestBookModel;

    public function __construct()
    {
        $this->guestBookModel = new GuestBooksModel();
    }
    
    public function index($id=null)
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }

        $employeesModel = new EmployeesModel();
        
        $email = session()->get('email');
        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        if ($id) {
            $roomModel = new RoomModel();
            $data['rooms'] = $roomModel->findAll();

            $data['guest'] = $this->guestBookModel->find($id);
            return view("pages/InfoData", $data);
        }

        // Tangkap keyword dari input pencarian
        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            if (!empty($keyword)) {
                $data['guests'] = $this->guestBookModel->searchGuests($keyword);
            } else {
                $data['guests'] = $this->guestBookModel->orderBy('created_at', 'DESC')->findAll();
            }
        } else {
            if (!empty($keyword)) {
                $data['guests'] = $this->guestBookModel->searchGuests($keyword);
            } else {
                $data['guests'] = $this->guestBookModel->getGuestsByEmail($email);
            }
        }

        return view("pages/InfoData", $data);
    }

    public function edit()
    {
        $status = $this->request->getVar('status');
        $guestbook_id = $this->request->getVar('guestbook-id');
        if ($status == 0){
            $data = [
                'id' => $guestbook_id,
                'room_id' => $this->request->getVar('room'),
                'date' => $this->request->getVar('date'),
                'start_at' => $this->request->getVar('start-at'),
                'end_at' => $this->request->getVar('end-at'),
                'status' => 1
            ];
            
            $this->guestBookModel->save($data);
            
        } else{
            $images = $this->request->getFileMultiple('images');

            $documentationsModel = new DocumentationsModel;
            $uploadPath = WRITEPATH . 'documentations/'.$guestbook_id;
            
            if(!is_dir($uploadPath)){
                mkdir($uploadPath, 0777, true);
            }

            foreach ($images as $image){
                if ($image->isValid()){
                    $image->move($uploadPath);
                } else {
                    // Menangani status rescheduled
                    $data = [
                        'id' => $guestbook_id,
                        'room_id' => $this->request->getVar('room'),
                        'date' => $this->request->getVar('date'),
                        'start_at' => $this->request->getVar('start-at'),
                        'end_at' => $this->request->getVar('end-at'),
                        'status' => 2
                    ];
                    $this->guestBookModel->save($data);
                    return redirect()->to('Home');
                }

                $data = [
                    'guestbook_id'  => $guestbook_id,
                    'image_name'    => $image->getClientName()
                ];
                
                $documentationsModel->insert($data);

                $data = [
                    'id' => $guestbook_id,
                    'status' => 3
                ];
                
                $this->guestBookModel->save($data);
            }
        }

        return redirect()->to('Home');
        
    }

}

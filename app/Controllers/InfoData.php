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

        $employeesModel = new EmployeesModel();
        
        $email = session()->get('email');
        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        if ($id) {
            $roomModel = new RoomModel();
            $allRooms = $roomModel->findAll();

            $guest = $this->guestBookModel->find($id);

            $unavaibleRooms = $this->guestBookModel->getAvaibleRooms($guest['date'], $guest['start_at'], $guest['end_at']);
            $unavaibleRoomIds = array_column($unavaibleRooms, 'id');
            $availableRooms = array_filter($allRooms, function($room) use ($unavaibleRoomIds) {
                return !in_array($room['id'], $unavaibleRoomIds);
            });

            if ($guest['room_id']){
                $data['selectedRoom'] = $roomModel->find($guest['room_id']);
            } else {
                $data['selectedRoom'] = null;
            }

            $data['rooms'] = $availableRooms;
            $data['guest'] = $guest;
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

    public function getRooms()
    {
        $date = $this->request->getVar('date');
        $start_at = $this->request->getVar('start_at');
        $end_at = $this->request->getVar('end_at');
        
        $roomModel = new RoomModel();
        $allRooms = $roomModel->findAll();

        $unavaibleRooms = $this->guestBookModel->getAvaibleRooms($date, $start_at, $end_at);
        $unavaibleRoomIds = array_column($unavaibleRooms, 'id');
        $availableRooms = array_filter($allRooms, function($room) use ($unavaibleRoomIds) {
            return !in_array($room['id'], $unavaibleRoomIds);
        });

        return $this->response->setJSON($availableRooms);
    }

    // public function uploadProcess()
    // {
    //     $guestbook_id = $this->request->getVar('guestbook-id');
        
    //     $documentationsModel = new DocumentationsModel();
        
    //     $uploadPath = WRITEPATH . 'documentations/' . $guestbook_id;
        
    //     if (!is_dir($uploadPath)) {
    //         mkdir($uploadPath, 0777, true);
    //     }
        
    //     $images = $this->request->getFileMultiple('images');
    //     $uploadedFiles = [];

    //     foreach ($images as $image) {
    //         if ($image->isValid() && !$image->hasMoved()) {
    //             $imageName = $image->getRandomName();
    //             $image->move($uploadPath, $imageName);
                
    //             // Simpan informasi gambar ke database
    //             $data = [
    //                 'guestbook_id' => $guestbook_id,
    //                 'image_name' => $imageName
    //             ];
    //             $documentationsModel->insert($data);

    //             $uploadedFiles[] = $imageName;
    //         }
    //     }

    //     return $this->response->setJSON([
    //         'status' => 'success',
    //         'message' => 'Files uploaded successfully!',
    //         'files' => $uploadedFiles
    //     ]);
    // }
}

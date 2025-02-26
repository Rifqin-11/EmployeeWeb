<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;
use App\Models\RoomModel;
use App\Models\DocumentationsModel;

class InfoData extends BaseController
{
    protected $guestBookModel;
    protected $employeesModel;

    public function __construct()
    {
        $this->guestBookModel = new GuestBooksModel();
        $this->employeesModel = new EmployeesModel();
    }
    
    public function index($id=null)
    {
        $employeesModel = new EmployeesModel();
        $roomModel = new RoomModel();
        
        $email = session()->get('email');
        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        $allRooms = $roomModel->findAll();

        $guest = $this->guestBookModel->find($id);

        $this->guestBookModel->update($guest['id'], [
            'date' => null,
            'start_at' => null,
            'end_at' => null
        ]);

        $unavaibleRoomIds = $this->guestBookModel->getAvaibleRooms($guest['date'], $guest['start_at'], $guest['end_at']);
        $availableRooms = array_filter($allRooms, function($room) use ($unavaibleRoomIds) {
            return !in_array($room['id'], $unavaibleRoomIds);
        });

        $this->guestBookModel->update($guest['id'], [
            'date' => $guest['date'],
            'start_at' => $guest['start_at'],
            'end_at' => $guest['end_at']
        ]);

        if ($guest['room_id']){
            $data['selectedRoom'] = $roomModel->find($guest['room_id']);
        } else {
            $data['selectedRoom'] = null;
        }

        $data['rooms'] = $availableRooms;
        $data['guest'] = $guest;

        $documentationsModel = new DocumentationsModel();
        $data['documentations'] = $documentationsModel->where('guestbook_id', $id)->findAll();

        return view("pages/InfoData", $data);
    }

    public function edit()
    {
        $status = $this->request->getVar('status');
        $guestbook_id = $this->request->getVar('guestbook-id');
    
        if ($status == 0) {
            $data = [
                'id'       => $guestbook_id,
                'room_id'  => $this->request->getVar('room'),
                'date'     => $this->request->getVar('date'),
                'start_at' => $this->request->getVar('start-at'),
                'end_at'   => $this->request->getVar('end-at'),
                'status'   => 1
            ];
    
            $this->guestBookModel->save($data);
            session()->setFlashdata('success', 'Data has been saved successfully!');
            
        } else {
            $images = $this->request->getFileMultiple('images');
            $documentationsModel = new DocumentationsModel;
            $uploadPath = FCPATH . 'documentations/' . $guestbook_id;
            
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
    
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $image->move($uploadPath);
                } else {
                    // Mengatasi status done tanpa upload image
                    if ($status == 3){
                        return redirect()->back()->with('success', 'No files have been uploaded');
                    }
                    
                    // Menangani status rescheduled
                    $data = [
                        'id'       => $guestbook_id,
                        'room_id'  => $this->request->getVar('room'),
                        'date'     => $this->request->getVar('date'),
                        'start_at' => $this->request->getVar('start-at'),
                        'end_at'   => $this->request->getVar('end-at'),
                        'status'   => 2
                    ];
                    $this->guestBookModel->save($data);
                    session()->setFlashdata('success', 'Data has been saved successfully with a rescheduled status!');
                    return redirect()->to(base_url('infodata/' . $guestbook_id));
                }
    
                $data = [
                    'guestbook_id' => $guestbook_id,
                    'image_name'   => $image->getClientName()
                ];
                $documentationsModel->insert($data);
    
                $data = [
                    'id'     => $guestbook_id,
                    'status' => 3
                ];
                $this->guestBookModel->save($data);
                session()->setFlashdata('success', 'Data has been saved successfully with a done status!');
            }
        }
    
        return redirect()->to(base_url('infodata/' . $guestbook_id));
    }
    

    public function getRooms()
    {
        $date = $this->request->getJSON(true)['date'] ?? null;
        $start_time = $this->request->getJSON(true)['start_at'] ?? null;
        $end_time = $this->request->getJSON(true)['end_at'] ?? null;
        $guest_id = $this->request->getJSON(true)['guest_id'] ?? null;
    
        if (empty($date) || empty($start_time) || empty($end_time)) {
            return $this->response->setJSON(['error' => 'Please provide date, start time, and end time']);
        }
        
        $lastData = $this->guestBookModel->find($guest_id);
        $this->guestBookModel->update($guest_id, [
            'date' => null,
            'start_at' => null,
            'end_at' => null
        ]);

        $roomModel = new RoomModel();
        $allRooms = $roomModel->findAll();
        
        $unavailableRoomIds = $this->guestBookModel->getAvaibleRooms($date, $start_time, $end_time);
    
        $availableRooms = array_values(array_filter($allRooms, function ($room) use ($unavailableRoomIds) {
            return !in_array($room['id'], $unavailableRoomIds);
        }));
        
        $this->guestBookModel->update($guest_id, [
            'date' => $lastData['date'],
            'start_at' => $lastData['start_at'],
            'end_at' => $lastData['end_at']
        ]);

        return $this->response->setJSON($availableRooms);
    }

    public function viewImage($guestbook_id, $image_name)
    {
        $path = FCPATH . 'documentations/' . $guestbook_id . '/' . $image_name;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response->setHeader('Content-Type', mime_content_type($path))->setBody(file_get_contents($path));
    }


    public function deleteImage($id)
    {
        $documentationsModel = new DocumentationsModel();
        $image = $documentationsModel->find($id);

        if ($image) {
            $filePath = FCPATH . 'documentations/' . $image['guestbook_id'] . '/' . $image['image_name'];

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $documentationsModel->delete($id);

            session()->setFlashdata('success', 'Image successfully deleted.');

            return $this->response->setJSON(['success' => true]);
        }

        session()->setFlashdata('error', 'Image not found.');

        return $this->response->setJSON(['success' => false, 'message' => 'Image not found']);
    }



}
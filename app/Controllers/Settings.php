<?php

namespace App\Controllers;

use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;

class Settings extends BaseController
{
    protected $guestBookModel;
    protected $employeesModel;
    protected $roomModel;

    public function __construct()
    {
        $this->guestBookModel = new GuestBooksModel();
        $this->employeesModel = new EmployeesModel();
        $this->roomModel = new RoomModel();
    }

    public function index()
    {
        $email = session()->get('email');
        $user  = $this->employeesModel->getUserByEmail($email);

        $data['user'] = $user;

        return view("pages/ProfileSettings", $data);
    }

    public function updateProfile()
    {
        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');
    
        $user = $this->employeesModel->find($id);
    
        $updateData = [
            'name'     => $this->request->getPost('name'),
            'position' => $this->request->getPost('position'),
            'email'    => $email,
            'phone'    => $this->request->getPost('phone'),
        ];
    
        // Handle photo removal
        if ($this->request->getPost('remove_photo')) {
            if ($user['photo'] && $user['photo'] != 'default.png') {
                $photoPath = FCPATH . $user['photo'];
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            $updateData['photo'] = 'default.png';
        }
    
        // Handle photo upload
        $photo = $this->request->getFile('profile_photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profile_photos/';
            
            $newName = $photo->getRandomName();
            $photo->move($uploadPath, $newName);
            $updateData['photo'] = $newName;
        }
    
        // Handle password change
        $currentPassword = $this->request->getPost('current_password');
        $newPassword     = $this->request->getPost('new_password');
    
        if (!empty($currentPassword) && !empty($newPassword)) {
            $currentPasswordHashed = sha1(sha1(md5($currentPassword)));
            if ($currentPasswordHashed == $user['password']) {
                $updateData['password'] = sha1(sha1(md5($newPassword)));
            } else {
                session()->setFlashdata('error', 'Current password is incorrect.');
                return redirect()->back();
            }
        }
    
        // Update user data
        if ($this->employeesModel->update($id, $updateData)) {

            $sessionData = [
                'email' => $email,
                'is_admin' => session()->get('is_admin')
            ];
            session()->set($sessionData);
    
            session()->setFlashdata('success', 'Profile updated successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to update profile.');
        }
    
        return redirect()->back();
    }
    
    public function RoomSettings()
    {
        $email = session()->get('email');
        $user  = $this->employeesModel->getUserByEmail($email);

        $data['user'] = $user;
        $data['rooms'] = $this->roomModel->findAll();

        return view("pages/RoomSettings", $data);
    }

    public function addRoom()
    {
        $roomName = $this->request->getPost('room_name');
        $roomDescription = $this->request->getPost('room_description');
    
        if (empty($roomName)) {
            return redirect()->back()->with('error', 'Room name is required.');
        }
    
        $this->roomModel->insert([
            'name' => $roomName,
            'description' => $roomDescription
        ]);
    
        return redirect()->back()->with('success', 'Room added successfully.');
    }
    
    public function editRoom()
    {
        $roomId = $this->request->getPost('room_id'); // Get ID from POST
        $roomName = $this->request->getPost('room_name');
        $roomDescription = $this->request->getPost('room_description');
    
        if (empty($roomId) || empty($roomName)) {
            return redirect()->back()->with('error', 'Room ID and name are required.');
        }
    
        $this->roomModel->update($roomId, [
            'name' => $roomName, 
            'description' => $roomDescription]
        );
    
        return redirect()->back()->with('success', 'Room updated successfully.');
    }
    
    public function deleteRoom($id)
    {
        $room = $this->roomModel->find($id);
    
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        $this->roomModel->delete($id);
    
        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

    public function EmployeeSettings()
    {
        $email = session()->get('email');
        $user  = $this->employeesModel->getUserByEmail($email);

        $data['user'] = $user;
        $data['employees'] = $this->employeesModel->findAll();

        return view("pages/EmployeeSettings", $data);
    }

    public function addEmployee()
    {
        $employeePassword = $this->request->getPost('employee_password');
        $employeePassword = sha1(sha1(md5($employeePassword)));
    
        $isAdmin = $this->request->getPost('is_admin') ? 1 : 0;
    
        $this->employeesModel->insert([
            'name'     => $this->request->getPost('employee_name'),
            'email'    => $this->request->getPost('employee_email'),
            'position' => $this->request->getPost('employee_position'),
            'password' => $employeePassword,
            'photo'    => 'default.png',
            'is_admin' => $isAdmin,
        ]);
    
        return redirect()->back()->with('success', 'Employee added successfully.');
    }    
    
    public function editEmployee()
    {
        $employeeId       = $this->request->getPost('employee_id');
        $employeeName     = $this->request->getPost('employee_name');
        $employeeEmail    = $this->request->getPost('employee_email');
        $employeePosition = $this->request->getPost('employee_position');
        $newPassword      = $this->request->getPost('new_password');
    
        if (empty($employeeId) || empty($employeeName) || empty($employeeEmail)) {
            return redirect()->back()->with('error', 'ID, name, and email cannot be empty.');
        }
    
        $employee = $this->employeesModel->find($employeeId);
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
    
        $updateData = [
            'name'     => $employeeName,
            'email'    => $employeeEmail,
            'position' => $employeePosition
        ];
    
        if (!empty($newPassword)) {
            $updateData['password'] = sha1(sha1(md5($newPassword)));
        }
    
        $db = \Config\Database::connect();
        $db->transStart();
    
        $this->employeesModel->update($employeeId, $updateData);
    
        $db->transComplete();
    
        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    
        if (session()->get('email') === $employee['email']) {
            session()->set('email', $employeeEmail);
        }
    
        return redirect()->back()->with('success', 'Employee updated successfully.');
    }
    
    
    public function deleteEmployee($id)
    {    
        $employee = $this->employeesModel->find($id);
    
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
    
        $this->employeesModel->delete($id);
    
        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }
}

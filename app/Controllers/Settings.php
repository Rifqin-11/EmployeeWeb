<?php

namespace App\Controllers;

use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;

class Settings extends BaseController
{
    //  Memeriksa sesi pengguna dan menyiapkan data
    protected $guestBookModel;
    protected $employeesModel;
    protected $roomModel;

    public function __construct()
    {
        $this->guestBookModel = new GuestBooksModel();
        $this->employeesModel = new EmployeesModel();
        $this->roomModel = new RoomModel();
    }
    
    private function prepareData()
    {
        $email = session()->get('email');
        $user  = $this->employeesModel->getUserByEmail($email);

        $data['user'] = $user;
        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            $data['guests'] = $this->guestBookModel->getGuests(search: $keyword);
        } else {
            $data['guests'] = $this->guestBookModel->getGuests($email, $keyword);
        }

        return $data;
    }

    /**
     * Render halaman dengan data
     */
    private function renderView(string $viewName)
    {
        $data = $this->prepareData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        return view($viewName, $data);
    }

    public function index()
    {
        return $this->renderView("pages/ProfileSettings");
    }

    public function updateProfile()
    {
        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');

        $user = $this->employeesModel->find($id);

        $updateData = [
            'name'      => $this->request->getPost('name'),
            'position'  => $this->request->getPost('position'),
            'email'     => $email,
            'phone'     => $this->request->getPost('phone'),
            'photo'     => $this->request->getPost('photo')
        ];

        if ($this->request->getPost('remove_photo')) {
            if ($user['photo'] !== 'default.png') {
                $photoPath = FCPATH . $user['photo'];
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            $updateData['photo'] = 'default.png';
        }

        $photo = $this->request->getFile('profile_photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profile_photos/';
            
            $newName = $photo->getRandomName();
            $photo->move($uploadPath, $newName);
            $updateData['photo'] = $newName;

            if ($user['photo'] !== 'default.png') {
                $oldPhotoPath = FCPATH . $user['photo'];
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
        }

        // Changing Password
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $currentPassword = sha1(sha1(md5($currentPassword))); // Hashing

        if (!empty($currentPassword && !empty($newPassword))) {
            if ($currentPassword == $user['password']) {
                $newPassword = sha1(sha1(md5($newPassword))); // Hashing
                $updateData['password'] = $newPassword;
            } else {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
        }

        if (!$this->employeesModel->update($id, $updateData)) {
            return redirect()->back()->with('error', 'Failed to update profile.');
        }

        if (session()->get('email') !== $email) {
            session()->set('email', $email);
        }

        return redirect()->to('/Settings')->with('success', 'Profile updated successfully.');
    }

    public function RoomSettings()
    {
        $email = session()->get('email');
        $user  = $this->employeesModel->getUserByEmail($email);

        $data['user'] = $user;
        $data['rooms'] = $this->roomModel->findAll();

        return view("pages/RoomSettings", $data);
    }

    // Menambah ruangan baru
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
    
        return redirect()->to('/settings/rooms')->with('success', 'Room added successfully.');
    }
    
    public function editRoom()
    {
        $roomId = $this->request->getPost('room_id'); // Ambil ID dari POST
        $roomName = $this->request->getPost('room_name');
        $roomDescription = $this->request->getPost('room_description');
    
        if (empty($roomId) || empty($roomName)) {
            return redirect()->back()->with('error', 'Room ID and name are required.');
        }
    
        $this->roomModel->update($roomId, [
            'name' => $roomName, 
            'description' => $roomDescription]
        );
    
        return redirect()->to('/RoomSettings')->with('success', 'Room updated successfully.');
    }
    
    
    public function deleteRoom($id)
    {
        $room = $this->roomModel->find($id);
    
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        $this->roomModel->delete($id);
    
        return redirect()->to('/RoomSettings')->with('success', 'Room deleted successfully.');
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
    
        $this->employeesModel->insert([
            'name'     => $this->request->getPost('employee_name'),
            'email'    => $this->request->getPost('employee_email'),
            'position' => $this->request->getPost('employee_position'),
            'password' => $employeePassword,
            'photo'    => 'default.png'
        ]);
    
        return redirect()->to('/settings/employees')->with('success', 'Employee added successfully.');
    }
    
    public function editEmployee()
    {
        $employeeId = $this->request->getPost('employee_id');
        $employeeName = $this->request->getPost('employee_name');
        $employeeEmail = $this->request->getPost('employee_email');
        $employeePosition = $this->request->getPost('employee_position');
    
        if (empty($employeeId) || empty($employeeName) || empty($employeeEmail)) {
            return redirect()->back()->with('error', 'ID, nama, dan email tidak boleh kosong.');
        }
    
        $employee = $this->employeesModel->find($employeeId);
        if (!$employee) {
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan.');
        }
    
        $db = \Config\Database::connect();
        $db->transStart();
    
        $this->employeesModel->update($employeeId, [
            'name' => $employeeName,
            'email' => $employeeEmail,
            'position' => $employeePosition
        ]);
    
        $db->transComplete();
    
        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }
    
        if (session()->get('email') === $employee['email']) {
            session()->set('email', $employeeEmail);
        }
    
        return redirect()->to('/settings/employees')->with('success', 'Karyawan berhasil diperbarui.');
    }
    
    public function deleteEmployee($id)
    {    
        $employee = $this->employeesModel->find($id);
    
        if (!$employee) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        $this->employeesModel->delete($id);
    
        return redirect()->to('/settings/employees')->with('success', 'Room deleted successfully.');
    }
    
}
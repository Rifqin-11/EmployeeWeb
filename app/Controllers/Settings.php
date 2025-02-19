<?php

namespace App\Controllers;

use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;

class Settings extends BaseController
{
    /**
     * Memeriksa sesi pengguna dan menyiapkan data
     */
    private function prepareData()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }

        $guestBookModel = new GuestBooksModel();
        $employeesModel = new EmployeesModel();
        $email = session()->get('email');
        $user  = $employeesModel->getUserByEmail($email);

        $data['user'] = $user;
        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            $data['guests'] = $guestBookModel->getGuests(search: $keyword);
        } else {
            $data['guests'] = $guestBookModel->getGuests($email, $keyword);
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

    /**
     * Tampilkan halaman settings utama
     */
    public function index()
    {
        return $this->renderView("pages/ProfileSettings");
    }

    public function updateProfile()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }
    
        $employeesModel = new EmployeesModel();
    
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $position = $this->request->getPost('position');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
    
        $updateData = [
            'name' => $name,
            'position' => $position,
            'email' => $email,
            'phone' => $phone
        ];
    
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
    
        if (!empty($currentPassword) && !empty($newPassword)) {
            $user = $employeesModel->find($id);
    
            if (password_verify($currentPassword, $user['password'])) {
                $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            } else {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
        }
    
        $employeesModel->update($id, $updateData);
    
        session()->set([
            'email' => $email,
            'name' => $name,
            'position' => $position
        ]);
    
        return redirect()->to('/Settings')->with('success', 'Profile updated successfully.');
    }
    


    /**
     * Menampilkan daftar ruangan dan mengelolanya
     */
    public function RoomSettings()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }

        $employeesModel = new EmployeesModel();
        $roomModel = new RoomModel();
        $email = session()->get('email');
        $user  = $employeesModel->getUserByEmail($email);

        $data['user'] = $user;
        $data['rooms'] = $roomModel->findAll();

        return view("pages/RoomSettings", $data);
    }

    /**
     * Menambah ruangan baru
     */
    public function addRoom()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }
    
        $roomModel = new RoomModel();
        $roomName = $this->request->getPost('room_name');
        $roomDescription = $this->request->getPost('room_description');
    
        if (empty($roomName)) {
            return redirect()->back()->with('error', 'Room name is required.');
        }
    
        $roomModel->insert([
            'name' => $roomName,
            'description' => $roomDescription
        ]);
    
        return redirect()->to('/settings/rooms')->with('success', 'Room added successfully.');
    }
    
    public function editRoom()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }
    
        $roomModel = new RoomModel();
        $roomId = $this->request->getPost('room_id'); // Ambil ID dari POST
        $roomName = $this->request->getPost('room_name');
        $roomDescription = $this->request->getPost('room_description');
    
        if (empty($roomId) || empty($roomName)) {
            return redirect()->back()->with('error', 'Room ID and name are required.');
        }
    
        $roomModel->update($roomId, ['name' => $roomName, 'description' => $roomDescription]);
    
        return redirect()->to('/RoomSettings')->with('success', 'Room updated successfully.');
    }
    
    
    public function deleteRoom($id)
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }
    
        $roomModel = new RoomModel();
        $room = $roomModel->find($id);
    
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        $roomModel->delete($id);
    
        return redirect()->to('/RoomSettings')->with('success', 'Room deleted successfully.');
    }

    public function EmployeeSettings()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }

        $employeesModel = new EmployeesModel();
        $email = session()->get('email');
        $user  = $employeesModel->getUserByEmail($email);

        $data['user'] = $user;
        $data['employees'] = $employeesModel->findAll();

        return view("pages/EmployeeSettings", $data);
    }

    public function addEmployee()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }
    
        $employeesModel = new EmployeesModel();
        $employeeName = $this->request->getPost('employee_name');
        $employeeEmail = $this->request->getPost('employee_email');
        $employeePosition = $this->request->getPost('employee_position');
        $employeePassword = $this->request->getPost('employee_password');
    
        if (empty($employeeName)) {
            return redirect()->back()->with('error', 'Room name is required.');
        }
    
        $employeesModel->insert([
            'name' => $employeeName,
            'email' => $employeeEmail,
            'position' => $employeePosition,
            'password' => $employeePassword
        ]);
    
        return redirect()->to('/settings/employees')->with('success', 'Employee added successfully.');
    }
    
    public function editEmployee()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }
    
        $employeesModel = new EmployeesModel();
        $employeeId = $this->request->getPost('employee_id');
        $employeeName = $this->request->getPost('employee_name');
        $employeeEmail = $this->request->getPost('employee_email');
        $employeePosition = $this->request->getPost('employee_position');
    
        if (empty($employeeId) || empty($employeeName) || empty($employeeEmail)) {
            return redirect()->back()->with('error', 'ID, nama, dan email tidak boleh kosong.');
        }
    
        $employee = $employeesModel->find($employeeId);
        if (!$employee) {
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan.');
        }
    
        $db = \Config\Database::connect();
        $db->transStart();
    
        $employeesModel->update($employeeId, [
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
        if (!session()->has('email')) {
            return redirect()->to('/');
        }
    
        $employeesModel = new EmployeesModel();
        $employee = $employeesModel->find($id);
    
        if (!$employee) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        $employeesModel->delete($id);
    
        return redirect()->to('/settings/employees')->with('success', 'Room deleted successfully.');
    }
    
}

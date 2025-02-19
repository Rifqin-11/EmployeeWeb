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
        $employeeName = $this->request->getPost('employee_name');
        $employeeEmail = $this->request->getPost('employee_email');
        $employeePosition = $this->request->getPost('employee_position');

        $employeeId = $this->request->getPost('employee_id');

        if (empty($employeeId) || empty($employeeName)) {
            return redirect()->back()->with('error', 'Room ID and name are required.');
        }
    
        $employeesModel->update($employeeId, ['name' => $employeeName, 'email' => $employeeEmail, 'position' => $employeePosition]);
    
        return redirect()->to('/settings/employees')->with('success', 'Room updated successfully.');
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

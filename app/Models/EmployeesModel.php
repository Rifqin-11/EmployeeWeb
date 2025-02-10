<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeesModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['name', 'password', 'email', 'is_admin', 'photo'];

    public function getMeetingWith() {
        return $this->db->table('employees')
                        ->select('employees.id, name, position')
                        ->join('guestbooks', 'employees.id=guestbooks.employee_id')
                        ->get()
                        ->getResultArray();
    }

    public function getUser($username) {
        return $this->where('name', $username)
                    ->select('email, password, is_admin')
                    ->orWhere('email', $username)
                    ->first();
                }
                
    public function getUserByEmail ($email) {
        return $this->where('email', $email)
                    ->first();

    }
}
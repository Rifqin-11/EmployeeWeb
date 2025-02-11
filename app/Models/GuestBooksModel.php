<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class GuestBooksModel extends Model
{
    protected $table            = 'guestbooks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['institutionName', 'pic_name', 'phone_number', 'employee_id', 'agenda', 'identity_photo', 'status', 'room_id', 'date', 'start_at', 'end_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function getGuestsByEmail($email){
        return $this->select('guestbooks.id, pic_name, institution_name, phone_number, agenda, created_at, updated_at, status')
                    ->join('employees', 'employees.id = guestbooks.employee_id')
                    ->where('employees.email', $email)
                    ->orderBy('guestbooks.created_at', 'DESC')
                    ->findAll();
    }

    public function searchGuestsByEmail($email, $search)
    {
        return $this->select('id, pic_name, institution_name, phone_number, agenda, created_at, updated_at, status')
                    ->join('employees', 'employees.id = guestbooks.employee_id')
                    ->where('employees.email', $email)
                    ->groupStart()
                        ->like('pic_name', $search)
                        ->orLike('institution_name', $search)
                    ->groupEnd()
                    ->orderBy('guestbooks.created_at', 'DESC')
                    ->findAll();
    }

        public function searchGuests($keyword)
    {
        return $this->select('pic_name, institution_name, phone_number, agenda, created_at, updated_at, status')
                    ->like('pic_name', $keyword)
                    ->orLike('institution_name', $keyword)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
    
    public function getTotalVisitorsLastMonth($month, $id = '')
    {
        $result = $this->where('created_at >=', date('Y-m-d H:i:s', strtotime('-'.$month.' month')));
        if ($id){
            $result->where('employee_id', $id);
        }
        return $result->countAllResults();
    }

    public function getTotalVisitors($id = ''){
        if ($id){
            return $this->where('employee_id', $id)->countAllResults();
        }
        return $this->countAllResults();
    }

}
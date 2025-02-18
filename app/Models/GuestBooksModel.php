<?php

namespace App\Models;

use CodeIgniter\Model;

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

    public function getGuests($email = null, $search = null, $statusFilter = []){
        $result = $this->select('guestbooks.id, pic_name, institution_name, phone_number, employees.name as employee_name, agenda, created_at, updated_at, status')
               ->join('employees', 'employees.id = guestbooks.employee_id', 'left');

        if($email){
            $result->where('employees.email', $email);
        }

        if (!empty($statusFilter)) {
            $result->whereIn('status', $statusFilter);
        }

        if ($search){
            $result->groupStart()
                    ->like('pic_name', $search)
                    ->orLike('institution_name', $search)
                    ->orLike('employees.name', $search)
                    ->groupEnd();
        }

        return $result->orderBy('guestbooks.created_at', 'DESC');
    }

    public function getPendingVisitorsCount($id = null)
    {
        $query = $this->where('status', 0);

        if ($id) {
            $query->where('employee_id', $id);
        }

        return $query->countAllResults();
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

    public function getAvaibleRooms($date = null, $start_time = null, $end_time = null)
    {
        return $this->select('rooms.id, rooms.name')
            ->where('date', $date)
            ->groupStart()
                ->where('start_at <=', $end_time)
                ->where('end_at >=', $start_time)
            ->groupEnd()
            ->groupBy('room_id')
            ->join('rooms', 'rooms.id = guestbooks.room_id')
            ->findAll();
    }

    public function getIdGuests($email)
    {
        $result = $this->select('guestbooks.id')
                    ->join('employees', 'employees.id = guestbooks.employee_id')
                    ->where('employees.email', $email)
                    ->findAll();
        return array_column($result, 'id');
    }

}
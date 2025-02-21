<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;

class Home extends BaseController
{
    protected $guestBookModel;
    protected $employeesModel;

    public function __construct()
    {
        $this->guestBookModel = new GuestBooksModel();
        $this->employeesModel = new EmployeesModel();
    }

    public function index()
    {
        $email = session()->get('email');

        if (!$email) {
            return redirect()->to('/');
        }
        
        // Calendar
        $month = $this->request->getGet("month") ?? date("m");
        $year = $this->request->getGet("year") ?? date("Y");

        $month = max(1, min(12, (int)$month));
        $year = max(1900, (int)$year);

        $data["calendar"] = $this->generateCalendar($year, $month);
        $data["currentMonth"] = $month;
        $data["currentYear"] = $year;

        
        // Home View
        $user = $this->employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        if (!$user) {
            session()->destroy();
            return redirect()->to('/');
        }

        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            $totalVisitorMonthly = $this->guestBookModel->getTotalVisitorsLastMonth(1);
            $data["totalVisitors"] = $this->guestBookModel->getTotalVisitors();

            $data['pendingVisitors'] = 'We have total ' . $this->guestBookModel->getPendingVisitorsCount();

            $data['guests'] = $this->guestBookModel->getGuests(search: $keyword, statusFilter: [0, 1, 2])->findAll();
            
        } else {
            $totalVisitorMonthly = $this->guestBookModel->getTotalVisitorsLastMonth(1, $user['id']);
            $data['pendingVisitors'] = 'You have ' . $this->guestBookModel->getPendingVisitorsCount($user['id']);
            $data["totalVisitors"] = $this->guestBookModel->getTotalVisitors($user['id']);

            $data['guests'] = $this->guestBookModel->getGuests($email, $keyword, statusFilter: [0, 1, 2])->findAll();   
        }

        $totalVisitor2Monthly = $this->guestBookModel->getTotalVisitorsLastMonth(2, $user['id']);

        $totalLast2Month = $totalVisitor2Monthly - $totalVisitorMonthly;

        if ($totalLast2Month != 0) {
            $percentageLastMonth = (($totalLast2Month - $totalVisitorMonthly) / $totalLast2Month) * 100;
            $percentageLastMonth = sprintf('%+d', $percentageLastMonth) . '% from last month';
        } else {
            $percentageLastMonth = "You don't have any visitors at 2 months ago";
        }

        $data['percentageLastMonth'] = $percentageLastMonth;
        $data["totalVisitorsMonthly"] = $totalVisitorMonthly;

        return view("pages/Home", $data);
    }

    public function notificationModal()
    {
        $email = session()->get('email');
        $user = $this->employeesModel->getUserByEmail($email);

        if ($user['is_admin'] == 1) {
            $guests = $this->guestBookModel->getGuests(statusFilter:[0])->paginate(3);
        } else {
            $guests = $this->guestBookModel->getGuests($email, statusFilter:[0])->paginate(3);
        }
        
        for($i = 0; $i < count($guests); $i++){
            $guests[$i]['created_at'] = time_parsing($guests[$i]['created_at']);
        }

        $data['guests'] = $guests;
        return $this->response->setJSON($data);
    }

    private function generateCalendar($year, $month)
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $firstDayOfWeek = date('w', strtotime("$year-$month-01"));

        $calendar = [];
        $week = [];

        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $week[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $week[] = $day;
            if (count($week) === 7) {
                $calendar[] = $week;
                $week = [];
            }
        }

        if (count($week) > 0) {
            while (count($week) < 7) {
                $week[] = null;
            }
            $calendar[] = $week;
        }

        return $calendar;
    }
}
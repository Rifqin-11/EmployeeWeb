<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;
use App\Models\EmployeesModel;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->has('email')) {
            return redirect()->to('/');
        }

        $guestBookModel = new GuestBooksModel();
        $employeesModel = new EmployeesModel();
        $email = session()->get('email');

        $user = $employeesModel->getUserByEmail($email);
        $data['user'] = $user;

        // Calendar
        $data["guest"] = $guestBookModel->paginate(9);
        $data["pager"] = $guestBookModel->pager;

        $month = $this->request->getGet("month") ?? date("m");
        $year = $this->request->getGet("year") ?? date("Y");

        $month = max(1, min(12, (int)$month));
        $year = max(1900, (int)$year);

        $data["calendar"] = $this->generateCalendar($year, $month);
        $data["currentMonth"] = $month;
        $data["currentYear"] = $year;
    
        $keyword = $this->request->getGet('search');

        if ($user['is_admin'] == 1) {
            $totalVisitorMonthly = $guestBookModel->getTotalVisitorsLastMonth(1);
            $data["totalVisitors"] = $guestBookModel->getTotalVisitors();

            $data['guests'] = $guestBookModel->getGuests(search: $keyword);

        } else {
            $totalVisitorMonthly = $guestBookModel->getTotalVisitorsLastMonth(1, $user['id']);
            $data["totalVisitors"] = $guestBookModel->getTotalVisitors($user['id']);

            $data['guests'] = $guestBookModel->getGuests($email, $keyword);   
        }
        
        $totalVisitor2Monthly = $guestBookModel->getTotalVisitorsLastMonth(2, $user['id']);

        $totalLast2Month = $totalVisitor2Monthly - $totalVisitorMonthly;

        if ($totalLast2Month != 0) {
            $percentageLastMonth = (($totalLast2Month - $totalVisitorMonthly) / $totalLast2Month) * 100;
            $percentageLastMonth = sprintf('%+d', $percentageLastMonth) . '% from last month';
        } else {
            $percentageLastMonth = "You don't have any visitors at 2 months ago";
        }

        $data['percentageLastMonth'] = $percentageLastMonth;
        $data["totalVisitorsMonthly"] = $totalVisitorMonthly;
        $data['pendingTotal'] = $guestBookModel->where('status', 0)->countAllResults();

        return view("pages/Home", $data);
    }
    

    private function generateCalendar($year, $month)
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); // Total hari dalam bulan
        $firstDayOfWeek = date('w', strtotime("$year-$month-01")); // Hari pertama bulan (0 = Minggu, 6 = Sabtu)

        $calendar = [];
        $week = [];

        // Isi hari kosong sebelum hari pertama bulan
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $week[] = null;
        }

        // Isi hari dalam bulan
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $week[] = $day;

            // Jika sudah satu minggu, tambahkan ke kalender
            if (count($week) === 7) {
                $calendar[] = $week;
                $week = [];
            }
        }

        // Tambahkan hari kosong setelah akhir bulan
        if (count($week) > 0) {
            while (count($week) < 7) {
                $week[] = null;
            }
            $calendar[] = $week;
        }

        return $calendar;
    }
}

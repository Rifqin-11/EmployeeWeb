<?php

namespace App\Controllers;
use App\Models\GuestBooksModel;

class LoginController extends BaseController
{
    public function index(): string
    {
        return view('pages/LoginPage',);
    }
}

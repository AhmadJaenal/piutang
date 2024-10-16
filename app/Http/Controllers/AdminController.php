<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employees;
use App\Models\Partners;

class AdminController extends Controller
{
    public function admin()
    {
        $users = User::count();
        $employees = Employees::count();
        $partners = Partners::count();

        $data = array(
            'users' => $users,
            'employees' => $employees,
            'partners' => $partners,
        );

        return view('admin.home', $data);
    }
}

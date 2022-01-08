<?php

namespace App\Http\Controllers\HREmployee;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return inertia('HREmployee/User/Index', [
            'users' => User::paginate()
        ]);
    }

    public function approve(User $user)
    {
        $user->approvedBy()->associate(auth()->user())->save();

        return redirect()->route('HREmployee.users.index')->with('status', 'تم السماح له بنجاح');
    }
}

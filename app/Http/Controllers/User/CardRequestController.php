<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Rules\GmailOnly;
use App\Rules\SaudiNationalId;
use Illuminate\Http\Request;

class CardRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (!auth()->user()->canRequestCard()) {
                return redirect()->route('employee-cards.index')->withErrors('لا يمكنك طلب بطاقة جديدة ولديك طلب قيد الانتظار أو لديك بطاقة فعالة');
            }

            if (!auth()->user()->isCardExpired()) {
                return redirect()->route('employee-cards.index')->withErrors('لم تنته بطاقتك بعد');
            }

            return $next($request);
        })->only(['create', 'store']);
    }

    public function create()
    {
        return inertia('User/EmployeeCard/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'department_name' => ['required', 'string', 'max:255'],
            'national_id' => ['required', 'string', new SaudiNationalId()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new GmailOnly()],
            'photo' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
        ]);

        auth()->user()->cardRequests()->create([
            'name' => $request->name,
            'department_name' => $request->department_name,
            'national_id' => $request->national_id,
            'email' => $request->email,
            'photo' => $request->photo->store('employee-cards', 'public'),
        ]);

        return redirect()->route('employee-cards.index')->with('status', 'تم إنشاء طلب البطاقة بنجاح');

    }
}

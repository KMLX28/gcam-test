<?php

namespace App\Http\Controllers;

use Storage;

class EmployeeCardController extends Controller
{
    public function index()
    {
        return inertia('User/EmployeeCard/Index', [
            'card' => auth()->user()->card,
            'cardRequest' => auth()->user()->lastCardRequest
        ]);
    }

    public function download()
    {
        abort_if(auth()->user()->isCardExpired(), 403);

        return Storage::download(auth()->user()->card->pdf);
    }
}

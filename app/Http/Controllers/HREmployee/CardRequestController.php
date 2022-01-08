<?php

namespace App\Http\Controllers\HREmployee;

use App\Exports\CardRequestsExport;
use App\Http\Controllers\Controller;
use App\Models\CardRequest;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class CardRequestController extends Controller
{
    public function index()
    {
        return inertia('HREmployee/CardRequest/Index', [
            'cardRequests' => CardRequest::with('user')->paginate()
        ]);
    }

    public function show(CardRequest $cardRequest)
    {
        return inertia('HREmployee/CardRequest/Show', ['cardRequest' => $cardRequest]);
    }

    public function accept(CardRequest $cardRequest)
    {
        DB::transaction(function() use ($cardRequest) {
            $cardRequest->approvedByHREmployee()->associate(auth()->user())->save();

            $cardRequest->processIfCompletelyApproved();
        });

        return redirect()->route('HREmployee.card-requests.index')->with('status', 'تم الموافقة على بالطلب بنجاح');
    }

    public function reject(CardRequest $cardRequest)
    {
        $cardRequest->reject()->save();

        return redirect()->route('HREmployee.card-requests.index')->with('status', 'تم رفض الطلب بنجاح');
    }

    public function export()
    {
        return Excel::download(new CardRequestsExport(), 'card-requests.xlsx');
    }
}

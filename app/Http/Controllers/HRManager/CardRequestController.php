<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\CardRequest;
use DB;

class CardRequestController extends Controller
{
    public function index()
    {
        return inertia('HRManager/CardRequest/Index', [
            'cardRequests' => CardRequest::with('user')->paginate()
        ]);
    }

    public function show(CardRequest $cardRequest)
    {
        return inertia('HRManager/CardRequest/Show', ['cardRequest' => $cardRequest]);
    }

    public function accept(CardRequest $cardRequest)
    {
        DB::transaction(function() use ($cardRequest) {
            $cardRequest->approvedByHRManager()->associate(auth()->user())->save();

            $cardRequest->processIfCompletelyApproved();
        });
        return redirect()->route('HRManager.card-requests.index')->with('status', 'تم الموافقة على بالطلب بنجاح');
    }

    public function reject(CardRequest $cardRequest)
    {
        $cardRequest->reject()->save();

        return redirect()->route('HRManager.card-requests.index')->with('status', 'تم رفض الطلب بنجاح');
    }
}

<?php

namespace App\Jobs;

use App\Models\CardRequest;
use App\Models\EmployeeCard;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;
use Str;

class CreateEmployeeCardJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected CardRequest $cardRequest)
    {
    }

    public function handle()
    {
        if (!Storage::exists('employee-cards-pdf')) {
            Storage::makeDirectory('employee-cards-pdf');
        }

        $pdfPath = 'employee-cards-pdf/' . Str::uuid() . '.pdf';
        $pdf = PDF::loadView('pdf.employee-card', ['cardRequest' => $this->cardRequest])->output();

        Storage::put($pdfPath, $pdf);

        EmployeeCard::create([
            'user_id' => $this->cardRequest->user_id,
            'name' => $this->cardRequest->name,
            'department_name' => $this->cardRequest->department_name,
            'national_id' => $this->cardRequest->national_id,
            'email' => $this->cardRequest->email,
            'photo' => $this->cardRequest->photo,
            'pdf' => $pdfPath,
            'expire_at' => now()->addYear()
        ]);
    }
}

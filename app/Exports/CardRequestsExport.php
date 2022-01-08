<?php

namespace App\Exports;

use App\Models\CardRequest;
use Maatwebsite\Excel\Concerns\FromCollection;

class CardRequestsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return CardRequest::all(['name', 'national_id', 'email', 'department_name']);
    }
}

<?php

namespace App\Exports;

use App\Models\ReservationTypes;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReservationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ReservationTypes::all();
    }
}

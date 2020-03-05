<?php

namespace App\Exports;

use App\Customer;
use App\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehiclesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vehicle::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Author ID',
            'Customer ID',
            'Make',
            'Model',
            'Year',
            'Color',
            'Body Type',
            'License Plate',
            'VIN',
            'Comments',
            'Created At',
            'Last Updated At',
            'Deleted At',
            'Last Seen At',
            'Current Mileage',
        ];
    }
}

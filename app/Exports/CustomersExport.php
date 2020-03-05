<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Author ID',
            'First Name',
            'Last Name',
            'Home Phone',
            'Cell Phone',
            'Email',
            'Comments',
            'Email Reminders',
            'SMS Reminders',
            'Created At',
            'Last Updated At',
            'Deleted At',
        ];
    }
}

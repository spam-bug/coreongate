<?php

namespace App\Exports;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientsExport implements FromView
{
    public $start_date;
    public $end_date;

    public function __construct($start_date, $end_date) {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function view(): View {
        return view('admin.reports.excel', [
            'clients' => Client::all(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Client::all();
    // }

    // public function headings(): array
    // {
    //     return [
    //         [
    //             'COREONGATE'
    //         ],
    //         [
    //             'Client #',
    //             'Name',
    //             'Username',
    //             'Email',
    //             'Membership Plan',
    //             'Expiration',
    //             'Created At',
    //             'Last Active',
    //         ]
    //     ];
    // }

    // public function map($client): array {

    //     if($client->monitoring->count() > 0) {
    //         if($client->monitoring->last()->check_out) {
    //             $status = date('M d, Y', strtotime($client->monitoring->last()->check_out));
    //         } else {
    //             $status = date('M d, Y', strtotime($client->monitoring->last()->check_in));
    //         }
    //     } else {
    //         $status = 'N/A';    
    //     }

    //     return [
    //         $client->id,
    //         ucfirst($client->first_name) . ' ' . ucfirst($client->last_name),
    //         $client->username,
    //         $client->email,
    //         ($client->plan->first()) ? $client->plan->first()->name : 'No current plan',
    //         ($client->plan->first() && $client->plan->first()->pivot->end_date) ? date('M d, Y', strtotime($client->plan->first()->pivot->end_date)) : 'No Expiration',
    //         date('M d, Y', strtotime($client->created_at)),
    //         $status,

    //     ];
    // }


}

<?php

namespace App\Exports;

use App\Models\Districts;
use App\Models\Tracking;
use Maatwebsite\Excel\Sheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


// use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Events\BeforeSheet;
// use Maatwebsite\Excel\Concerns\WithEvents;

// use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithColumnWidth;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TrackingsExport implements FromView, WithStyles, WithEvents
{

    public $month_year;
    public $districts;
    public function __construct($month_year, $districts)
    {
        $this->month_year = $month_year;
        $this->districts = $districts;
    }

    public function view(): View
    {

        if ($this->month_year == 'all' && $this->districts == 'all') {

            return view('exports.tracking', [
                'tracking' =>  $tracking=Tracking::select('*', 'trackings.created_at')
                    ->join('districts', 'trackings.districts_id', 'districts.districts_id')
                    ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
                    ->join('users', 'trackings.users_id', 'users.id')
                    ->get(),
                'title'=>'รายงานการติดตามเอกสาร ทุกตำบล ทุกช่วงเวลา',
            ]);
        } else if ($this->month_year == 'all') {

            $districts_name = Districts::where('districts_id',$this->districts)->first();
            return view('exports.tracking', [
                'tracking' =>  $tracking=Tracking::select('*', 'trackings.created_at')
                    ->join('districts', 'trackings.districts_id', 'districts.districts_id')
                    ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
                    ->join('users', 'trackings.users_id', 'users.id')
                    ->where('trackings.districts_id', '=', $this->districts)->get(),
                'title'=>'รายงานการติดตามเอกสาร '.$districts_name->districts_name.' ทุกช่วงเวลา',
            ]);
        } else if ($this->districts == 'all') {
            $districts_name = Districts::where('districts_id',$this->districts)->first();
            $month = substr($this->month_year, 0, strpos($this->month_year, "-"));
            $year = explode("-", $this->month_year);
            return view('exports.tracking', [
                'tracking' => $tracking= Tracking::select('*', 'trackings.created_at')
                ->join('districts', 'trackings.districts_id', 'districts.districts_id')
                    ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
                    ->join('users', 'trackings.users_id', 'users.id')
                    ->whereYear('trackings.created_at', '=', $year[1])
                    ->whereMonth('trackings.created_at', '=', $month)
                    ->get(),
                    'title'=>'รายงานการติดตามเอกสาร ทุกตำบล '.formatDatemonth("01-".$this->month_year),
            ]);

        } else {

            $districts_name = Districts::where('districts_id',$this->districts)->first();
            $month = substr($this->month_year, 0, strpos($this->month_year, "-"));
            $year = explode("-", $this->month_year);
            return view('exports.tracking', [
                'tracking' =>  $tracking=Tracking::select('*', 'trackings.created_at')
                    ->join('districts', 'trackings.districts_id', 'districts.districts_id')
                    ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
                    ->join('users', 'trackings.users_id', 'users.id')
                    ->whereYear('trackings.created_at', '=', $year[1])
                    ->whereMonth('trackings.created_at', '=', $month)
                    ->where('trackings.districts_id', '=', $this->districts)->get(),
                    'title'=>'รายงานการติดตามเอกสาร '.$districts_name->districts_name .' '.formatDatemonth("01-".$this->month_year),
            ]);
        }

    }

    public function registerEvents(): array
    {
        return [
            afterSheet  ::class    => function(afterSheet   $event) {
                // $event->sheet->getDelegate()->getStyle('A1:Z999')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

            // $event->sheet->getDelegate()
            // ->getStyle('A1:K1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $event->sheet->getDelegate()->GetcolumnDimension('A')->setWidth(7);
            $event->sheet->getDelegate()->GetcolumnDimension('B')->setWidth(20);
            $event->sheet->getDelegate()->GetcolumnDimension('C')->setWidth(35);
            $event->sheet->getDelegate()->GetcolumnDimension('D')->setWidth(32);
            $event->sheet->getDelegate()->GetcolumnDimension('E')->setWidth(50);
            $event->sheet->getDelegate()->GetcolumnDimension('F')->setWidth(60);
            $event->sheet->getDelegate()->GetcolumnDimension('G')->setWidth(70);
            $event->sheet->getDelegate()->GetcolumnDimension('H')->setWidth(50);
            $event->sheet->getDelegate()->GetcolumnDimension('I')->setWidth(20);
            $event->sheet->getDelegate()->GetcolumnDimension('J')->setWidth(25);

            $event->sheet->getPageSetup();
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A1:Z999')->getFont()->setName('TH SarabunPSK');
        $sheet->getStyle('A1:Z999')->getFont()->setSize('16');

        // $sheet->getStyle('A1:K11')->getFont()->setBold(true);

        $sheet->mergeCells('A1:J1');
        // $sheet->mergeCells('J1:K1');
    }

}

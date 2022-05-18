<?php

namespace App\Exports;

use App\Models\Calendar;
use App\Models\Tracking;
use App\Models\Districts;
use App\Models\User;
use Maatwebsite\Excel\Sheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Events\BeforeSheet;


// use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Events\BeforeExport;
// use Maatwebsite\Excel\Concerns\WithEvents;

// use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
// use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithColumnWidth;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CalendarExport implements FromView, WithStyles, WithEvents
{

    public $id;
    public $month;
    public $year;
    public function __construct($id,$month,$year)
    {
        $this->id = $id;
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {


        if($this->id=='all'){
            $calendar =   Calendar::select('*')
            ->leftJoin('users', 'calendars.user_id', '=', 'users.id')
            
            ->whereYear('calendars.start', '=', $this->year)
            ->whereMonth('calendars.start', '=',    $this->month)
            ->orderBy('start','asc')
            ->get();

            return view('exports.calendar', [
                'calendar' => $calendar ,
                'status' => 'all' ,
                'title'=>'รายงานกำหนดการ ทั้งหมด' ,
            ]);

        }else{
            $calendar =   Calendar::select('*')
            ->join('users', 'calendars.user_id', '=', 'users.id')
            ->whereYear('calendars.start', '=', $this->year)
            ->whereMonth('calendars.start', '=', $this->month)
            ->where('calendars.user_id', $this->id )
            ->orderBy('start','asc')
            ->get();
            $user = User::where('id',$this->id)->first();
            return view('exports.calendar', [
                'calendar' => $calendar ,
                'status' => 'id' ,
                'title'=>'รายงานกำหนดการ '.$user->name,
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
            $event->sheet->getDelegate()->GetcolumnDimension('A')->setWidth(10);
            $event->sheet->getDelegate()->GetcolumnDimension('B')->setWidth(40);
            $event->sheet->getDelegate()->GetcolumnDimension('C')->setWidth(40);
            $event->sheet->getDelegate()->GetcolumnDimension('D')->setWidth(60);
            $event->sheet->getDelegate()->GetcolumnDimension('E')->setWidth(100);
            $event->sheet->getDelegate()->GetcolumnDimension('F')->setWidth(50);
            // $event->sheet->getDelegate()->GetcolumnDimension('G')->setWidth(30);
            // $event->sheet->getDelegate()->GetcolumnDimension('H')->setWidth(30);
            // $event->sheet->getDelegate()->GetcolumnDimension('I')->setWidth(20);

            $event->sheet->getPageSetup();
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A1:Z999')->getFont()->setName('TH SarabunPSK');
        $sheet->getStyle('A1:Z999')->getFont()->setSize('16');

        // $sheet->getStyle('A1:K11')->getFont()->setBold(true);

        $sheet->mergeCells('A1:F1');
        // $sheet->mergeCells('J1:K1');
    }

}

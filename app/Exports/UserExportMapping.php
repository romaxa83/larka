<?php

namespace App\Exports;

use App\Models\User\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExportMapping implements FromCollection, WithMapping, WithHeadings, WithEvents, ShouldAutoSize
{

    /**
     * @return Collection
     */
    public function collection()
    {
        return User::with('roles')->get();
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            $user->getRolesString(),
            $user->created_at->toDateString()
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Phone', 'Roles', 'Created at'
        ];
    }

    /**
     * @see https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#styles
     * добавляем стили для таблицы
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // headers
                // добавляем размер title
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                // автоматическое выравнивание колонок по контексту
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

                $event->sheet->getDelegate()->getStyle('A1:D4')
                    ->getAlignment()->setWrapText(true);

                // добавляем крансую обводку
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000']
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle('B2:G8')->applyFromArray($styleArray);
            }
        ];
    }
}
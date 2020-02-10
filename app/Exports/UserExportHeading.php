<?php

namespace App\Exports;

use App\Models\User\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExportHeading implements FromCollection, WithHeadings, WithEvents
{

    /**
     * @return Collection|\Tightenco\Collect\Support\Collection
     */
    public function collection()
    {
//        $users = User::select(['name', 'email', 'created_at'])->get();
        $users = User::all();

        // через каждые три записи пустая строка
        $final_collection = [];
        foreach ($users->chunk(3) as $chunk){
            $final_collection = array_merge($final_collection, $chunk->toArray(), [[]]);
        }

        return collect($final_collection);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name', 'Email', 'Created at'
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        // если нам нужно обьединить заголовки (в место first_name, last_name, указать просто name)
        // также в методе headings вставлем пустое значени для той колонки которую обьеденяем (['name', '', 'email', 'phone'])
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('B1:C1');
                $event->sheet->getDelegate()->getStyle('B1')->getAlignment()->setHorizontal('center');
            }
        ];
    }
}
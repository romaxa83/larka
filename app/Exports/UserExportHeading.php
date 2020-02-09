<?php

namespace App\Exports;

use App\Models\User\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExportHeading implements FromCollection, WithHeadings
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
}
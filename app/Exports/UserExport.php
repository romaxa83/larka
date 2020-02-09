<?php

namespace App\Exports;

use App\Models\User\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{

    /**
     * @return Collection
     */
    public function collection()
    {
        // вытягивает данные из таблицы
        // можно использовать любые запросы
        return User::all();
    }
}
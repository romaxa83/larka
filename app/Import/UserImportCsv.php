<?php

namespace App\Import;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImportCsv implements ToModel, WithCustomCsvSettings, WithHeadingRow
{

    public function model(array $row)
    {
//        dd($row);
        return new User([
            'id' => $row[0],
            'name' => $row[1],
            'email' => $row[2],
            'phone' => $row[3],
            'password' => 'password',
        ]);
    }

    /**
     * задаем настройки для импорта
     * @return array
     */
    public function getCsvSettings(): array
    {
        // разбивает строку по разделителю на массив (по умолчанию запятая)
        return [
            'delimiter' => ';'
        ];
    }

    // указываем на какой строке находяться загаловок (если он есть)
    // и используя WithHeadingRow,заполнять можно через заголови($row['email'])
    public function headingRow()
    {
        return 1;
    }
}

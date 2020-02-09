<?php

namespace App\Import;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{

    public function model(array $row)
    {
        return new User([
            'name' => $row[2],
            'email' => $row[3],
            'phone' => $row[4],
            'password' => 'password',
        ]);
    }
}

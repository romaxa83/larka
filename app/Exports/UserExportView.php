<?php

namespace App\Exports;

use App\Models\User\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class UserExportView implements FromView
{
    /**
     * экспортирует данные из таблицы (представление должно содержать только таблицу)
     * @return View
     */
    public function view(): View
    {
        $users = (new UserRepository())->getAll();

        return view('admin.user.user-table', compact('users'));
    }
}
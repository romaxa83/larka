<?php

namespace App\Console\Commands;

use App\Models\User\User;
use App\Models\User\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;

/**
 * Class CreateAdmin
 *
 * @package App\Console\Commands
 */
class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $email = 'admin@admin.com';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(User::where('email', $this->email)->count()){
            $this->info('Admin is exists');
            return;
        }
        $admin = new User();
        $admin->name = 'admin';
        $admin->password = Hash::make('admin');
        $admin->email = $this->email;
        $admin->status = User::STATUS_ACTIVE;
        $admin->save();

        $admin->setRole(Role::ADMIN_ALIAS);

        $this->info('Admin created.');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhoneVerifyToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email')->comment('Телефон');
            $table->boolean('phone_verified')->default(false)->after('phone')->comment('Потвержден ли телефон');
            $table->string('phone_verify_token')->nullable()->after('phone_verified')->comment('Токен для потверждения');
            $table->timestamp('phone_verify_token_expire')->nullable()->after('phone_verify_token')->comment('Время жизни токена');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('phone_verified');
            $table->dropColumn('phone_verify_token');
            $table->dropColumn('phone_verify_token_expire');
        });
    }
}
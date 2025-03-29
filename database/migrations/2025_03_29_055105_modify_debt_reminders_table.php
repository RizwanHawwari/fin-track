<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->string('amount')->change(); // Ubah amount dari integer ke string
            $table->text('description')->nullable()->change(); // Pastikan cukup panjang
        });
    }

    public function down()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->integer('amount')->change(); // Kembalikan amount ke integer
            $table->string('description', 255)->nullable()->change(); // Kembalikan ke string 255 karakter
        });
    }
};


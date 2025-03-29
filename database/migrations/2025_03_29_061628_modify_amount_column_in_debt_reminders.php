<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change(); // Ubah ke decimal(15,2)
        });
    }

    public function down()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->string('amount')->change(); // Balikin ke string kalau rollback
        });
    }
};


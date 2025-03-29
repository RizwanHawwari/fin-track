<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->string('counterparty')->after('title'); // Nama pemberi/penerima hutang
        });
    }

    public function down()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->dropColumn('counterparty');
        });
    }
};


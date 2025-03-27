<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('budgets', function (Blueprint $table) {
            $table->string('month', 7)->change(); // Ubah jadi VARCHAR(7)
        });
    }

    public function down() {
        Schema::table('budgets', function (Blueprint $table) {
            $table->date('month')->change(); // Balik ke DATE kalau rollback
        });
    }
};

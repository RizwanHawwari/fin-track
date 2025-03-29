<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->string('title')->after('user_id');
        });
    }
    
    public function down()
    {
        Schema::table('debt_reminders', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }    
};

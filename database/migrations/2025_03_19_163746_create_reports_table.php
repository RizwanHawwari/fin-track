<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                    table: 'users', indexName: 'reports_user_id'
            );
            $table->enum('type', ['daily', 'weekly', 'monthly']);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_income', 15, 2);
            $table->decimal('total_expense', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

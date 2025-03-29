<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('debt_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pengguna yang memiliki hutang
            $table->string('title'); // Judul reminder, misal "Cicilan Motor"
            $table->text('description')->nullable(); // Deskripsi tambahan
            $table->decimal('amount', 15, 2); // Jumlah hutang
            $table->date('due_date'); // Tanggal jatuh tempo
            $table->enum('status', ['pending', 'paid'])->default('pending'); // Status pembayaran
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('debt_reminders');
    }
};

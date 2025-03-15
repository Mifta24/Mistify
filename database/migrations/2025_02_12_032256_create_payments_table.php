<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('payment_number')->unique();  // Nomor pembayaran unik
            $table->decimal('amount', 10, 2);  // Jumlah pembayaran
            $table->enum('payment_method', [
                'bank_transfer',
                'e_wallet',
                'credit_card',
                'cash_on_delivery'
            ]);
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed',
                'refunded'
            ])->default('pending');
            $table->string('payment_proof')->nullable();  // Bukti pembayaran (image/file)
            $table->string('bank_name')->nullable();  // Nama bank (jika transfer bank)
            $table->string('account_number')->nullable();  // Nomor rekening
            $table->string('account_name')->nullable();  // Nama pemilik rekening
            $table->text('notes')->nullable();  // Catatan pembayaran
            $table->timestamp('paid_at')->nullable();  // Waktu pembayaran berhasil
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};

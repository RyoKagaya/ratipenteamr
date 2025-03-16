<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('credit_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('ユーザーID');
            $table->integer('amount')->comment('クレジット変動量（負の値なら消費、正の値なら購入）');
            $table->enum('type', ['purchase', 'task_usage'])->comment('取引タイプ（購入 or タスク消費）');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('credit_transactions');
    }
};


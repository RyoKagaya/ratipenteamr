<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->comment('タスクID');
            $table->foreignId('user_id')->constrained()->comment('ユーザーID');
            $table->string('title')->comment('タイトル');
            $table->text('comment')->comment('コメント');
            $table->dateTime('deadline')->comment('期限');
            $table->enum('status', ['未完了', '進行中', '完了'])->default('未完了')->comment('ステータス');
            $table->boolean('is_displayed_on_main')->default(false)->comment('メイン画面表示フラグ');
            $table->dateTime('completed_at')->nullable()->comment('完了日時');
            $table->boolean('is_deleted')->default(false)->comment('削除フラグ');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

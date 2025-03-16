<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('is_bpo_task')->default(false)->after('status')->comment('BPOタスクかどうか');
            $table->integer('required_credits')->nullable()->after('is_bpo_task')->comment('BPOに必要なクレジット');
            $table->foreignId('assignee_id')->nullable()->constrained('users')->after('required_credits')->comment('BPOタスクの担当者');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('is_bpo_task');
            $table->dropColumn('required_credits');
            $table->dropForeign(['assignee_id']);
            $table->dropColumn('assignee_id');
        });
    }
};

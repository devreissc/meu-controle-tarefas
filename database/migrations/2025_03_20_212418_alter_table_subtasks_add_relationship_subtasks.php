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
        Schema::table('subtasks', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable()->after('id');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subtasks', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
            $table->dropColumn('task_id');
        });
    }
};

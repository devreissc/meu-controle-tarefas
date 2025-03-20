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
        Schema::create('subtasks', function (Blueprint $table) {
            $table->id();
            $table->string('subtask_name', 255);
            $table->text('subtask_description')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->dateTime('completed_at')->nullable();
            $table->string('status')->default('opened');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtasks');
    }
};

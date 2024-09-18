<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('developer_id')->constrained('developers')->onDelete('cascade');
            $table->enum('task_status', ['done', 'progress', 'not_started']);
            $table->boolean('is_overtime')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_reports');
    }
};

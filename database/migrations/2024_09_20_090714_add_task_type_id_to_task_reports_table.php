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
        Schema::table('task_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('task_type_id')->nullable()->after('id');
            $table->foreign('task_type_id')->references('id')->on('task_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_reports', function (Blueprint $table) {
            $table->dropForeign(['task_type_id']);
            $table->dropColumn('task_type_id');
        });
    }
};

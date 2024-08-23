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
        Schema::table('cen_tasks', function (Blueprint $table) {
            $table->string('model', 100)->nullable()->change();
            $table->string('serial_number', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cen_tasks', function (Blueprint $table) {
            $table->string('model', 100)->nullable(false)->change();
            $table->string('serial_number', 100)->nullable(false)->change();
        });
    }
};

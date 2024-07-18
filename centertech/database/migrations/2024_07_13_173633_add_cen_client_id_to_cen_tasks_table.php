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
            
            $table->foreignId('cen_client_id')
                ->after('id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cen_tasks', function (Blueprint $table) {
            $table->dropForeign(['cen_client_id']);
            $table->dropColumn('cen_client_id');
        });
    }
};
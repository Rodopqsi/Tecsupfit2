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
        Schema::table('cupones', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('stock');
        });
    }
    
    public function down(): void
    {
        Schema::table('cupones', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }

};

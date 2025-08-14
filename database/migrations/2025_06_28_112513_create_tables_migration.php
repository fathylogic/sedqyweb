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
         Schema::create('centers', function (Blueprint $table) {
            $table->id()->primary();;
            $table->string('name')->unique();
            $table->nu('parent_id');
            $table->string('location');
            $table->string('center_address');
            $table->string('woter_no');
            $table->string('electric_no');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables_migration');
    }
};

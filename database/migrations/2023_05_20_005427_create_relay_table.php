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
        Schema::create('relay', function (Blueprint $table) {
            $table->id();
            $table->string('name_relay')->comment('relay 1 , 2, 3, 4');
            $table->string('keterangan')->comment('relay 1 : nyalakan motor');
            $table->integer('status')->default(0)->comment('1 aktif, 0 tidak aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relay');
    }
};

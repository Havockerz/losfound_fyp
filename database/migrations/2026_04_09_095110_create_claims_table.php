<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() 
{ 
    Schema::create('claims', function (Blueprint $table) { 
        $table->id(); 
        $table->foreignId('item_id')->constrained(); 
        $table->foreignId('user_id')->constrained(); 
        $table->string('verification_answer'); 
        $table->text('description'); 
        $table->string('proof_image')->nullable(); 
        $table->string('status')->default('pending'); // pending, approved, rejected 
        $table->timestamps(); 
    }); 
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};

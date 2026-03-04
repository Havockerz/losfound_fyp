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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('item_name');
        $table->text('description');
        $table->string('type'); // 'lost' or 'found'
        $table->string('location');
        $table->date('reported_date');
        $table->string('status')->default('pending');
        $table->string('image')->nullable(); 
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('items');
}

};

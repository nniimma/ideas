<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ! id
     * ! ideas -> varcahr 240 char
     * ! likes -> integer 0
     * ! created_at
     * ! updated_at
     */
    public function up(): void
    {
        schema::create('ideas', function (Blueprint $table) {
            $table->id();
            // ! constrained means it will just make idea for users that exists, cascadeOnDelete means if we delete the user, ideas of thet user will be deleted as well.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('content');
            $table->unsignedBigInteger('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};

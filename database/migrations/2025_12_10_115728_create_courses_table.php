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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('path_trailer')->nullable();
            $table->longText('about')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('price');

            // Relasi (Foreign Keys)
            // Menghubungkan ke tabel categories
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            // Menghubungkan ke tabel users (sebagai teacher)
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');

            $table->boolean('is_open')->default(true);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

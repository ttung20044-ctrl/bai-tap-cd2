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
    Schema::create('lessons', function (Blueprint $table) {
        $table->id();
        $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Thuộc về Course
        $table->string('title'); // Tiêu đề [cite: 74]
        $table->text('content')->nullable(); // Nội dung [cite: 75]
        $table->string('video_url')->nullable(); // Video URL [cite: 76]
        $table->integer('order')->default(0); // Thứ tự [cite: 77]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};

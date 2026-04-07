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
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên khóa học [cite: 37]
        $table->string('slug')->unique(); // Slug tự sinh [cite: 38]
        $table->decimal('price', 10, 2); // Giá [cite: 39]
        $table->text('description')->nullable(); // Mô tả [cite: 40]
        $table->string('image')->nullable(); // Ảnh khóa học [cite: 41]
        $table->enum('status', ['draft', 'published'])->default('draft'); // Trạng thái [cite: 42]
        $table->timestamps();
        $table->softDeletes(); // Hỗ trợ Soft Delete [cite: 62]
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

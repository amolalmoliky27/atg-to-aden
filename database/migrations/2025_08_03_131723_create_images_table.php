<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up()
{
    Schema::create('images', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('category_id'); // المطعم المرتبط
        $table->string('filename');               // اسم الصورة
        $table->string('name')->nullable();       // اسم المطعم داخل الصور (اختياري)
        $table->timestamps();

        // الربط بمفتاح أجنبي
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
}

};

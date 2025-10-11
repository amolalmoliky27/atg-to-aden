<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('post_reactions', function (Blueprint $table) {
            $table->id();

            // ربط البوست
            $table->foreignId('post_id')
                  ->constrained()
                  ->onDelete('cascade');

            // المستخدم المسجّل
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

            // الزائر
            $table->string('guest_id')->nullable();

            // نوع التفاعل
            $table->enum('type', ['like', 'love', 'haha', 'angry', 'sad']);

            $table->timestamps();

            // منع التكرار
            $table->unique(['post_id', 'user_id', 'guest_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_reactions');
    }
};
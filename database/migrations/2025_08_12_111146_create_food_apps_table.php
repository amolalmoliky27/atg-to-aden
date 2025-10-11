<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() { Schema::create('food_apps', function (Blueprint $table)
         { $table->id(); $table->string('image'); // صورة التطبيق 
            $table->string('link');
             // رابط التطبيق 
             $table->integer('rating')->default(5);
              // تقييم النجوم 
              $table->timestamps(); }); }

   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_apps');
    }
};

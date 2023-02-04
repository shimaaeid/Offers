<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('best_offers', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->foreignId('shop_id')->constrained('shops')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->float('price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('priority');
            $table->string('image_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('best_offers');
    }
};

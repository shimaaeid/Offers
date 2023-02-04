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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable()->unique();
            $table->string('mac_add')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('location')->nullable();
            $table->mediumText('location_url')->nullable();
            $table->string('whatsapp')->nullable()->unique();
            $table->string('insta')->nullable()->unique();
            $table->string('snap')->nullable()->unique();
            $table->mediumText('web_site')->nullable();
            $table->foreignId('shoptype_id')->constrained('shop_types')->cascadeOnDelete();
            $table->integer('months')->default(6);
            $table->date('subscription_date');
            $table->date('expire_date');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('packagetype_id')->constrained('package_types')->cascadeOnDelete();
            $table->mediumText('description')->nullable();
            $table->text('profile_path')->nullable();
            $table->string('cover_path')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->integer('watched')->default(1);
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
        Schema::dropIfExists('admins');
    }
};

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
        Schema::create('info_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('forceUpdate');
            $table->integer('lastBuild');
            $table->string('website');
            $table->string('whatsApp');
            $table->string('phone');
            $table->string('snap');
            $table->string('Instagram');
            $table->string('ticktock');
            $table->string('policy');
            $table->string('android');
            $table->string('ios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_settings');
    }
};

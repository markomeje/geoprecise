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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->foreignId('model_id');
            $table->string('model');
            $table->string('format')->nullable();
            $table->string('filename')->nullable();
            $table->string('name')->nullable();
            $table->string('public_id')->nullable();
            $table->string('type');
            $table->foreignId('user_id');
            $table->string('role')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('documents');
    }
};

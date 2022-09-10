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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->bigInteger('amount');
            $table->foreignId('model_id')->nullable();
            $table->string('reference');
            $table->string('note')->nullable();
            $table->string('model')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('client_id');
            $table->foreignId('staff_id')->nullable();
            $table->string('status')->nullable();
            $table->boolean('verified')->default(false);
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
        Schema::dropIfExists('payments');
    }
};

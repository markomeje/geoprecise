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
        Schema::create('sibs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->nullable();
            $table->string('plot_numbers')->nullable();
            $table->foreignId('layout_id')->nullable();

            $table->foreignId('user_id');
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('sibs');
    }
};

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
            $table->foreignId('form_id');
            $table->string('plot_numbers')->nullable();
            $table->foreignId('layout_id')->nullable();

            $table->foreignId('client_id');
            $table->foreignId('staff_id')->nullable();
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

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
        Schema::create('psrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id');
            $table->foreignId('layout_id')->nullable();
            $table->foreignId('staff_id')->nullable();
            $table->string('plot_numbers')->nullable();
            $table->foreignId('client_id');
            $table->string('status')->nullable();
            $table->string('sold_by')->nullable();
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
        Schema::dropIfExists('psrs');
    }
};

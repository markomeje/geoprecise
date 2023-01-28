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
        Schema::create('reprintings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id');
            $table->string('plot_number')->nullable();
            $table->foreignId('plan_id');
            $table->bigInteger('total_copies')->nullable();
            $table->foreignId('layout_id');

            $table->string('status')->nullable();
            $table->foreignId('client_id');
            $table->boolean('agree')->default(false);

            $table->boolean('approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable();
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
        Schema::dropIfExists('reprintings');
    }
};

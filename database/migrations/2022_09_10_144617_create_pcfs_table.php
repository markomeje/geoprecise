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
        Schema::create('pcfs', function (Blueprint $table) {
            $table->id();
            $table->string('plan_number');
            $table->foreignId('added_by')->nullable();
            $table->foreignId('form_id')->nullable();

            $table->foreignId('issued_by')->nullable();
            $table->boolean('issued')->default(false);
            $table->timestamp('issued_at')->nullable();

            $table->string('recorder_type')->default('staff');
            $table->foreignId('recorded_by')->nullable();

            $table->string('plan_title');
            $table->string('plot_location');
            $table->foreignId('client_id');
            $table->foreignId('survey_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pcfs');
    }
};

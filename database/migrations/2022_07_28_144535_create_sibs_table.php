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
            $table->foreignId('survey_id')->nullable();

            $table->foreignId('client_id');
            
            $table->boolean('approved')->default(false);
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            
            $table->string('recorder_type')->default('staff');
            $table->foreignId('recorded_by')->nullable();

            $table->boolean('completed')->default(false);
            $table->text('comments')->nullable();
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

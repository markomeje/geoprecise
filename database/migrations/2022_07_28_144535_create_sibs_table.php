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
            $table->foreignId('survey_id')->nullable();
            $table->foreignId('client_id');

            $table->text('location')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('plan_id');

            $table->string('plot_numbers')->nullable();
            $table->foreignId('layout_id')->nullable();

            $table->boolean('approved')->default(false);
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->boolean('completed')->default(false);
            $table->text('comments')->nullable();
            $table->string('status')->default('incomplete');

            $table->boolean('agree')->default(false);

            $table->boolean('deleted')->default(false);
            $table->dateTime('deleted_at')->nullable();
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

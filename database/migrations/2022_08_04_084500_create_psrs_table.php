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

            $table->string('plot_numbers')->nullable();
            $table->foreignId('client_id');
            $table->string('sold_by')->nullable();

            $table->boolean('approved')->default(false);
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->string('ref_no')->nullable();
            $table->string('status');

            $table->timestamp('result_date')->nullable();
            $table->timestamp('lodgement_date')->nullable();

            $table->string('recorder_type')->default('staff');
            $table->foreignId('recorded_by')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('completed')->default(false);

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
        Schema::dropIfExists('psrs');
    }
};

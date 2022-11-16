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
            $table->bigInteger('amount');
            $table->foreignId('model_id')->nullable();

            $table->boolean('approved')->default(false);
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('reference')->nullable();

            $table->string('note')->nullable();
            $table->string('model')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();

            $table->foreignId('client_id');
            $table->string('recorder_type')->default('staff');
            $table->foreignId('recorded_by')->nullable();

            $table->string('status')->nullable();
            $table->boolean('verified')->default(false);

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
        Schema::dropIfExists('payments');
    }
};

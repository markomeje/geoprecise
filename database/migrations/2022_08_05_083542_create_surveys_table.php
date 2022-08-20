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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->nullable();
            $table->string('purchaser_name')->nullable();
            $table->string('purchaser_address')->nullable();
            $table->string('purchaser_phone')->nullable();

            $table->string('seller_name')->nullable();
            $table->string('seller_address')->nullable();
            $table->string('seller_phone')->nullable();

            $table->foreignId('layout_id')->nullable();
            $table->string('plot_numbers')->nullable();
            $table->string('document_presented')->nullable();

            $table->text('approval_comments')->nullable();
            $table->text('approval_name')->nullable();
            $table->text('approval_address')->nullable();

            $table->foreignId('user_id');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('surveys');
    }
};

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
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_phone')->nullable();

            $table->string('seller_name')->nullable();
            $table->string('seller_address')->nullable();
            $table->string('seller_phone')->nullable();

            $table->foreignId('layout_id');
            $table->string('plot_numbers')->nullable();

            $table->text('approval_comments')->nullable();
            $table->text('approval_name')->nullable();
            $table->text('approval_address')->nullable();

            $table->foreignId('client_id');
            $table->string('status')->nullable();
            $table->boolean('completed')->default(false);

            $table->boolean('approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable();

            $table->timestamp('lifted_on')->nullable();
            $table->foreignId('lifted_by')->nullable();

            $table->string('recorder_type')->default('staff');
            $table->foreignId('recorded_by')->nullable();

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
        Schema::dropIfExists('surveys');
    }
};

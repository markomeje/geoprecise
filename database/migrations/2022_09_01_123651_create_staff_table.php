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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('role');
            $table->foreignId('user_id');
            $table->string('code')->nullable();
            $table->string('title')->nullable();
            $table->string('address');
            $table->foreignId('created_by')->nullable();
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
        Schema::dropIfExists('staff');
    }
};

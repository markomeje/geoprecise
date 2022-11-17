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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('title')->nullable();
            $table->string('dob')->nullable();
            $table->string('occupation')->nullable();

            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();

            $table->string('phone')->nullable();
            $table->foreignId('user_id');
            $table->string('status')->nullable();

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
        Schema::dropIfExists('clients');
    }
};

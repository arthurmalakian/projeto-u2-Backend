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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->require();
            $table->integer('type')->require();
            $table->integer('red')->nullable()->default(0);
            $table->integer('green')->nullable()->default(0);
            $table->integer('blue')->nullable()->default(0);
            $table->integer('brightness')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(false);
            $table->foreignId('user_id')->constrained('users')->require();
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
        Schema::dropIfExists('devices');
    }
};

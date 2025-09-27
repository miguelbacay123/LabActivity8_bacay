<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('registrations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password'); // hashed
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::dropIfExists('registrations');
}

};

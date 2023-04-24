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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('price')->default(0);
            $table->string('image');
            $table->string('condition');
            $table->string('stockNumber');
            $table->string('serial');
            $table->integer('hour');
            $table->text('description');
            $table->string('model');
            $table->string('year');
            $table->string('operatingCapacity');
            $table->string('netHorsepower');
            $table->string('weight');
            $table->boolean('available');
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
        Schema::dropIfExists('products');
    }
};

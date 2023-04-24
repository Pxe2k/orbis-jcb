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
            $table->string('image');
            $table->integer('price')->nullable();
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
            $table->foreignId('category_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('subcategory_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('catalog_type_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('company_id')->nullable()->onUpdate('cascade')->onDelete('set null');
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

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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('subcategory_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('catalog_type_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('company_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->integer('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('service_applications', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('companyName')->nullable();
            $table->string('phoneNumber');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipCode')->nullable();
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('year');
            $table->string('location');
            $table->text('comment');
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
        Schema::dropIfExists('service_applications');
    }
};

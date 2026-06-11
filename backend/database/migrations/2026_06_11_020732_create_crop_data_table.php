<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crop_data', function (Blueprint $table) {
            $table->id();

            $table->integer('farm_id')->index();
            $table->string('crop')->index();
            $table->integer('year')->index();

            $table->decimal('grossmargin_t', 15, 6)->nullable();
            $table->decimal('grossmargin', 15, 6)->nullable();
            $table->decimal('grossincome', 15, 6)->nullable();
            $table->decimal('grain_yield', 15 ,6)->nullable();
            $table->decimal('wue', 15, 6)->nullable();
            $table->decimal('yieldcosts', 15, 6)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_data');
    }
};

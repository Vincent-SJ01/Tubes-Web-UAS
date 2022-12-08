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
        Schema::create('drop_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKota');
            $table->string('namaDropPoint');
            $table->string('alamat');
            $table->timestamps();

            
            $table->foreign('idKota')->references('id')->on('kotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drop_points');
    }
};

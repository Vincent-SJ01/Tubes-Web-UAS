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
        Schema::create('kurirs', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('nama');
            $table->string('nik');
            $table->string('noTelp');
            $table->string('alamat');
            $table->date('tanggalLahir');
            $table->Integer('gender');
            $table->foreign('gender')->references('id')->on('genders')->onDelete('cascade');
            $table->Integer('status');
            $table->foreign('status')->references('id')->on('status_kurirs')->onDelete('cascade');
            $table->unsignedBigInteger('idRole')->default(2);
            $table->foreign('idRole')->references('id')->on('roles')->onDelete('cascade');
            
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
        Schema::dropIfExists('kurirs');
    }
};

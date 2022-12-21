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
        Schema::create('pengantarans', function (Blueprint $table) {
            $table->id();
            $table->string('noResi');
            $table->foreign('noResi')->references('noResi')->on('pakets')->onDelete('cascade');
            $table->string('nikKurir');
            $table->foreign('nikKurir')->references('nik')->on('kurirs')->onDelete('cascade');
            $table->unsignedBigInteger('idDropPoint')->nullable();
            $table->foreign('idDropPoint')->references('id')->on('drop_points')->onDelete('cascade');
            $table->integer('idStatus');
            $table->foreign('idStatus')->references('id')->on('status_pengantarans')->onDelete('cascade');
            $table->string('keterangan');
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
        Schema::dropIfExists('pengantarans');
    }
};

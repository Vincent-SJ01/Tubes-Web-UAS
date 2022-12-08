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
        Schema::create('penghantarans', function (Blueprint $table) {
            $table->string('noResi');
            $table->foreign('noResi')->references('noResi')->on('pakets')->onDelete('cascade');
            $table->unsignedBigInteger('idKurir');
            $table->foreign('idKurir')->references('id')->on('kurirs')->onDelete('cascade');
            $table->unsignedBigInteger('idDropPoint');
            $table->foreign('idDropPoint')->references('id')->on('drop_points')->onDelete('cascade');
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('status_pakets')->onDelete('cascade');
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
        Schema::dropIfExists('penghantarans');
    }
};

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
        Schema::create('pakets', function (Blueprint $table) {
            $table->string('noResi')->primary();
            $table->unsignedBigInteger('idPengirim');
            $table->foreign('idPengirim')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('jenisPaket');
            $table->foreign('jenisPaket')->references('id')->on('jenis_pakets')->onDelete('cascade');
            $table->unsignedBigInteger('idService');
            $table->foreign('idService')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('idStatus');
            $table->foreign('idStatus')->references('id')->on('status_pakets')->onDelete('cascade');
            $table->float('berat');
            $table->float('volume');
            $table->string('namaPenerima');
            $table->string('noTelpPenerima');
            $table->string('alamatTujuan');
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
        Schema::dropIfExists('pakets');
    }
};

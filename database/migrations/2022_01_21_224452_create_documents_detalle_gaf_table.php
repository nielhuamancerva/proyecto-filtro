<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsDetalleGafTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_detalle_gaf', function (Blueprint $table) {
            $table->id();
            $table->string('area_destino')->nullable();
            $table->integer('siaf')->nullable();
            $table->integer('nro_memo')->nullable();
            $table->unsignedBigInteger('id_documents_gaf');
            $table->foreign('id_documents_gaf')->references('id')->on('documents_gaf')->onDelete('cascade');
            $table->string('observacion')->nullable();
            $table->integer('page');
            $table->string('estado_documents_detalle_gaf');
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
        Schema::dropIfExists('documents_detalle_gaf');
    }
}

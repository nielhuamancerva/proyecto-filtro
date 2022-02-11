<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_detalle', function (Blueprint $table) {
            $table->id();
            $table->integer('ruc_proveedor');
            $table->string('estado_documents');
            $table->string('estado_documents_detalle');
            $table->unsignedBigInteger('id_documents');
            $table->string('referencia');
            $table->foreign('id_documents')->references('id')->on('documents')->onDelete('cascade');
            $table->timestamps();
            $table->string('status_row');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_detalle');
    }
}

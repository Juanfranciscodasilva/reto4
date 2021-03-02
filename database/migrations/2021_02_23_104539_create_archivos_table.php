<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("archivo");
            $table->unsignedBigInteger("autor");
            $table->foreign("autor")->references("id")->on("usuarios")->onDelete("cascade");
            $table->unsignedBigInteger("comentario");
            $table->foreign("comentario")->references("id")->on("comentarios")->onDelete("cascade");
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
        Schema::dropIfExists('archivos');
    }
}

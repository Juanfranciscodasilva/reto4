<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_chat', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("archivo_original");
            $table->string("archivo_hash");
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
        Schema::dropIfExists('archivos_chat');
    }
}

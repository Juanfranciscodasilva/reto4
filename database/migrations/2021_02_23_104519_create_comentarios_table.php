<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("comentario");
            $table->unsignedBigInteger("autor");
            $table->foreign("autor")->references("id")->on("usuarios")->onDelete("cascade");
            $table->unsignedBigInteger("proyecto");
            $table->foreign("proyecto")->references("id")->on("proyectos")->onDelete("cascade");
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
        Schema::dropIfExists('comentarios');
    }
}

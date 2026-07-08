<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinionsTable extends Migration
{
    public function up()
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();
            $table->string('producto');
            $table->string('nombre_persona');
            $table->integer('valoracion');
            $table->text('comentario');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opinions');
    }
}
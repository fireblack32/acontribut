<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('menu_id')->default(0);
            $table->unsignedInteger('orden')->default(0);
            $table->string('nombre',100);
            $table->string('url',50);
            $table->unsignedInteger('perfil');
            $table->unsignedInteger('instancia');
            $table->string('bloqueado',2);
            $table->timestamps();
            $table->charset='utf8mb4';
            $table->collation=('utf8mb4_spanish_ci');
            $table->string('icono',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}

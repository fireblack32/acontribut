<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->integer('menu')->unsigned();
            $table->string('url',100);
            $table->integer('perfil')->unsigned();
            $table->integer('instancia')->unsigned();
            $table->string('pagina',100);
            $table->timestamps();
            $table->charset='utf8mb4';
            $table->collation=('utf8mb4_spanish_ci');
            $table->string('subicono',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submenu');
    }
}

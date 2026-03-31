<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameHasMenuPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('perfil_has_menu_perfil', function ($table) {
            $table->renameColumn('perfil_idperfil', 'rol_id');
            $table->renameColumn('menu_perfil_idmenu_perfil', 'menu_id');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

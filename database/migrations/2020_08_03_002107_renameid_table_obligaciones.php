<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameidTableObligaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('obd_actexteriorgrandcontr', function ($table) {
            $table->renameColumn('idobd_actexteriorgrandcontr', 'id');
        });
        
        Schema::table('obd_actexteriorpersjur', function ($table) {
            $table->renameColumn('idobd_actexteriorpersjur', 'id');
        });

        Schema::table('obd_actexteriorpersnat', function ($table) {
            $table->renameColumn('idobd_actexteriorpersnat', 'id');
        });

        Schema::table('obd_antiregsimple', function ($table) {
            $table->renameColumn('idobd_antiregsimple', 'id');
        });

        Schema::table('obd_auto_cree', function ($table) {
            $table->renameColumn('idobd_auto_cree', 'id');
        });

        Schema::table('obd_consumo', function ($table) {
            $table->renameColumn('idobd_consumo', 'id');
        });

        Schema::table('obd_cree', function ($table) {
            $table->renameColumn('idobd_cree', 'id');
        });

        Schema::table('obd_creesegundacuota', function ($table) {
            $table->renameColumn('idobd_creesegundacuota', 'id');
        });

        Schema::table('obd_cree_cua', function ($table) {
            $table->renameColumn('idobd_cree_cua', 'id');
        });

        Schema::table('obd_cuentas_comp_dian', function ($table) {
            $table->renameColumn('idobd_cuentas_comp_dian', 'id');
        });


        Schema::table('obd_declanualivaregsimp', function ($table) {
            $table->renameColumn('idobd_declanualivaregsimp', 'id');
        });

        Schema::table('obd_declanualregsimp', function ($table) {
            $table->renameColumn('idobd_declanualregsimp', 'id');
        });

        Schema::table('obd_declaracion_renta', function ($table) {
            $table->renameColumn('idobd_declaracion_renta', 'id');
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

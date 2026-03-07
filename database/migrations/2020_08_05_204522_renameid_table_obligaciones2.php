<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameidTableObligaciones2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::table('obd_declaracion_renta2', function ($table) {
            $table->renameColumn('idobd_declaracion_renta2', 'id');
        });

        Schema::table('obd_declaracion_renta3', function ($table) {
            $table->renameColumn('idobd_declaracion_renta3', 'id');
        });

        Schema::table('obd_ica', function ($table) {
            $table->renameColumn('idobd_ica', 'id');
        });

        Schema::table('obd_ica_otros', function ($table) {
            $table->renameColumn('idobd_ica_otros', 'id');
        });

        Schema::table('obd_ica_otros_bimestral', function ($table) {
            $table->renameColumn('idobd_ica_otros_bimestral', 'id');
        });

        Schema::table('obd_ica_otros_mensual', function ($table) {
            $table->renameColumn('idobd_ica_otros_mensual', 'id');
        });

        Schema::table('obd_ica_otros_trimestral', function ($table) {
            $table->renameColumn('idobd_ica_otros_trimestral', 'id');
        });

        Schema::table('obd_impuesto_patrimonio', function ($table) {
            $table->renameColumn('idobd_impuesto_patrimonio', 'id');
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

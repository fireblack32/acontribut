<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameidTableObligaciones5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        

        Schema::table('ob_cancelar_oblig', function ($table) {
            $table->renameColumn('idob_cancelar_oblig', 'id');
        });
    
        Schema::table('ob_correccion_declaraciones', function ($table) {
            $table->renameColumn('idob_correccion_declaraciones', 'id');
        });

        Schema::table('ob_devoluciones', function ($table) {
            $table->renameColumn('idob_devoluciones', 'id');
        });

        Schema::table('ob_en_causales_dis', function ($table) {
            $table->renameColumn('idob_en_causales_dis', 'id');
        });

        Schema::table('ob_firmas_digitales', function ($table) {
            $table->renameColumn('idob_firmas_digitales', 'id');
        });

        Schema::table('ob_libros', function ($table) {
            $table->renameColumn('idob_libros', 'id');
        });

        Schema::table('ob_registro_contratos', function ($table) {
            $table->renameColumn('idob_registro_contratos', 'id');
        });

        Schema::table('ob_reg_inversion_ext', function ($table) {
            $table->renameColumn('idob_reg_inversion_ext', 'id');
        });

        Schema::table('ob_renov_reg_endeud', function ($table) {
            $table->renameColumn('idob_renov_reg_endeud', 'id');
        });

        Schema::table('ob_resolucion_facturacion', function ($table) {
            $table->renameColumn('idob_resolucion_facturacion', 'id');
        });

        Schema::table('ob_revisor_fiscal', function ($table) {
            $table->renameColumn('idob_revisor_fiscal', 'id');
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

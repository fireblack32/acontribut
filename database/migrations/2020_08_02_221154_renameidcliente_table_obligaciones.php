<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameidclienteTableObligaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('obpd_contribucion_supersoc', function ($table) {
            $table->renameColumn('idcliente', 'cliente_idcliente');
            });
        Schema::table('obpd_contribucion_turism', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });
        Schema::table('ob_revisor_fiscal', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });
        Schema::table('obpd_encuesta_dane', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_renov_reg_endeud', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_reg_inversion_ext', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_registro_contratos', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_libros', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });
        Schema::table('ob_firmas_digitales', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_devoluciones', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_correccion_declaraciones', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_cancelar_oblig', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_cambios_capital_inv_nac', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_beneficio_auditoria', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_actualizacion_obl', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('obpd_estados_financieros', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
            });

        Schema::table('ob_en_causales_dis', function ($table) {
                $table->renameColumn('idcliente', 'cliente_idcliente');
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

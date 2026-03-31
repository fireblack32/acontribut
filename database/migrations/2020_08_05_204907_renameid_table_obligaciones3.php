<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameidTableObligaciones3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::table('obd_iva', function ($table) {
            $table->renameColumn('idobd_iva', 'id');
        });

        Schema::table('obd_iva_cua', function ($table) {
            $table->renameColumn('idobd_iva_cua', 'id');
        });

        Schema::table('obd_medios_magneticos', function ($table) {
            $table->renameColumn('idobd_medios_magneticos', 'id');
        });

        Schema::table('obd_medios_magneticos2', function ($table) {
            $table->renameColumn('idobd_medios_magneticos2', 'id');
        });

        Schema::table('obd_medios_magneticos3', function ($table) {
            $table->renameColumn('idobd_medios_magneticos3', 'id');
        });

        Schema::table('obd_medios_magneticos_distritales', function ($table) {
            $table->renameColumn('idobd_medios_magneticos_distritales', 'id');
        });

        Schema::table('obd_medios_otros', function ($table) {
            $table->renameColumn('idobd_medios_otros', 'id');
        });

        Schema::table('obd_memeconregtribesp', function ($table) {
            $table->renameColumn('idobd_memeconregtribesp', 'id');
        });

        Schema::table('obd_preciostransf', function ($table) {
            $table->renameColumn('idobd_preciostransf', 'id');
        });

        Schema::table('obd_rentasegundacuota', function ($table) {
            $table->renameColumn('idobd_rentasegundacuota', 'id');
        });

        Schema::table('obd_reteica_otros', function ($table) {
            $table->renameColumn('idobd_reteica_otros', 'id');
        });

        Schema::table('obd_reteica_otros_bimestral', function ($table) {
            $table->renameColumn('idobd_reteica_otros_bimestral', 'id');
        });

        Schema::table('obd_reteica_otros_mensual', function ($table) {
            $table->renameColumn('idobd_reteica_otros_mensual', 'id');
        });

        Schema::table('obd_reteica_otros_trimestral', function ($table) {
            $table->renameColumn('idobd_reteica_otros_trimestral', 'id');
        });

        Schema::table('obd_rete_fuente', function ($table) {
            $table->renameColumn('idobd_rete_fuente', 'id');
        });

        Schema::table('obd_rete_ica', function ($table) {
            $table->renameColumn('idobd_rete_ica', 'id');
        });

        Schema::table('obd_rete_ica_mosquera', function ($table) {
            $table->renameColumn('idobd_rete_ica_mosquera', 'id');
        });

        Schema::table('obd_riquezasegcuota', function ($table) {
            $table->renameColumn('idobd_riquezasegcuota', 'id');
        });

        Schema::table('obd_soi', function ($table) {
            $table->renameColumn('idobd_soi', 'id');
        });

        Schema::table('obd_superenvdoc', function ($table) {
            $table->renameColumn('idobd_superenvdoc', 'id');
        });

        Schema::table('obd_superintendencia_salud', function ($table) {
            $table->renameColumn('idobd_superintendencia_salud', 'id');
        });

        Schema::table('obd_super_sociedades', function ($table) {
            $table->renameColumn('idobd_super_sociedades', 'id');
        });

        Schema::table('obpd_contribucion_supersoc', function ($table) {
            $table->renameColumn('idobpd_contribucion_supersoc', 'id');
        });

        Schema::table('obpd_contribucion_turism', function ($table) {
            $table->renameColumn('idobpd_contribucion_turism', 'id');
        });

        Schema::table('obpd_encuesta_dane', function ($table) {
            $table->renameColumn('idobpd_encuesta_dane', 'id');
        });

        Schema::table('obpd_estados_financieros', function ($table) {
            $table->renameColumn('idobpd_estados_financieros', 'id');
        });

        Schema::table('obp_balances', function ($table) {
            $table->renameColumn('idobp_balances', 'id');
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

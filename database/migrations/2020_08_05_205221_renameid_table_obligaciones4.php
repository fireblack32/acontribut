<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameidTableObligaciones4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        

        Schema::table('obp_exp_cert_anuales', function ($table) {
            $table->renameColumn('idobp_exp_cert_anuales', 'id');
        });

        Schema::table('obp_exp_cert_bimensuales', function ($table) {
            $table->renameColumn('idobp_exp_cert_bimensuales', 'id');
        });

        Schema::table('obp_imp_predial_vehiculo', function ($table) {
            $table->renameColumn('idobp_imp_predial_vehiculo', 'id');
        });

        Schema::table('obp_inventario', function ($table) {
            $table->renameColumn('idobp_inventario', 'id');
        });

        Schema::table('obp_nomina', function ($table) {
            $table->renameColumn('idobp_nomina', 'id');
        });

        Schema::table('obp_renov_matric_merc', function ($table) {
            $table->renameColumn('idobp_renov_matric_merc', 'id');
        });

        Schema::table('obp_renov_reg_inv_ext', function ($table) {
            $table->renameColumn('idobp_renov_reg_inv_ext', 'id');
        });
        Schema::table('obp_renov_socied_exterior', function ($table) {
            $table->renameColumn('idobp_renov_socied_exterior', 'id');
        });
        Schema::table('obp_solic_avaluos', function ($table) {
            $table->renameColumn('idobp_solic_avaluos', 'id');
        });

        Schema::table('obp_solic_cert_anuales', function ($table) {
            $table->renameColumn('idobp_solic_cert_anuales', 'id');
        });

        Schema::table('obp_solic_cert_bimensuales', function ($table) {
            $table->renameColumn('idobp_solic_cert_bimensuales', 'id');
        });

        Schema::table('ob_actualizacion_obl', function ($table) {
            $table->renameColumn('idob_actualizacion_obl', 'id');
        });

        Schema::table('ob_administrable', function ($table) {
            $table->renameColumn('idob_administrable', 'id');
        });

        Schema::table('ob_beneficio_auditoria', function ($table) {
            $table->renameColumn('idob_beneficio_auditoria', 'id');
        });

        Schema::table('ob_cambios_capital_inv_nac', function ($table) {
            $table->renameColumn('idob_cambios_capital_inv_nac', 'id');
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

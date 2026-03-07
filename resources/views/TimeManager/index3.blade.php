@extends("theme.$theme.layout")

@section('titulo')
Mis Pendientes
@endsection

@section("scripts")
<script src="{{ asset('Assets/lte/pages/scripts/admin/menu/index.js') }}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensajes')

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Buscar Registros de tiempos</h3>
            </div>

            <div class="card-body">

                {{-- El helper ya maneja el form y la conexión --}}
                <div class="table-responsive p-0">
                    <table class="table table-striped table-bordered table-hover" id="tabla-data">

                        @php
                            $usuario_id = session()->get('usuario_id');

                            if (!empty($usuario_id)) {

                                $query = "
                                    SELECT
                                        `Auditor`,
                                        `IdTipo_Auditoria`,
                                        `Fecha_Registro`,
                                        `IdCliente`,
                                        `H_Auditoria`,
                                        `H_Supervision`,
                                        `H_Planeacion`,
                                        `H_SGC`,
                                        `Observaciones`,
                                        `id`
                                    FROM `timemanager`
                                    WHERE `Fecha_Registro` >= '$fecha_ini'
                                      AND `Fecha_Registro` <= '$fecha_fin'
                                      AND `Auditor` = '$usuario_id'
                                ";

                                echo Funciontabla::maketablebuscar(
                                    $query,
                                    'editabus_timemanager',
                                    'editabus_timemanager',
                                    'Timemanager'
                                );
                            }
                        @endphp

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
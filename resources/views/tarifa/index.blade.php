@extends("theme.$theme.layout")

@section('titulo')
    Módulo de Rentabilidad
@endsection

@section('scripts')
    <script src="{{ asset('Assets/lte/pages/scripts/admin/menu/index.js') }}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="card card-info">
    <div class="card-header text-center">
        <h3 class="card-title w-100">Módulo de Rentabilidad</h3>
    </div>

    <div class="card-body text-center">

        {{-- ================== MENSAJES DE SESIÓN ================== --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 text-left">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- ======================================================= --}}

        {{-- Ver Rentabilidad --}}
        <div class="mb-4">
            <h5>Ver Tarifas Cargadas</h5>
            <form method="GET" action="{{ route('tarifa.index') }}" class="d-flex justify-content-center align-items-center flex-column">
                <div class="form-group w-25">
                    <input type="month" name="mes" class="form-control form-control-sm text-center" required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- Importar Excel --}}
        <div class="mb-4">
             <h5>-------------------------------</h5>
            <h5>Importar archivo de Excel</h5>
            <h5></h5>
            <h5>Formato del archivo: Fecha_original, Nit, Cliente, Costo,Horas pactadas</h5>
            <h5></h5>
            <form method="POST" action="{{ route('tarifa.import') }}" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center flex-column">
                @csrf
                <div class="form-group w-25">
                    <input type="file" name="file" class="form-control-file" required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- Eliminar Mes --}}
        <div class="mb-4">
            <h5>-------------------------------</h5>
            <h5>Eliminar Mes</h5>
            <h5></h5>
            <form method="POST" action="{{ route('tarifa.deleteMonth') }}" class="d-flex justify-content-center align-items-center flex-column">
                @csrf
                <div class="form-group w-25">
                    <input type="month" name="mes" class="form-control form-control-sm text-center" required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- Copiar / Trasladar Mes --}}
        <div class="mb-4">
             <h5>-------------------------------</h5>
            <h5>Trasladar Mes</h5>
            <form method="POST" action="{{ route('tarifa.copyMonth') }}" class="d-flex justify-content-center align-items-center flex-column">
                @csrf
                <div class="form-group w-50 text-left">
                    <label>Desde:</label>
                    <input type="month" name="from" class="form-control mb-2" required>
                    <label>Hasta:</label>
                    <input type="month" name="to" class="form-control" required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- Tabla de Datos Cargados --}}
        @if(isset($data) && $data->count() > 0)
            <hr>
            <h5 class="mt-4 mb-3">Tarifas encontradas para el mes seleccionado</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm mx-auto" style="max-width: 90%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Cliente (NIT)</th>
                            <th>VP Junior</th>
                            <th>VP Senior</th>
                            <th>VP Director</th>
                            <th>VP Socio</th>
                            <th>Horas Pactadas</th>
                            <th>Total Pactado</th>
                            <th>Fecha Modificación</th>
                            <th>Fecha Carga</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->cliente }}</td>
                                <td>{{ $item->VP_Junior }}</td>
                                <td>{{ $item->VP_Senior }}</td>
                                <td>{{ $item->VP_Director }}</td>
                                <td>{{ $item->VP_Socio }}</td>
                                <td>{{ $item->Horas_Pactadas }}</td>
                                <td>{{ $item->Total_Pactado }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->fecha_mod)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->fecha_carga)->format('Y-m-d H:i:s') }}</td>
                                <td><a href="{{ route('tarifa.editar', ['id' => $item->id]) }}">Editar</a>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(request()->has('mes'))
            {{-- Si se buscó un mes pero no hay datos --}}
            <p class="mt-4 text-muted">No se encontraron registros para el mes seleccionado.</p>
        @endif

    </div>
</div>
@endsection

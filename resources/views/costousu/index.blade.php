@extends("theme.$theme.layout")

@section('titulo')
    Módulo Costos de Usuarios
@endsection

@section('scripts')
    <script src="{{ asset('Assets/lte/pages/scripts/admin/menu/index.js') }}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="card card-info">
    <div class="card-header text-center">
        <h3 class="card-title w-100">Módulo Costos de Usuarios</h3>
    </div>

    <div class="card-body">

        {{-- ===========================
            MENSAJES DE SESIÓN
        ============================ --}}
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

        {{-- ===========================
            CONSULTAR COSTOS POR MES
        ============================ --}}
        <div class="text-center mb-4">
            <h5>Ver Costos Cargados</h5>

            <form method="GET" action="{{ route('costusuar.index') }}"
                  class="d-flex justify-content-center align-items-center flex-column">
                <div class="form-group w-25">
                    <input type="month"
                           name="mes"
                           class="form-control form-control-sm text-center"
                           value="{{ request('mes') }}"
                           required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- ===========================
            IMPORTAR ARCHIVO EXCEL
        ============================ --}}
        <div class="text-center mb-4">
            <h5>-------------------------------</h5>
            <h5>Importar archivo de Excel</h5>
            <h6>Formato del archivo: fecha, cedula, usuario, costo, capacidad</h6>

            <form method="POST"
                  action="{{ route('costusuar.import') }}"
                  enctype="multipart/form-data"
                  class="d-flex justify-content-center align-items-center flex-column">
                @csrf
                <div class="form-group w-25">
                    <input type="file" name="file" class="form-control-file" required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- ===========================
            ELIMINAR MES
        ============================ --}}
        <div class="text-center mb-4">
            <h5>-------------------------------</h5>
            <h5>Eliminar Mes</h5>

            <form method="POST"
                  action="{{ route('costusuar.deleteMonth') }}"
                  class="d-flex justify-content-center align-items-center flex-column">
                @csrf
                <div class="form-group w-25">
                    <input type="month" name="mes" class="form-control form-control-sm text-center" required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- ===========================
            COPIAR / TRASLADAR MES
        ============================ --}}
        <div class="text-center mb-4">
             <h5>-------------------------------</h5>
            <h5>Trasladar Mes</h5>

            <form method="POST"
                  action="{{ route('costusuar.copyMonth') }}"
                  class="d-flex justify-content-center align-items-center flex-column">
                @csrf
                <div class="form-group w-50">
                    <label>Desde:</label>
                    <input type="month" name="from" class="form-control mb-2" required>

                    <label>Hasta:</label>
                    <input type="month" name="to" class="form-control" required>
                </div>
                @include('includes.boton-form-guardar')
            </form>
        </div>

        {{-- ===========================
            TABLA DE RESULTADOS
        ============================ --}}
        @if($data->count() > 0)
            <hr>
            <h5 class="text-center mb-3">Resultados del mes seleccionado</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Costo</th>
                            <th>Capacidad</th>
                            <th>Perfil</th>
                            <th>Fecha</th>
                            <th>Fecha Modificación</th>
                            <th>Editar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $item)
                            @php
                                $u = $item->usuario; // relación con usuario_web
                            @endphp

                            <tr class="text-center">
                                <td>{{ optional($u)->documento }}</td>
                                <td>{{ optional($u)->nombre }}</td>
                                <td>{{ optional($u)->apellidos }}</td>

                                <td>{{ number_format($item->costo, 0, ',', '.') }}</td>
                                <td>{{ $item->capacidad }}</td>
                                <td>{{ $item->perfil }}</td>

                                <td>{{ \Carbon\Carbon::parse($item->Fecha)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->fecha_mod)->format('Y-m-d H:i') }}</td>
                                <td><a href="{{ route('costusuar.editar', ['id' => $item->id]) }}">Editar</a>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <p class="text-muted text-center mt-3">No hay registros para mostrar.</p>
        @endif

    </div>
</div>
@endsection

@extends("theme.$theme.layout")

@section('titulo')
    Editar Otro Costo
@endsection

@section('scripts')
    <script src="{{ asset('Assets/lte/pages/scripts/admin/menu/index.js') }}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="card card-info">
    <div class="card-header text-center">
        <h3 class="card-title w-100">Editar Otro Costo #{{ $registro->id }}</h3>
    </div>

    <div class="card-body">

        {{-- MENSAJES DE SESIÓN --}}
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

        <form method="POST" action="{{ route('otroscost.update', ['id' => $registro->id]) }}">
            @csrf

            <div class="form-group">
                <label for="tarifa">Tarifa</label>
                <input type="number" name="tarifa" id="tarifa" class="form-control"
                       value="{{ old('tarifa', $registro->tarifa) }}" required>
            </div>

            <div class="form-group">
                <label for="capacidad">Capacidad</label>
                <input type="number" name="capacidad" id="capacidad" class="form-control"
                       value="{{ old('capacidad', $registro->capacidad) }}" required>
            </div>

            <div class="form-group">
                <label for="idtipo_auditoria">Tipo Auditoría</label>
                <input type="number" name="idtipo_auditoria" id="idtipo_auditoria" class="form-control"
                       value="{{ old('idtipo_auditoria', $registro->idtipo_auditoria) }}" required>
            </div>

            <div class="form-group">
                <label for="Fecha">Fecha</label>
                <input type="date" name="Fecha" id="Fecha" class="form-control"
                       value="{{ old('Fecha', \Carbon\Carbon::parse($registro->Fecha)->format('Y-m-d')) }}" required>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Guardar cambios
                </button>

                <a href="{{ route('otroscost.index', ['mes' => request('mes')]) }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </form>

    </div>
</div>
@endsection

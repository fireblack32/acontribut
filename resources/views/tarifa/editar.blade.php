@extends("theme.$theme.layout")

@section('titulo')
    Editar Tarifa
@endsection

@section('scripts')
    <script src="{{ asset('Assets/lte/pages/scripts/admin/menu/index.js') }}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="card card-info">
    <div class="card-header text-center">
        <h3 class="card-title w-100">Editar TarifaCliente #{{ $registro->id }}</h3>
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

        <form method="POST" action="{{ route('tarifa.update', ['id' => $registro->id]) }}">
            @csrf

            <div class="form-group">
                <label for="VP_Junior">VP_Junior</label>
                <input type="number" name="VP_Junior" id="VP_Junior" class="form-control"
                       value="{{ old('VP_Junior', $registro->VP_Junior) }}" required>
            </div>

            <div class="form-group">
                <label for="VP_Senior">VP_Senior</label>
                <input type="number" name="VP_Senior" id="VP_Senior" class="form-control"
                       value="{{ old('VP_Senior', $registro->VP_Senior) }}" required>
            </div>

            <div class="form-group">
                <label for="VP_Director">VP_Director</label>
                <input type="number" name="VP_Director" id="VP_Director" class="form-control"
                       value="{{ old('VP_Director', $registro->VP_Director) }}" required>
            </div>

            <div class="form-group">
                <label for="VP_Socio">VP_Socio</label>
                <input type="number" name="VP_Socio" id="VP_Socio" class="form-control"
                       value="{{ old('VP_Socio', $registro->VP_Socio) }}" required>
            </div>
              <div class="form-group">
                <label for="costo">Costo</label>
                <input type="number" name="costo" id="costo" class="form-control"
                       value="{{ old('costo', $registro->costo) }}" required>
            </div>

            <div class="form-group">
                <label for="Horas_Pactadas">Horas_Pactadas</label>
                <input type="number" name="Horas_Pactadas" id="Horas_Pactadas" class="form-control"
                       value="{{ old('Horas_Pactadas', $registro->Horas_Pactadas) }}" required>
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

                <a href="{{ route('tarifa.index', ['mes' => request('mes')]) }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </form>

    </div>
</div>
@endsection

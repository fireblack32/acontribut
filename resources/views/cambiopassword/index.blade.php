@extends("theme.$theme.layout")
@section('titulo')
    Cambio Password
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensajes')
        @include('includes.mensajes2')
        <div class="card-primary">
            <div class="card-header">
                <h3 class="card-title">Cambiar Password</h3>
                
            </div>
            <form action="{{route('guardar_password')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    @php
                                    {{
                                        $usuario_id=session()->get('usuario_id');
                                        $querych2='SELECT `usuario`, `perfil_idperfil` FROM `usuario_web` WHERE `id`="'.$usuario_id.'"';
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $resultpasos=mysqli_query($conn,$querych2);

                                            while($row=mysqli_fetch_array($resultpasos)){
						$perfil_idperfil=$row["perfil_idperfil"];
						$usuario=$row["usuario"];
                                                //echo $perfil_idperfil."<br>";
                                            }
                                    }}
                    @endphp
                    @if ($perfil_idperfil==1)
                    @include('cambiopassword.form2')
                    @endif
                    @if ($perfil_idperfil!='1')
                    @include('cambiopassword.form')  
                    @endif
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            @include('includes.boton-form-crear')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

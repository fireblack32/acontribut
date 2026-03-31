<table  class="table table-striped table-bordered table-hover table-sm"  id="tabla-data">
    <div class="card-body table-responsive p-0">
        <tr>
            <div class="card card-info ">
                <div class="card-header">
                <h3 class="card-title">Registros Encontrados</h3>
                </div>  
            </div>
        </tr>
        <tr>
            <thead>
                <tr>
                        
                    @foreach ($cabecero as $cabecero)
                        <th> {{$cabecero}}</th>
                    @endforeach
                    <th>Editar</th>
                    <th>Borrar</th>
                            
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $v)
                    <tr>
                     
                        @foreach ($v as $value) 
                        <td>{{$value}}</td>
                        @endforeach
                    
                        <td>
                            <form action="{{route($link2,['id'=>$value])}}"  class="d-inline form-eliminar" method="POST">
                            @csrf 
                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC">
                                <i class="fa fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route($link,['id'=>$value])}}"  class="d-inline form-eliminar" method="POST">
                            @csrf 
                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC">
                                <i class="fa fa-times-circle text-danger"></i>
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
            
        </tr>   
    </div>
</table>
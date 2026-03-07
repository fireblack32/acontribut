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
                    <th>Pendiente</th>
                            
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $v)
                    <tr>
                     
                        @foreach ($v as $value) 
                        <td>{{$value}}</td>
                        @endforeach
                        <td>
                            
                            <a href="{{route($link1,[$value,$vardos,$idcliente,$id])}}" class="btn-accion-tabla tooltipsC" title="Retornar Pendiente">
                               <i class="fa fa-reply"></i>
                            </a>
                        </td>
                        
                        
                    </tr>
                @endforeach
            </tbody>
            
        </tr>   
    </div>
</table>
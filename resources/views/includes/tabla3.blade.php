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
                    <th>Proceso</th>
                    <th>N/A</th>
                    <th>Finalizado</th>
                            
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $v)
                    <tr>
                     
                        @foreach ($v as $value) 
                        <td>{{$value}}</td>
                        @endforeach
                        <td>
                            
                            <a href="{{route($link1,[$value,$vardos,$idcliente,$id])}}" class="btn-accion-tabla tooltipsC" title="En Proceso">
                               <i class="fa fa-cogs"></i>
                            </a>
                        </td>
                        <td>
                            
                            <a href="{{route($link2,[$value,$vardos,$idcliente,$id])}}" class="btn-accion-tabla tooltipsC" title="N/A">
                               <i class="fa fa-ban"></i>
                            </a>
                        </td>
                        <td>
                            
                            <a href="{{route($link3,[$value,$vardos,$idcliente,$id])}}" class="btn-accion-tabla tooltipsC" title="finalizado">
                               <i class="fa fa-check-circle"></i>
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
            
        </tr>   
    </div>
</table>
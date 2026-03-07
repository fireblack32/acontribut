<table  class="table table-striped table-bordered table-hover table-sm"  id="tabla-data">
    <div class="card-body table-responsive p-0">
        <tr>
            <div class="card card-info ">
                <div class="card-header">
                <h3 class="card-title">{{utf8_decode( $nombre)}}</h3>
                </div>  
            </div>
        </tr>
        <tr>
            <thead>
                <tr>
                        
                    @foreach ($cabecero as $cabecero)
                        <th> {{$cabecero}}</th>
                    @endforeach
                    <th>Buscar</th>
                            
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $v)
                    <tr>
                     
                        @foreach ($v as $value) 
                        <td>{{$value}}</td>
                        @endforeach
                        <td>
                            
                        <a href="{{route($link,[$value,$vardos])}}" class="btn-accion-tabla tooltipsC" title="Buscar este registro">
                                <i class="fa fa-search"></i>
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
            
        </tr>   
    </div>
</table>
<br>
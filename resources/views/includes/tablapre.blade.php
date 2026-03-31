<table  class="table table-striped table-bordered table-hover table-sm"  id="tabla-data">
    <div class="card-body table-responsive p-0">
        <tr>

        </tr>
        <tr>
            <thead>
                <tr>
                        
                    @foreach ($cabecero as $cabecero)
                        <th> {{$cabecero}}</th>
                    @endforeach
                    
                            
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $v)
                    <tr>

                        @foreach ($v as $value) 
                        <td>{{$value}}</td>
                        @endforeach
                        
                    </tr>
                @endforeach
            </tbody>
                
        </tr>   
    </div>
</table>
<div class="form-group row">
    <label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
         <div class="col-lg-8">
             <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre', $data->nombre ?? '')}}" >
         </div>
   </div>
 
   <div class="form-group row">
   <label for="url" class="col-lg-3 col-form-label requerido">URL</label>
         <div class="col-lg-8">
         <input type="text" name="url" class="form-control" id="url" value="{{old('url',$data->url ?? '')}}" >
         </div>
   </div>
 
 <div class="form-group row">
   <label for="perfil" class="col-lg-3 col-form-label requerido">Perfil</label>
         <div class="col-lg-8">
         <input type="text" name="perfil" class="form-control" id="perfil" value="{{old('perfil',$data->perfil ?? '')}}" >
            </div>
  </div>
  <div class="form-group row">
    <label for="menu_id" class="col-lg-3 col-form-label requerido">Depende de</label>
          <div class="col-lg-8">
          <input type="text" name="menu_id" class="form-control" id="menu_id" value="{{old('menu_id',$data->menu_id ?? '')}}" >
             </div>
   </div>
 
  <div class="form-group row">
  <label for="instancia" class="col-lg-3 col-form-label requerido">Instancia</label>
         <div class="col-lg-8">
    <!-- <input type="text" name="" class="form-control" id="instancia" value="" required> llamado required estandar-->
         <input type="text" name="instancia" class="form-control" id="instancia" value="{{old('instancia',$data->instancia ?? '')}}" >
         </div>
   </div>
 
  <div class="form-group row">
  <label for="icono" class="col-lg-3 col-form-label ">Icono</label>
         <div class="col-lg-8">
         <input type="text" name="icono" class="form-control" value="{{old('icono',$data->icono ?? '')}}" id="icono">
         </div>
         <div class="col-lg-1">
            <span id="mostrar-icono" class="fa fa-fw {{old("icono")}}"></span>
         </div>
   </div>
 
 
 
 
 
 </div>
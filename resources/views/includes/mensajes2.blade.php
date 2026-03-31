@if (session("mensaje2"))
<div class="alert alert-warning alert-dismissible" data-auto-dismiss="3000">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Mensaje de sistema</h5>
 
        <li>{{ session("mensaje2") }}</li>
 
  </div>
 @endif
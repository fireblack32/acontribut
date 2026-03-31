<head>
    <script language="JavaScript">
function cargando_archivo()
     { //alert('ok');
     document.getElementById('mainarea').innerHTML= "<div class='loader_background'><div class='loader'></div></div>";
     }
    function finaliza_cargando_archivo()
     {  //alert('no');
    	document.getElementById('mainarea').innerHTML="";
     }
     function popup(url,ancho,alto) {
	var posicion_x; 
	var posicion_y; 
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/2); 
	window.open(url,"","width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
	}
      // Funci贸n para inhabilitar la tecla enter
      function disableEnterKey(e){
        var key; 
        if(window.event){
          key = window.event.keyCode; //IE
        }else{
          key = e.which; //firefox 
        }
        if(key==13){
          return false;
        }else{
          return true;
        }
      }
    </script>
    <script type="text/JavaScript">
    <!--
function MM_swapImgRestore() { //v3.0
      var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
    }
    
function MM_preloadImages() { //v3.0
      var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
        var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
        if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
    }
    
function MM_findObj(n, d) { //v4.01
      var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
        d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
      if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
      for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
      if(!x && d.getElementById) x=d.getElementById(n); return x;
    }
    
function MM_swapImage() { //v3.0
      var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
       if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}
	



function check7_checklist(idob, id)
    {	cargando_archivo();
      $.ajax({
    	    type :  'GET',               
    	    url  :  'checklist_finalsinrev',
    	    dataType : "html",
    	    success: function(htmlResponse)
    	    {
    	      $('#result').html(htmlResponse);
            finaliza_cargando_archivo();
            popup('control.php?opcion=32',900,700);
    	    }
    	}); 
    }
    
    function check8_checklist(idob, id)
    {	cargando_archivo();
      $.ajax({
    	    type :  'GET',               
    	    url  :  'Vista/checklist2.php?obligacion='+idob+'&Id='+id+'&grabar=8',
    	    dataType : "html",
    	    success: function(htmlResponse)
    	    {
    	      $('#result').html(htmlResponse);
            finaliza_cargando_archivo();
             popup('control.php?opcion=32',900,700);
    	    }
    	}); 
    }
    
    function check9_checklist(idob, id)
    {	cargando_archivo();
      $.ajax({
    	    type :  'GET',               
    	    url  :  'Vista/checklist2.php?obligacion='+idob+'&Id='+id+'&grabar=9',
    	    dataType : "html",
    	    success: function(htmlResponse)
    	    {
    	      $('#result').html(htmlResponse);
            finaliza_cargando_archivo();
             popup('control.php?opcion=32',900,700);
    	    }
    	}); 
    }
    
    function check10_checklist(idob, id)
    {	cargando_archivo();
      $.ajax({
    	    type :  'GET',               
    	    url  :  'Vista/checklist2.php?obligacion='+idob+'&Id='+id+'&grabar=10',
    	    dataType : "html",
    	    success: function(htmlResponse)
    	    {
    	      $('#result').html(htmlResponse);
            finaliza_cargando_archivo();
             popup('control.php?opcion=32',900,700);
    	    }
        }); 
    }
        
    </script>
     
</head>
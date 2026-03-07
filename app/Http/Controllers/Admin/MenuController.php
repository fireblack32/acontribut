<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validacionmenu;
use App\Models\Admin\Menu;
use App\Models\Admin\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$consulta=DB::table('submenu')
        //->select('nombre', 'menu', 'url', 'perfil', 'instancia', 'pagina', 'subicono' )->get()->toArray();
        //$menus = Menu:: orderBy('id')->get()->toArray();


       $menus = Menu::getMenu();
       //return view('admin.menu.index', compact('menus'));
       return view('admin.menu.index', compact('menus'));
       
        //dd($menus);

        //$submenus = SubMenu:: orderBy('id')->get()->toArray();
        //dd($consulta);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //
        return view('admin.menu.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Validacionmenu $request)
    {
        //dd($request->all());
        //dd($request);
       Menu::create($request->all());
       return redirect('admin/menu/crear')->with('mensaje','Menu creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrar($id)
    {
        //
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //
        $data = Menu::findOrFail($id);
        return view('admin.menu.editar', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Validacionmenu $request, $id)
    {
        //
       // dd($request, $id);
        Menu::findOrFail($id)->update($request->all());
       return redirect('admin/menu')->with('mensaje', 'Menu actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        //
        Menu::destroy($id);
        return redirect('admin/menu')->with('mensaje', 'Menú eliminado con exito');
    }


    
    public function guardarOrden(Request $request)
    {
        if ($request->ajax()) {
            $menu = new Menu;
            $menu->guardarOrden($request->menu);
            return response()->json(['respuesta' => 'ok']);
        } else {
            abort(404);
        }
    }
}

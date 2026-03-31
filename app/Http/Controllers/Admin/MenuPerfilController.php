<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Admin\Rol;
use Illuminate\Http\Request;

class MenuPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //model rol es tabla menu_perfil (id nombre), model menu es (id y perfil), tabla `perfil_has_menu_perfi
        // tiene (perfil_idperfil,menu_perfil_idmenu_perfil)
        $rols=Rol::orderBy('id')->pluck('nombre','id')->toArray();
        $menus=Menu::getMenu();
        $menusRols=Menu::with('roles')->get()->pluck('roles','id')->toArray();
       // dd($rols);
        //dd($menus);
        //dd($menusRols);

        return view('admin.menu_perfil.index',compact('rols', 'menus', 'menusRols'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
       // dd($request);
        if ($request->ajax()) {
            $menus = new Menu();
            if ($request->input('estado') == 1) {
                $menus->find($request->input('menu_id'))->roles()->attach($request->input('rol_id'));
                return response()->json(['mensaje' => 'El rol se asigno correctamente']);
            } else {
                $menus->find($request->input('menu_id'))->roles()->detach($request->input('rol_id'));
                return response()->json(['mensaje' => 'El rol se elimino correctamente']);
            }
        } else {
            abort(404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\UsuariosFormRequest;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $usuarios = DB::table('users')
            ->leftjoin('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*','roles.description as rol_desc')
            ->get();
        return view('usuarios.index',['usuarios'=>$usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UsuariosFormRequest $request)
    {
        $validatedData = $request->validated();
        $usuario = new User();
        $usuario->name = $request->input('nombre_usuario');
        $usuario->email = $request->input('email');
        $usuario->password = $request->input('password');
        $usuario->role_id = $request->input('role_id');
        $usuario->save();

        return redirect('/usuarios');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('usuarios.edit',['usuario'=>$usuario,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UsuariosFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $usuario = User::find($id);
        $usuario->name = $request->input('nombre_usuario');
        $usuario->email = $request->input('email');
        $usuario->password = $request->input('password');
        $usuario->role_id = $request->input('role_id');
        $usuario->update();

        return redirect('/usuarios');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

            $usuario = User::find($id);

            $usuario->delete();

            return redirect('/usuarios');

    }

}

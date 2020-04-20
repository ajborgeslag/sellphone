<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SeguridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/loguin');
    }

    public function loguin(Request $request)
    {
        return view('seguridad.loguin');
    }

    public function register(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $contacto = DB::table('users')
                ->leftJoin('roles','users.role_id','=','roles.id')
                ->where('users.email','=',$email)
                ->where('users.password','=',$password)
                ->select('users.*','roles.id as role_id','roles.name as role')
                ->first();

		if($contacto)
        {
            $request->session()->flush();
            $request->session()->put('authenticated',time());
            $request->session()->put('user',$contacto);
            return redirect('/celulares');
        }
        else
            return view('seguridad.loguin',['errorEmail'=>'Usuario o Contraseña incorrecta !']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

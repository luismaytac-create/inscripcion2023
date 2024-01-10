<?php

namespace App\Http\Controllers\Admin\Usuarios;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUsuariosRequest;
use App\User;
use Auth;
use Illuminate\Http\Request;
class UsuariosController extends Controller
{
    public function index()
    {

        switch (Auth::user()->codigo_rol) {
            case 'root':
                $Lista = [];
                return view('admin.usuarios.index',compact('Lista'));
            case 'sistemas':
                $Lista = [];
                return view('admin.usuarios.index',compact('Lista'));
            case 'admin':
                $Lista = [];
                return view('admin.usuarios.index',compact('Lista'));
                break;
            case 'informes':
                $Lista = [];
                return view('admin.usuarios.index',compact('Lista'));
                break;

            default:
                Alert::info('No tiene privilegios para realizar esta acción');
                return redirect()->route('home.index');
                break;
        }





    }
    public function search(Request $request)
    {
    	$Lista = User::where('dni','like','%'.$request->get('dni').'%')->where('idrole','13')->get();

    	return view('admin.usuarios.index',compact('Lista'));
    }
    public function editar($id)
    {
    	$user = User::findOrFail($id);
		
			switch ($user->role->nombre) {
            case 'Alumno':
				
                 return view('admin.usuarios.edit',compact('user'));
                break;
				
            default:
			Alert::info('Usuario no existe.');
				
               return redirect()->route('home.index');
                break;
        }
		
		
        
    }
    public function update(UpdateUsuariosRequest $request, $id)
    {
        $user = User::find($id);
		switch ($user->role->nombre) {
            case 'Alumno':
				
                 if ($request->has('password')) {
            $user->dni = $request->input('dni');
            $user->password = $request->input('password');
        }elseif ($request->hasFile('file')) {
            if(!str_contains($user->foto,'nofoto'))Storage::delete("/public/$user->foto");

            $user->foto = $request->file('file')->store('avatar','public');
        }else{
            $user->dni = $request->input('dni');

                     if ($request->has('colegio')) {
                         $user->colegio= $request->input('colegio');
                     }



        }
        $user->save();
        Alert::success('Usuario actualizado');
        $Lista = $user;
        return redirect()->route('admin.usuarios.index',compact('Lista'));
                break;
				
            default:
			Alert::info('Usuario no existe.');
				
               return redirect()->route('home.index');
                break;
        }
		
        
    }
}

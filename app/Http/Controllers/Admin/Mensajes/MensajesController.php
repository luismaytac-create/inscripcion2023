<?php

namespace App\Http\Controllers\Admin\Mensajes;

use App\Http\Controllers\Controller;
use App\Models\Mensaje;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class MensajesController extends Controller
{
    public function index()
    {
    	$mensajes = Mensaje::whereNull('read_at')->orderBy('created_at')->get();
    	return view('admin.mensajes.index',compact('mensajes'));
    }
    public function atendidos()
    {
        $mensajes = Mensaje::whereNotNull('read_at')->orderBy('updated_at')->get();
        return view('admin.mensajes.index',compact('mensajes'));
    }
    public function show($id)
    {
    	$mensaje = Mensaje::find($id);
    	if(!isset($mensaje->read_at)){
	    	$date = Carbon::now();
	    	$mensaje->read_at = $date;
	    	$mensaje->save();
    	}
    	return view('admin.mensajes.show',compact('mensaje'));
    }
    public function update(Request $request,$id)
    {
    	$mensaje = Mensaje::find($id);
    	$mensaje->fill($request->all());
    	$mensaje->save();
    	Alert::success('Mensaje Actualizado con exito');
    	return redirect()->route('admin.mensajes.index');
    }
}

<?php

namespace App\Http\Controllers\Admin\Evaluacion;

use App\Http\Controllers\Controller;
use App\Models\Evaluacion;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EvaluacionController extends Controller
{
    public function index()
    {
    	$Lista = Evaluacion::all();
    	return view('admin.evaluacion.index',compact('Lista'));
    }
    public function edit($id)
    {
    	$evaluacion = Evaluacion::find($id);
    	return view('admin.evaluacion.edit',compact('evaluacion'));
    }
    public function update(Request $request,$id)
    {
    	$evaluacion = Evaluacion::find($id);
    	$evaluacion->fill($request->all());
    	$evaluacion->save();
    	Alert::success('Evaluacion actualizado con exito');
    	return redirect()->route('admin.evaluacion.index');
    }
}

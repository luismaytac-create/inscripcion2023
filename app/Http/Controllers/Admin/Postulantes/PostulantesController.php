<?php

namespace App\Http\Controllers\Admin\Postulantes;

use Alert;
use Carbon\Carbon;
use App\Models\Cronograma;
use App\Models\Modalidad;
use App\Models\Especialidad;
use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
class PostulantesController extends Controller
{
    public function buscar(Request $request)
    {
        $name = strtoupper($request->input('name'));
        $name = trim($name);
        $postulantes = Postulante::whereRaw("numero_identificacion||' '||clearstring(paterno)||' '||clearstring(materno)||clearstring(nombres) like '%$name%'")->get();
        if(!$postulantes->IsEmpty()){
            return view('admin.postulantes.index',compact('postulantes'));
        }else{
            $postulantes = [];
            Alert::danger('No hay coincidencias con su busqueda');
            return back();
        }

    }


    public function personal(Request $request, $id) {
        Postulante::where('id',$id)->update([
            'idcolegio'=>$request->idcolegio,




        ]);





        Alert::success('Datos Actualizados con exito');
        return back();
    }


    public function show($id)
    {
        $postulante = Postulante::with(['Recaudaciones','Usuarios','Procesos'])->find($id);
		
		$date = Carbon::now()->toDateString();
        $fecha_inicio = Cronograma::FechaInicio('INCE');
        $fecha_fin = Cronograma::FechaFin('INCE');

        if ($date>=$fecha_inicio && $date<=$fecha_fin){
			$modalidad = Modalidad::Activo()->orderBy('id')->pluck('nombre','id')->toarray();
        }else{
			$modalidad = Modalidad::where('codigo','<>','ID-CEPRE')->Activo()->orderBy('id')->pluck('nombre','id')->toarray();
        }
		$modalidad2 = Modalidad::Activo()->orderBy('id')->pluck('nombre','id')->toarray();

		$segunda_modalidad_cepre = Modalidad::where('modalidad2','ID-CEPRE')->Activo()->orderBy('id')->pluck('nombre','id')->toarray();

		$especialidad = Especialidad::Activo()->orderBy('nombre')->pluck('nombre','id')->toarray();
		$especialidad_edit = ['' => 'Seleccionar Especialidad']+Especialidad::Activo()->orderBy('nombre')->pluck('nombre','id')->toarray();


        return view('admin.postulantes.show',compact('postulante','modalidad','modalidad2','segunda_modalidad_cepre','especialidad','especialidad_edit'));
    }
//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'password' => 'required',
//        ]);
//        $postulante = Postulante::select('idusuario')->where('id',$request->input('idpostulante'))->first();
//
//        User::where('id',$postulante->idusuario)->update(['password'=>bcrypt($request->input('password'))]);
//
//        Alert::success('Clave Actualizada con exito');
//        return back();
//    }
    public function update(Request $request,$id)
    {
        $postulante = Postulante::find($id);

        $postulante->fill($request->all());
        $data = $request->all();

        if(!$request->has('idmodalidad2')){

            $data['idmodalidad2']=null;
        }
        if(!$request->has('idespecialidad2')){

            $data['idespecialidad2']=null;
        }
        if(!$request->has('idespecialidad3')){

            $data['idespecialidad3']=null;
        }
        if(!$request->has('idespecialidad4')){
            $data['idespecialidad4']=null;
        }
        if(!$request->has('idespecialidad5')){
            $data['idespecialidad5']=null;
        }
        if(!$request->has('idespecialidad6')){
            $data['idespecialidad6']=null;
        }


        $postulante->fill($data);
        $postulante->save();
        Alert::success('Datos Actualizados con exito');

        return back();
    }
    public function AnulaModalidad2($request)
    {
        $data = $request->all();
        if(!$request->has('idmodalidad2')){
            $data['idmodalidad2']=null;
            $data['idespecialidad4']=null;
            $data['idespecialidad5']=null;
            $data['idespecialidad6']=null;
            $data['codigo_verificacion']=null;


        }
        return $data;
    }

    public function actualizar(Request $request,$id) {



       Postulante::where('id',$id)->update([
            'datos_ok'=>$request->datos_ok,
            'email'=>$request->email,

            'paterno'=>$request->paterno,
            'materno'=>$request->materno,
            'nombres'=>$request->nombres,
            'inicio_estudios'=>$request->inicio_estudios,

            'fin_estudios'=>$request->fin_estudios,


           'fecha_nacimiento'=>$request->fecha_nacimiento,



           'idubigeo'=>$request->idubigeo,

           'idubigeonacimiento'=>$request->idubigeonacimiento,




           'telefono_celular'=>$request->telefono_celular,
           'telefono_fijo'=>$request->telefono_fijo,




        ]);





        Alert::success('Datos Actualizados con exito');
        return back();

    }

    public function cambiaremail( Request $request){

        $postulante = Postulante::find($request->idpostulante);
        $emailantiguo=$postulante->email;

        $emailnuevo= $request->emailnuevo;
        $usersconsul= User::where('dni',$postulante->numero_identificacion)->first();
        User::where('id',$usersconsul->id)->update(['email'=>$emailnuevo]);
        Postulante::where('id',$postulante->id)->update(['email'=>$emailnuevo]);
        Alert::success('Datos Actualizados con exito');
        return back();
    }
    public function cuarta( Request $request){
        $postulante = Postulante::find($request->idpostulante);

        $cuarta = $request->cuarta_df;

        Postulante::where('id',$postulante->id)->update(['cuarta_df'=>$cuarta]);
        Alert::success('Datos Actualizados con exito');
        return back();

    }
    public function cambiardni( Request $request){





        $postulante = Postulante::find($request->idpostulante);


        $dniantiguo=$postulante->numero_identificacion;

        $dninuevo= $request->dninuevo;




        /*RECAUDACION */

        $numrecauda=Recaudacion::where('codigo',$dniantiguo)->count();


        if($numrecauda>0){

            $recauda=Recaudacion::where('codigo',$dniantiguo)->get();
        //    Recaudacion::where('codigo',$dniantiguo)->update(['codigo'=>$dninuevo]);

            foreach ($recauda as $key => $item) {

                Recaudacion::where('id',$item->id)->update(['codigo'=>$dninuevo,'referencia'=>$item->referencia. ' - CAMBIO DNI DECIA: '.$dniantiguo .' DICE: '.$dninuevo]);

            }


        }


        /*USERS*/

        $numusers = User::where('dni',$dniantiguo)->count();
        $numusersnuevo = User::where('dni',$dninuevo)->count();
        if($numusers==1 && $numusersnuevo==0){
            $usersconsul= User::where('dni',$dniantiguo)->first();

            User::where('id',$usersconsul->id)->update(['dni'=>$dninuevo]);

        }else {
            Alert::danger('ERROR EN LA TABLA USERS , VERIFICAR EL DNI EN LA TABLA USERS');
            return back();
        }




        /*POSTULANTE*/


        $numpostul = Postulante::where('numero_identificacion',$dniantiguo)->count();
        $numpostulnuevo = Postulante::where('numero_identificacion',$dninuevo)->count();

        if($numpostul==1 && $numpostulnuevo==0){

            $postulconsultar= Postulante::where('numero_identificacion',$dniantiguo)->first();

            if($postulconsultar->foto_editada != null){

                $antiguo_archivo = 'public/'.$postulconsultar->foto_editada;
                $nuevo_archivo_tmp = 'public/fotosok/'.$dninuevo.extension($antiguo_archivo);


                if(Storage::exists($antiguo_archivo)){
                    Storage::copy($antiguo_archivo, $nuevo_archivo_tmp);

                    Postulante::where('id',$postulconsultar->id)->update(['numero_identificacion'=>$dninuevo,'foto_editada'=>'fotosok/'.$dninuevo.extension($antiguo_archivo)]);

                }else {
                    Postulante::where('id',$postulconsultar->id)->update(['numero_identificacion'=>$dninuevo]);
                    Alert::danger('NO SE ACTUALIZO FOTO PORQUE NO ESTA EDITADA');

                }

            }else {
                Postulante::where('id',$postulconsultar->id)->update(['numero_identificacion'=>$dninuevo]);
                Alert::danger('NO SE ACTUALIZO FOTO PORQUE NO ESTA EDITADA');

            }












        }else {
            Alert::danger('ERROR EN LA TABLA POSTULANTE , VERIFICAR LA TABLA POSTULANTE');
            return back();
        }




        return back();
    }


    public function index()
    {   $postulantes = [];
        Alert::danger('Ingrese DNI  o Apellidos para realizar la búsqueda.');
        return view('admin.postulantes.index',compact('postulantes'));
    }
    public function lista()
    {
	    $Lista = Postulante::Activos()->with(['Sexo','Sedes','Grado','Ubigeos','Especialidades','Colegios','Aulas'])->get();
	    $res['data'] = $Lista;
	    return $res;
    }
    public function ficha($id)
    {
        return view('admin.postulantes.ficha',compact('id'));
    }
    public function pago($id)
    {
        return view('admin.postulantes.pago',compact('id'));
    }
}

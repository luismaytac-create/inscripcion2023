<?php


namespace App\Http\Controllers\Admin\Declaracion;

use App\Models\Declaracion;
use App\Models\DeclaracionEva;
use App\Models\LogEvaluacion;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\DocumentVictima;
use App\Models\Postulante;
use App\Models\SolicitanteVictima;
use App\Models\Victimas;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Alert;
use App\Mail\DenegadoEmail;
use Mail;
use App\Http\Controllers\Sms\SmsController;

class DeclaracionController extends Controller
{
    public function index()
    {

        $Lista = DB::table("listado_victimas")->get();
   //     return view('admin.victimas.index',compact('Lista'));
    }

    public function lista() {

        $varrole=Auth::user()->role->nombre;
        $variduser=Auth::user()->id;
        if($variduser==1 || $variduser==7 || $varrole=='root' || $varrole=='Sistemas' || $variduser==19 
        || $variduser==2172 || $variduser==13 || $variduser==12 || $variduser==14 || $variduser==6205
        || $variduser==6535
        ){
            $Lista = DB::table("vista_solicitantes_declaracion")->get();
            $cnt_pendientes = DB::table("vista_solicitantes_declaracion")->where('estado','PENDIENTE')->count();
            return view('admin.declaracion.lista',compact('Lista','cnt_pendientes'));
        }else {
            Alert::info('No tiene privilegios para realizar esta acción');
            return redirect()->route('home.index');
        }


    }


    public function evaluar($dni){

        $soliti = DeclaracionEva::where ( 'dni' ,$dni)->first();
        $postulante = Postulante::where('id',$soliti->idpostulante)->first();
        if(isset($postulante)){
            $data = Postulante::ValidarDNI($postulante->numero_identificacion)->with(['declaracionEva'])->first();
        }else{
            $data = [];
        }

        $documentos= Declaracion::where('dni',$dni)->where('activo',true)->get();

        return view('admin.declaracion.evaluar',compact('data','documentos','soliti'));

    }



    public function desactivar($dni){
        Victimas::where('dni',$dni)->update(['activo'=>0]);
        Alert::success('Victima Desactivada con exito');
        return back();
    }


    public function activar($dni){
        Victimas::where('dni',$dni)->update(['activo'=>1]);
        Alert::success('Victima Activada con exito');
        return back();
    }
    public function store(Request $request){

        $coun = Victimas::where('dni',$request->dni)->count();

        if($coun>0) {

            Alert::danger('Ya existe el dni ingresado, verifique si se encuentra activo.');
            return back();
        }else {

            Victimas::create($request->all());
            Alert::success('Registrado con exito.');
            return back();
        }

    }


    public function save( Request $request)
    {
        if($request->otorga == 'DENEGADO')
        {
            $var_otor = 'DENEGADO';//72718912
            $postulante = Postulante::find($request->idpostulante);
            Mail::to($postulante->email)
                ->send(new DenegadoEmail('Declaracion Jurada',$request->observaciones));
            (new SmsController)->metodo2($postulante->telefono_celular,'ADMISION-UNI: Su declaración jurada ha sido observada, revise su correo electrónico');

        }else if($request->otorga == 'APROBADO')
        {

            $var_otor = 'APROBADO';


        }else if($request->otorga == 'PENDIENTE')
        {

            $var_otor = 'PENDIENTE';
        }

        $data = DeclaracionEva::where('idpostulante',$request->idpostulante)->update([

            'estado' => $var_otor,
            'observaciones'=> $request->observaciones,

            'dni'   => $request->dni,
            'updated'=>Carbon::now()->toDateTimeString(),
            'iduser' => Auth::user()->id
        ]);

/*
        $counxxx = Victimas::where('dni',$request->dni)->count();
        $dni = $request->dni;
        if($counxxx>0) {
            if($request->otorga == 'DENEGADO')
            {

                Victimas::where('dni',$dni)->update(['activo'=>0]);
                $var_otor = 'DENEGADO';

            }else if($request->otorga == 'APROBADO')
            {
                Victimas::where('dni',$dni)->update(['activo'=>1]);
                $var_otor = 'APROBADO';


            }else if($request->otorga == 'PENDIENTE')
            {
                Victimas::where('dni',$dni)->update(['activo'=>0]);
                $var_otor = 'PENDIENTE';
            }

        }else {

            if($request->otorga == 'DENEGADO')
            {


                $var_otor = 'DENEGADO';

            }else if($request->otorga == 'APROBADO')
            {


                $nuevo= new Victimas();


                $nuevo->dni = $dni;
                $nuevo->activo= true;


                $nuevo->save();



                $var_otor = 'APROBADO';


            }else if($request->otorga == 'PENDIENTE')
            {

                $var_otor = 'PENDIENTE';
            }
        }


*/
        $evanueva= new LogEvaluacion();
        $postulante = Postulante::where('numero_identificacion',$request->dni)->first();
        $evanueva->idusuario = Auth::user()->id;
        $evanueva->idpostulante = $postulante->id;
        $evanueva->estado =  $request->otorga;
        $evanueva->observacion = $request->observaciones;
        $evanueva->date = Carbon::now()->toDateTimeString();
        if( isset($postulante->idmodalidad2)){
            $evanueva->modalidad = $postulante->idmodalidad.'-'.$postulante->idmodalidad2;
        }else {
            $evanueva->modalidad = $postulante->idmodalidad;

        }
        $evanueva->save();




        Alert::success('Evaluación registrada con éxito.');
        return redirect()->route('admin.declaracion.index');
    }
}
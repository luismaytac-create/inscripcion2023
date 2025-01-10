<?php
namespace App\Http\Controllers\Admin\Informes;
use App\Http\Controllers\Controller;

use App\Models\Catalogo;
use App\Models\Declaracion;
use App\Models\DeclaracionEva;
use App\Models\Postulante;
use App\Models\RegistroDni;
use App\Models\Proceso;
use App\Models\SolicitanteVictima;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DB;
class InformesController extends Controller
{
    public function index()
    {
        $noexiste=false;
        return view('admin.informes.index',compact('noexiste'));
    }

    public function buscar(Request $request) {



        // Log::info($request);

        $cadena = $request->dni;
        $noexiste=false;

        $count = User::where('idrole',13)->where('dni',$cadena)->count();
        if($count > 0 ){


            $count_postulante = Postulante::where('numero_identificacion',$cadena)->count();
            $userdata = User::where('idrole',13)->where('dni',$cadena)->first();
            $tiene_postulante = false;
            $celular = $userdata->celular;
            $email = $userdata->email;
            $dni = $request->dni;
            $fecha_registro = Carbon::parse($userdata->created_at)->format('d/m/Y H:i:s');
            $idtipodoc = $userdata->idtipo_identificacion;
            $tipodoc_nombre = Catalogo::where('id',$idtipodoc)->first();
            $datos_doc = $tipodoc_nombre->nombre;
            $usuario_id = $userdata->id;

            if($count_postulante > 0 ){
                $tiene_postulante = true;
                $postulante = Postulante::where('numero_identificacion',$dni)->first();
                $proceso = Proceso::where('idpostulante',$postulante->id)->first();
                $declaracion = DeclaracionEva::where('idpostulante',$postulante->id)->first();
                $iddeclaracion = Declaracion::where('dni',$postulante->numero_identificacion)->max('id');
                $declaracion_archivo = Declaracion::where('id',$iddeclaracion)->first();
                $confirmo_email = $userdata->confirmo;
                $solicitante = SolicitanteVictima::where ( 'dni' ,$dni)->first();
                $celular = $postulante->telefono_celular.'-'. $postulante->telefono_fijo.'-'. $postulante->telefono_varios;



                $contador_semibeca= DB::table("semibeca_verificador")->where('dni',$postulante->numero_identificacion)->count();

                $dnis = RegistroDni::where('dni',$postulante->numero_identificacion)->orderBy('registo_archivos_dni.created_at','DESC')->get();

                return view('admin.informes.reporte',compact('dni','datos_doc','celular'
                    ,'email','tiene_postulante','fecha_registro','usuario_id'
                    ,'postulante','proceso','declaracion','declaracion_archivo','confirmo_email','contador_semibeca','dnis','solicitante'));
            }else {


                return view('admin.informes.reporte',compact('dni','datos_doc','celular'
                    ,'email','tiene_postulante','fecha_registro','usuario_id'));
            }









        }else {
            $noexiste = true;
            return view('admin.informes.index',compact('noexiste'));
        }



    }
}
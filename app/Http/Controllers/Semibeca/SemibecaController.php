<?php
namespace App\Http\Controllers\Semibeca;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDatosRequest;
use App\Http\Requests\UpdateDatosRequest;
use App\Models\Postulante;
use App\Models\Document;
use App\Models\Recaudacion;
use App\Models\SemibecaActivo;
use App\Models\Solicitante;
use App\Models\Cronograma;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Styde\Html\Facades\Alert;
use PDF;
use Illuminate\Support\Facades\Log;
class SemibecaController extends Controller
{
    public function index()
    {
        $dni = Auth::user()->dni;
        $email = Auth::user()->email;

        $id = Auth::user()->id;
        $postulante = Postulante::where('idusuario',$id)->first();
        $monst=0;

        $cronograma= Cronograma::where('codigo','INBE')->first();
        $fechaInicio = $cronograma->fecha_inicio;
        $fechaFin = $cronograma->fecha_fin;
        $hoy = date('Y-m-d');
        #$hoy<$fechaInicio || $hoy>$fechaFin

        if(is_null($postulante)){
            Alert::info('No realizo su preinscripción');
            return redirect()->route('home.index');
        }
       if($hoy<$fechaInicio || $hoy>$fechaFin){ #false
//           if ( true) {

            # Alert::info('Debe completar sus datos personales.');
           # Alert::info('Inscripciones de Semibeca disponible desde el 07 de julio, verifica el cronograma.');
            Alert::info('Los resultados serán publicados segun el cronograma.');
            return redirect()->route('home.index');


        }else{

            if(!$postulante->pago){

                $socit=Solicitante::where('dni',$postulante->numero_identificacion)->count();

                // $activo = SemibecaActivo::where("idpostulante",$postulante->id)->where('activo',true)->count();

                // if($activo < 1) {
                //     Alert::info('Inscripciones cerradas, los resultados se publicarán según el cronograma.');
                //     return redirect()->route('home.index');
                // }



             /* if($postulante->idmodalidad == 16 ){
                   Alert::info('Inscripciones cerradas, los resultados se publicarán según el cronograma.');

                   return redirect()->route('home.index');

               }*/


                if($socit>0){
                    $monst=1;

                }else{
                    $monst=2;
                }

                $documentos=Document::where('dni',Auth::user()->dni)->where('tipo',1)->where('activo',true)->get();
                $documentos2=Document::where('dni',Auth::user()->dni)->where('tipo',2)->where('activo',true)->get();
                $documentos3=Document::where('dni',Auth::user()->dni)->where('tipo',3)->where('activo',true)->get();
                $documentos4=Document::where('dni',Auth::user()->dni)->where('tipo',4)->where('activo',true)->get();
                $documentos5=Document::where('dni',Auth::user()->dni)->where('tipo',5)->where('activo',true)->get();
                $documentos6=Document::where('dni',Auth::user()->dni)->where('tipo',6)->where('activo',true)->get();
                $documentos7=Document::where('dni',Auth::user()->dni)->where('tipo',7)->where('activo',true)->get();


                $doctodos=Document::where('dni',Auth::user()->dni)->where('activo',true)->get();
                return view('semibeca.index',compact('postulante','documentos','documentos2','documentos3','documentos4','documentos5','documentos6','documentos7','doctodos','monst'));
            }else {
                Alert::info('NO PUEDE POSTULAR A SEMIBECA YA QUE REALIZÓ SU PAGO');
                return redirect()->route('home.index');
            }
        }




    }

    public function regissol()
    {
        $dni = Auth::user()->dni;
        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $postulante = Postulante::where('idusuario',$id)->first();



        $monst=0;

        $postulante = Postulante::Usuario()->first();

        $datt= new Solicitante();

        $datt->idpostulante = $postulante->id;
        $datt->iduser = Auth::user()->id;
        $datt->observaciones = '';
        $datt->otorga = 'PENDIENTE';
        $datt->cepreuni = 0;
        $datt->promedio = null;
        $datt->proceso = '2025-1';
        $datt->dni = Auth::user()->dni;
        $datt->gestion = $postulante->datos_colegio->gestion;
        $datt->save();


        echo 1;




    }
    public function load1(Request $request)
    {
        $file = $request->file('carga1');

        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG")
        {

            $countarch=Document::where('dni',Auth::user()->dni)->count();

            $nombre=$request->file('carga1')->store('documentos','public');
            $data = new Document();
            $data->dni = Auth::user()->dni;
            $data->documento = $nombre;
            $data->tipo     = 1;
            $data->save();



            echo 1;
        }else
        {
            echo 0;
        }
    }

    public function load2(Request $request)
    {
        $file = $request->file('carga2');
        //$nombre = Auth::user()->dni.'-'.date("Y-m-d-h-i-s").'-2.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        if(  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" || pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" || pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG")
        {

            $countarch=Document::where('dni',Auth::user()->dni)->count();

            $nombre=$request->file('carga2')->store('documentos','public');

            $data = new Document();

            $data->dni = Auth::user()->dni;
            $data->documento = $nombre;
            $data->tipo     = 2;
            $data->save();



            echo 1;



        }else
        {
            echo 0;
        }
    }

    public function delete(Request $request)
    {

        $postulante = Postulante::Usuario()->first();
        $countarch=Document::where('dni',Auth::user()->dni)->where('id',$request->id)->count();

        if($countarch > 0 ){
            Document::where('id',$request->id)->update([
                'activo' => false
            ]);

            return redirect('semibeca');
        }else {

            Alert::info('PERMISO DENEGADO');
            return redirect('semibeca');
        }



    }

    public function load3(Request $request)
    {
        $file = $request->file('carga3');

        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" || pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG")
        {

            $countarch=Document::where('dni',Auth::user()->dni)->count();

            $nombre=$request->file('carga3')->store('documentos','public');
            $data = new Document();
            $data->dni = Auth::user()->dni;
            $data->documento = $nombre;
            $data->tipo     = 3;
            $data->save();








            echo 1;
        }else
        {
            echo 0;
        }
    }

    public function load4(Request $request)
    {
        $file = $request->file('carga4');

        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" || pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG")
        {

            $countarch=Document::where('dni',Auth::user()->dni)->count();

            $nombre=$request->file('carga4')->store('documentos','public');
            $data = new Document();
            $data->dni = Auth::user()->dni;
            $data->documento = $nombre;
            $data->tipo     = 4;
            $data->save();




            echo 1;
        }else
        {
            echo 0;
        }
    }

    public function load5(Request $request)
    {
        $file = $request->file('carga5');

        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" || pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG")
        {

            $countarch=Document::where('dni',Auth::user()->dni)->count();

            $nombre=$request->file('carga5')->store('documentos','public');
            $data = new Document();
            $data->dni = Auth::user()->dni;
            $data->documento = $nombre;
            $data->tipo     = 5;
            $data->save();


            echo 1;
        }else
        {
            echo 0;
        }
    }

    public function load6(Request $request)
    {
        $file = $request->file('carga6');

        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" || pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG")
        {

            $countarch=Document::where('dni',Auth::user()->dni)->count();

            $nombre=$request->file('carga6')->store('documentos','public');
            $data = new Document();
            $data->dni = Auth::user()->dni;
            $data->documento = $nombre;
            $data->tipo     = 6;
            $data->save();


            echo 1;
        }else
        {
            echo 0;
        }
    }

    public function load7(Request $request)
    {
        $file = $request->file('carga7');

        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" || pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG")
        {

            $countarch=Document::where('dni',Auth::user()->dni)->count();

            $nombre=$request->file('carga7')->store('documentos','public');
            $data = new Document();
            $data->dni = Auth::user()->dni;
            $data->documento = $nombre;
            $data->tipo     = 7;
            $data->save();


            echo 1;
        }else
        {
            echo 0;
        }
    }

    public function receipt()
    {
        $postulante = Postulante::where('numero_identificacion', Auth::user()->dni)->get();
        foreach($postulante as $row):
            PDF::AddPage("L","A5");
            PDF::Image('assets/pages/img/scotiabank_logo.jpg', 5, 5, 55, 30);
            PDF::setFont('Helvetica','',24);
            PDF::setXY(60,20);
            PDF::Cell(60,10,"FORMATO DE PAGO");
            PDF::setFont('Helvetica','',12);
            PDF::setXY(30,50);
            PDF::Cell(60,10,"CUENTA",1,0,"R");
            PDF::setXY(90,50);
            PDF::Cell(100,10,"ADMISIÓN UNI",1);
            PDF::setXY(30,60);
            PDF::Cell(60,10,"CONCEPTO",1,0,"R");
            PDF::setXY(90,60);
            PDF::Cell(100,10,"621- FORMATO DE SOLICITUD DE SEMIBECA",1);
            PDF::setXY(30,70);
            PDF::Cell(60,10,"DNI",1,0,"R");
            PDF::setXY(90,70);
            PDF::Cell(100,10,Auth::user()->dni,1);
            PDF::setXY(30,80);
            PDF::Cell(60,10,"DATOS",1,0,"R");
            PDF::setXY(90,80);
            PDF::Cell(100,10,$row->paterno.' '.$row->materno.' '.$row->nombres,1);
            PDF::setXY(30,90);
            PDF::Cell(60,10,"IMPORTE",1,0,"R");
            PDF::setXY(90,90);
            PDF::Cell(100,10,"S/. 5.00",1);
            PDF::setXY(30,100);
            PDF::Cell(100,10,"INSTRUCCIONES PARA EL SOLICITANTE");
            PDF::setXY(30,110);
            PDF::Cell(100,10,"2. Verificar que los datos registrados en la parte superior sean los correctos.");
            PDF::setXY(30,115);
            PDF::Cell(100,10,"3. Verificar que el nombre sea del solicitante no del apoderado o de quien pague.");

            PDF::AddPage("L","A5");
            PDF::Image('assets/pages/img/bcp_logo.jpg', 5, 5, 55, 30);
            PDF::setFont('Helvetica','',24);
            PDF::setXY(60,20);
            PDF::Cell(60,10,"FORMATO DE PAGO");
            PDF::setFont('Helvetica','',12);
            PDF::setXY(30,50);
            PDF::Cell(60,10,"CUENTA",1,0,"R");
            PDF::setXY(90,50);
            PDF::Cell(100,10,"ADMISIÓN UNI",1);
            PDF::setXY(30,60);
            PDF::Cell(60,10,"CONCEPTO",1,0,"R");
            PDF::setXY(90,60);
            PDF::Cell(100,10,"FORMATO DE SOLICITUD DE SEMIBECA",1);
            PDF::setXY(30,70);
            PDF::Cell(60,10,"DNI",1,0,"R");
            PDF::setXY(90,70);
            PDF::Cell(100,10,Auth::user()->dni,1);
            PDF::setXY(30,80);
            PDF::Cell(60,10,"DATOS",1,0,"R");
            PDF::setXY(90,80);
            PDF::Cell(100,10,$row->paterno.' '.$row->materno.' '.$row->nombres,1);
            PDF::setXY(30,90);
            PDF::Cell(60,10,"IMPORTE",1,0,"R");
            PDF::setXY(90,90);
            PDF::Cell(100,10,"S/. 5.00",1);
            PDF::setXY(30,100);
            PDF::Cell(100,10,"INSTRUCCIONES PARA EL SOLICITANTE");
            PDF::setXY(30,110);
            PDF::Cell(100,10,"2. Verificar que los datos registrados en la parte superior sean los correctos.");
            PDF::setXY(30,115);
            PDF::Cell(100,10,"3. Verificar que el nombre sea del solicitante no del apoderado o de quien pague.");

        endforeach;
        ob_end_clean();
        PDF::Output('RECIBO_SEMIBECA_5_SOLES.pdf');
    }


}

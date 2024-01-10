<?php


namespace App\Http\Controllers\Sms;


use App\Http\Controllers\Controller;
use App\Mail\CelularMail;

use App\Models\MensajeTexto;
use App\Models\Postulante;
use App\User;
use Auth;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Response;
class SmsController extends Controller
{

    public function enviar(  Request $request){

        $postulante = Postulante::Usuario()->first();

        $ahora = Carbon::now();

        $celular = $postulante->telefono_celular;
        if(strlen($celular) == 9 ){

            if( substr($celular,0,1) == '9'){


                $councant = MensajeTexto::where('idpostulante', $postulante->id)->where('creacion','>',$ahora->format('Y-m-d 00:00:00'))->where('creacion','<',$ahora->format('Y-m-d 23:59:59'))->count();
                // ENVIAR MENSAJE Y GRABAR BASE DE DATOS
                if( $councant == 0) {
                    $codigo = strtoupper(str_random(6));
                    $data['dni']=$postulante->numero_identificacion;
                    $data['creacion']=$ahora;
                    $data['idpostulante']=$postulante->id;
                    $data['codigo']= $codigo;
                    $this->sendSMS('51'.$celular,'ADMISION-UNI TU CODIGO DE VERIFICACION ES: '.$codigo);

                  #  Mail::to($postulante->email)->send(new CelularMail($codigo));

                    MensajeTexto::create($data);

                    return Response::json(['data' => 'OK','envio'=>'OK' ]);

                }



                // VERIFICAR EL TIEMPO DEL ULTIMO MENSAJE
                if( $councant ==1 ){
                    $cantid = MensajeTexto::where('idpostulante', $postulante->id)->find(\DB::table('mensaje_texto')->where('idpostulante', $postulante->id)->max('id'));
                    $anterior = $cantid->creacion;
                    $diferencia = Carbon::now()->diffInMinutes($anterior);



                    if($diferencia >= 10 ){
                        $data['dni']=$postulante->numero_identificacion;
                        $data['creacion']=$ahora;
                        $data['idpostulante']=$postulante->id;
                        $data['codigo']= $cantid->codigo;
                        $this->sendSMS('51'.$celular,'TU CODIGO ES '.$cantid->codigo);
                        MensajeTexto::create($data);

                        Mail::to($postulante->email)->send(new CelularMail($cantid->codigo));
                        return Response::json(['data' => 'OK','envio'=>'OK' ]);
                    }else {

                        $nuevafech = Carbon::parse($anterior)->addMinutes(10);
                        return Response::json(['data' => 'OK', 'envio'=>'FALSE','msj'=>'PUEDES ENVIAR OTRO MENSAJE A PARTIR DE: '.$nuevafech->format('d-m-Y H:i')]);
                    }




                }


                if( $councant < 6 ){

                    $cantid = MensajeTexto::where('idpostulante', $postulante->id)->find(\DB::table('mensaje_texto')->where('idpostulante', $postulante->id)->max('id'))   ;
                    $anterior = $cantid->creacion;
                    $diferencia = Carbon::now()->diffInMinutes($anterior);



                    if($diferencia >= 10 ){
                        $data['dni']=$postulante->numero_identificacion;
                        $data['creacion']=$ahora;
                        $data['idpostulante']=$postulante->id;
                        $data['codigo']= $cantid->codigo;
                        $this->sendSMS('51'.$celular,'ADMISION-UNI TU CODIGO DE VERIFICACION ES: '.$cantid->codigo);
                        MensajeTexto::create($data);

                      #  Mail::to($postulante->email)->send(new CelularMail($cantid->codigo));
                        return Response::json(['data' => 'OK','envio'=>'OK' ]);
                    }else {

                        $nuevafech = Carbon::parse($anterior)->addMinutes(10);
                        return Response::json(['data' => 'OK', 'envio'=>'FALSE','msj'=>'PUEDES ENVIAR OTRO MENSAJE A PARTIR DE: '.$nuevafech->format('d-m-Y H:i')]);
                    }
                }
                if( $councant > 6 ){
                    return Response::json(['data' => 'ERROR','msj'=>'NÚMERO MÁXIMO DE INTENTOS PERMITIDOS, COMUNÍCATE CON NUESTRO NÚMERO DE WHATSAPP 981609170.']);
                }
            }else {
                return Response::json(['data' => 'ERROR','msj'=>'NÚMERO DE CELULAR INVÁLIDO']);
            }


        }else {
            return Response::json(['data' => 'ERROR','msj'=>'NÚMERO DE CELULAR INVÁLIDO']);
        }



        //   Log::info('Showing user profile for user: '.print_r($data,true));


    }


    public function sendSMS($celular, $mensaje) {
        $this->metodo1($celular,$mensaje);

    }
    public function metodo1($celular, $mensaje) 
    {

        $client = new Client();
        $bod = [
            'from' => 'UNI ADMISIO',
            'to' => $celular,
            'text' => $mensaje,
        ];

        // $res = $client->request('POST','http://apismscorporativo.marketingmobileperu.com/sms/1/text/single', ['auth' =>  ['ADMISIONUNI', 'AU3enCTV20'],'headers' => ['Content-Type' =>'application/json'],'json'=> $bod ]);
        $client->request('GET',
            'http://api.hc.pe/apiv2/',
            [
                'query'=> ['user' => 'uni2022', 'password' => '6hPObL4x','SMSText'=>$mensaje,'GSM'=>$celular,'tag'=>'INSCRIPCIÓN ADMISION 2023-1'
                ]
            ]);
    }
    public function metodo2($celular,$mensaje)
    {
        $client = new Client();
        $uri = 'https://api.messaging-service.com/sms/1/text/single';
        $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
        'Authorization' => 'App 9c33f352b22bc777dc594ba413b9862e-c205bb91-6b13-4d14-bc76-31b053119104'
        ];
        $body = '{
        "from": "ADMISION-UNI",
        "to": [
            "51'.$celular.'"
        ],
        "text": "'.$mensaje.'"
        }';
        $options = [
            'headers' => $headers,
            'body' => $body,
        ];
        $client->request('POST',$uri,$options);
        //$request = new Request('POST', $uri, $options);
        //$client->sendAsync($request)->wait();

    }

}
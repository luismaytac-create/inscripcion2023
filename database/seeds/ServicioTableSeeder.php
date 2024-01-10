<?php

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::create(['codigo' => '475','descripcion'=>'PROSPECTO DEL POSTULANTE','banco'=>'ScotiaBank','partida'=>'--','monto'=>90,'activo'=>true]);
        Servicio::create(['codigo' => '521','descripcion'=>'FORMAT DE SOLIC DE SEMI BECA','banco'=>'ScotiaBank','partida'=>'--','monto'=>5,'activo'=>true]);
        Servicio::create(['codigo' => '464','descripcion'=>'INST. EDUC. ESTATAL','banco'=>'ScotiaBank','partida'=>'--','monto'=>410,'activo'=>true]);
        Servicio::create(['codigo' => '465','descripcion'=>'INST. EDUC. PRIVADA','banco'=>'ScotiaBank','partida'=>'--','monto'=>780,'activo'=>true]);
        Servicio::create(['codigo' => '469','descripcion'=>'INSC. TRASLADO EXT. EST.','banco'=>'ScotiaBank','partida'=>'--','monto'=>620,'activo'=>true]);
        Servicio::create(['codigo' => '470','descripcion'=>'INSC. TRASLADO EXT.PRIV.','banco'=>'ScotiaBank','partida'=>'--','monto'=>840,'activo'=>true]);
        Servicio::create(['codigo' => '468','descripcion'=>'INSC. TIT. GRADUADOS','banco'=>'ScotiaBank','partida'=>'--','monto'=>680,'activo'=>true]);
        Servicio::create(['codigo' => '473','descripcion'=>'INSC.  BACH. DIPLOMADO','banco'=>'ScotiaBank','partida'=>'--','monto'=>850,'activo'=>true]);
        Servicio::create(['codigo' => '466','descripcion'=>'INSC. SEMIBECA ESTATAL','banco'=>'ScotiaBank','partida'=>'--','monto'=>205,'activo'=>true]);
        Servicio::create(['codigo' => '467','descripcion'=>'INSC. SEMIBECA PRIVADA','banco'=>'ScotiaBank','partida'=>'--','monto'=>390,'activo'=>true]);
        Servicio::create(['codigo' => '474','descripcion'=>'PRUEBA DE APT. VOCACIONAL','banco'=>'ScotiaBank','partida'=>'--','monto'=>160,'activo'=>true]);
        Servicio::create(['codigo' => '507','descripcion'=>'INSCRIPCION EXTEMPORANEA','banco'=>'ScotiaBank','partida'=>'--','monto'=>70,'activo'=>true]);
        Servicio::create(['codigo' => '471','descripcion'=>'INSC. CNE ESTATAL','banco'=>'ScotiaBank','partida'=>'--','monto'=>205,'activo'=>false]);
        Servicio::create(['codigo' => '472','descripcion'=>'INSINSC. CNE PRIVADA','banco'=>'ScotiaBank','partida'=>'--','monto'=>390,'activo'=>false]);
        Servicio::create(['codigo' => '508','descripcion'=>'ING.DIR.INST.EDU.EST.CUO1','banco'=>'ScotiaBank','partida'=>'--','monto'=>205,'activo'=>false]);
        Servicio::create(['codigo' => '509','descripcion'=>'ING.DIR.INST.EDU.EST.CUO2','banco'=>'ScotiaBank','partida'=>'--','monto'=>205,'activo'=>false]);
        Servicio::create(['codigo' => '510','descripcion'=>'ING.DIR.INST.EDU.PRI.CUO1','banco'=>'ScotiaBank','partida'=>'--','monto'=>390,'activo'=>false]);
        Servicio::create(['codigo' => '511','descripcion'=>'ING.DIR.INST.EDU.PRI.CUO2','banco'=>'ScotiaBank','partida'=>'--','monto'=>390,'activo'=>false]);
        Servicio::create(['codigo' => '512','descripcion'=>'CONCUR.NAC.ESCO.LIMA-CALL','banco'=>'ScotiaBank','partida'=>'--','monto'=>140,'activo'=>false]);
        Servicio::create(['codigo' => '513','descripcion'=>'CONCUR.NAC.ESCOLAR PROV','banco'=>'ScotiaBank','partida'=>'--','monto'=>100,'activo'=>false]);
        Servicio::create(['codigo' => '514','descripcion'=>'MODAL.EXTRAOR.COLE.ESTAT','banco'=>'ScotiaBank','partida'=>'--','monto'=>410,'activo'=>false]);
        Servicio::create(['codigo' => '515','descripcion'=>'MODAL.EXTRAOR.COLE.PARTI','banco'=>'ScotiaBank','partida'=>'--','monto'=>780,'activo'=>false]);
        Servicio::create(['codigo' => '516','descripcion'=>'PRUE.APTIT.VOCAC.COLE.EST','banco'=>'ScotiaBank','partida'=>'--','monto'=>160,'activo'=>true]);
        Servicio::create(['codigo' => '520','descripcion'=>'INSCRIP. SIMULACRO','banco'=>'ScotiaBank','partida'=>'--','monto'=>50,'activo'=>false]);
        Servicio::create(['codigo' => '518','descripcion'=>'CONVAL.CURSO TRASL EXTERN','banco'=>'ScotiaBank','partida'=>'--','monto'=>440,'activo'=>true]);
        Servicio::create(['codigo' => '519','descripcion'=>'CONVAL.CURSO TITUL/GRADU','banco'=>'ScotiaBank','partida'=>'--','monto'=>660,'activo'=>true]);
        Servicio::create(['codigo' => '517','descripcion'=>'EXAM. MEDICO DEL INGRESAN','banco'=>'ScotiaBank','partida'=>'--','monto'=>70,'activo'=>true]);
        Servicio::create(['codigo' => '526','descripcion'=>'ING.DIR.ESC.EST.LIMA-CALL','banco'=>'ScotiaBank','partida'=>'--','monto'=>400,'activo'=>false]);
        Servicio::create(['codigo' => '527','descripcion'=>'ING.DIR.ESC.PRI.LIMA-CALL','banco'=>'ScotiaBank','partida'=>'--','monto'=>550,'activo'=>false]);
        Servicio::create(['codigo' => '528','descripcion'=>'ING.DIR.ESC.EST.PROV','banco'=>'ScotiaBank','partida'=>'--','monto'=>300,'activo'=>false]);
        Servicio::create(['codigo' => '529','descripcion'=>'ING.DIR.ESC.PRI.PROV','banco'=>'ScotiaBank','partida'=>'--','monto'=>400,'activo'=>false]);
        Servicio::create(['codigo' => '530','descripcion'=>'EXAM.MEDI.INGRE.IDESC','banco'=>'ScotiaBank','partida'=>'--','monto'=>150,'activo'=>false]);
        Servicio::create(['codigo' => '531','descripcion'=>'ING.DIR.ESC.EST.LIMA-CALL.SEMIB','banco'=>'ScotiaBank','partida'=>'--','monto'=>200,'activo'=>false]);
        Servicio::create(['codigo' => '532','descripcion'=>'ING.DIR.ESC.PRI.LIMA-CALL.SEMIB','banco'=>'ScotiaBank','partida'=>'--','monto'=>275,'activo'=>false]);
        Servicio::create(['codigo' => '533','descripcion'=>'ING.DIR.ESC.EST.PROV.SEMIB','banco'=>'ScotiaBank','partida'=>'--','monto'=>150,'activo'=>false]);
        Servicio::create(['codigo' => '534','descripcion'=>'ING.DIR.ESC.PRI.PROV.SEMIB','banco'=>'ScotiaBank','partida'=>'--','monto'=>200,'activo'=>false]);
    }
}

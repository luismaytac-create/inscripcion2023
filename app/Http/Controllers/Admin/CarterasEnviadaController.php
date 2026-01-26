<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarterasEnviada;

class CarterasEnviadaController extends Controller
{
    public function porDni(Request $request)
    {
        $dni = $request->get('dni');
        $carteras = CarterasEnviada::where('dni_ruc', $dni)
            ->select('descripcion', 'monto')
            ->get();
        return response()->json($carteras);
    }
}

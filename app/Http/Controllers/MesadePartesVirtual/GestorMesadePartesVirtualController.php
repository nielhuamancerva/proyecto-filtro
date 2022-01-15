<?php

namespace App\Http\Controllers\MesadePartesVirtual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestorMesadePartesVirtualController extends Controller
{
    public function index()
    {
        
        return ["Gestor Mesa de Partes Virtual"=>"GMDPV"];
    }
}

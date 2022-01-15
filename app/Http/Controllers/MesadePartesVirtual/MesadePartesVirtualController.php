<?php

namespace App\Http\Controllers\MesadePartesVirtual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MesadePartesVirtualController extends Controller
{
    public function index()
    {
        
        return ["Mesa de Partes Virtual"=>"MDPV"];
    }
}

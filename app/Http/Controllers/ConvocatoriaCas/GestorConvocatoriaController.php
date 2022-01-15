<?php

namespace App\Http\Controllers\ConvocatoriaCas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GestorConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if($request->hasFile('archivo'))
        {
            if($request->id==''){
                $normatividad = new Cas();
            }
            else{
                $normatividad=Cas::findOrFail($request->id);
                $img=$normatividad->archivo;
                if(File::exists(public_path("documentos/CAS/{$img}")))
                {
                    File::delete("documentos/CAS/{$img}");
                }
            }
            $file=$request->archivo;
            $file->move(public_path() . "/documentos/CAS",$file->getClientOriginalName());
            $normatividad->archivo = $file->getClientOriginalName();
        }
        else
        {
            $normatividad=Cas::findOrFail($request->id);
            $normatividad->archivo = $normatividad->archivo;
        }
        $normatividad->descripcion = $request->descripcion;
        $normatividad ->save();
        return $normatividad;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documents;
use App\Models\DocumentsDetalle;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{

    public function index(Request $request)
    {
 

        $query=Documents::select('documents.id','documents.expediente','documents.siaf','documents.tipo_documento',
        'documents.ruc_proveedor','documents.name_proveedor','documents.area_usuaria','documents.responsable',
        'documents.monto','documents_detalle.estado_documents','documents_detalle.referencia',
        'documents_detalle.created_at')
        ->join('documents_detalle', 'documents.id', '=', 'documents_detalle.id_documents')
        ->where('documents_detalle.estado_documents_detalle', '=', 1);
        ($request->siaf!='') ? $documentos=$query->where('documents.siaf','=',$request->siaf):"";
        ($request->expediente!='') ? $documentos=$query->where('documents.expediente','=',$request->expediente):"";

        $documentos=$query->orderBy('created_at', 'desc')->paginate(10);

        return ['paginate'=>[
            'total' => $documentos->total(),
            'current_page' => $documentos->currentPage(),
            'per_page' =>$documentos->perPage(),
            'last_page' =>$documentos->lastPage(),
            'from' => $documentos->firstItem(),
            'to' => $documentos->lastPage(),
        ],
        'filtrodocuments'=>$documentos];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {

        $documentos = new Documents();
        $documentos->expediente = $request->expediente;
        $documentos->siaf = $request->siaf;
        $documentos->tipo_documento =  $request->tipo_documento;
        $documentos->ruc_proveedor = $request->ruc_proveedor;
        $documentos->name_proveedor = $request->name_proveedor;
        $documentos->area_usuaria = $request->area_usuaria;
        $documentos->responsable = Auth::user()->name;
        $documentos->monto = $request->monto;
        $documentos->save();

        $detalleDocumentos = new DocumentsDetalle();
        $detalleDocumentos->ruc_proveedor = 70213603;
        $detalleDocumentos->estado_documents = "RECIBIDO";
        $detalleDocumentos->estado_documents_detalle = 1;
        $detalleDocumentos->id_documents = $documentos->id;
        $detalleDocumentos->referencia = "-";
        $detalleDocumentos->status_row = "ACTIVO";
        $detalleDocumentos->save();
        DB::commit();

        }

        catch (Exception $e) {
            DB::rollback();
            throw $e;
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

    }

    public function show($id)
    {

        $documentos=Documents::select('documents.id','documents.expediente','documents.siaf','documents.tipo_documento',
        'documents.ruc_proveedor','documents.name_proveedor','documents.area_usuaria','documents.responsable',
        'documents.monto','documents_detalle.estado_documents','documents_detalle.referencia',
        'documents_detalle.created_at')
        ->join('documents_detalle', 'documents.id', '=', 'documents_detalle.id_documents')
        ->where([['documents.id','=',$id],['documents_detalle.estado_documents_detalle','=',1]])->first();

        return ['filtrodocuments'=>$documentos];
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {

        DB::beginTransaction();

        try {

        $documentos = Documents::where('id','=',$request->id)->first();
        $documentos->expediente = $request->expediente;
        $documentos->siaf = $request->siaf;
        $documentos->tipo_documento =  $request->tipo_documento;
        $documentos->ruc_proveedor = $request->ruc_proveedor;
        $documentos->name_proveedor = $request->name_proveedor;
        $documentos->area_usuaria = $request->area_usuaria;
        $documentos->responsable = Auth::user()->name;
        $documentos->monto = $request->monto;
        $documentos->update();

        $detalleDocumentos = DocumentsDetalle::where([['documents_detalle.id_documents','=',$request->id],['documents_detalle.estado_documents_detalle','=',1]])->first();
 
        $detalleDocumentos->referencia = $request->referencia;
        $detalleDocumentos->update();

        DB::commit();

        }

        catch (Exception $e) {
            DB::rollback();
            throw $e;
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
        
    }

    public function destroy($id)
    {
        //
    }
}

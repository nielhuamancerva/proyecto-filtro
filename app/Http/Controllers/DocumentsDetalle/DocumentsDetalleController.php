<?php

namespace App\Http\Controllers\DocumentsDetalle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentsDetalle;
use App\Models\Documents;

use Illuminate\Support\Facades\DB;

class DocumentsDetalleController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
  
        $detalleDocumentos_old=DocumentsDetalle::where(['id_documents'=>$request->id,
            'estado_documents_detalle' => 1])->first();
        $detalleDocumentos_old->estado_documents_detalle = 0;
        $detalleDocumentos_old->update();

        $detalleDocumentos = new DocumentsDetalle();
        if($request->estado_documents=="OBSERVADO"){
            $detalleDocumentos->referencia = $request->referencia;
        }
        else{
            $detalleDocumentos->referencia = "-";
        }
        $detalleDocumentos->ruc_proveedor = 70213603;
        $detalleDocumentos->estado_documents = $request->estado_documents;
        $detalleDocumentos->estado_documents_detalle = 1;
        $detalleDocumentos->id_documents = $detalleDocumentos_old->id_documents;
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
        $query=Documents::select('documents.id','documents.expediente','documents.siaf','documents.tipo_documento',
        'documents.ruc_proveedor','documents.name_proveedor','documents.area_usuaria','documents.responsable',
        'documents.monto','documents_detalle.estado_documents','documents_detalle.referencia',
        'documents_detalle.created_at','documents_detalle.id')
        ->join('documents_detalle', 'documents.id', '=', 'documents_detalle.id_documents')
        ->where([['documents_detalle.id_documents', '=', $id],['documents_detalle.status_row','=','ACTIVO']]);

        $documentos=$query->orderBy('created_at', 'asc')->paginate(10);

        return ['detalledocuments'=>$documentos];
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $detalleDocumentosInactivo=DocumentsDetalle::where([['id','=',$id],['status_row','=','ACTIVO']])->first();
        $detalleDocumentosInactivo->status_row= 'INACTIVO';
        $detalleDocumentosInactivo->save();
    }
}

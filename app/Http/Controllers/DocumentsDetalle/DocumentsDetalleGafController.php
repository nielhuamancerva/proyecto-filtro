<?php

namespace App\Http\Controllers\DocumentsDetalle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentsGaf;
use App\Models\DocumentsDetalleGaf;

use Illuminate\Support\Facades\DB;

class DocumentsDetalleGafController extends Controller
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
  
        $detalleDocumentos_old=DocumentsDetalleGaf::where(['id_documents_gaf'=>$request->id,
            'estado_documents_detalle_gaf' => 1])->first();
        $detalleDocumentos_old->estado_documents_detalle_gaf = 0;
        $detalleDocumentos_old->update();

        $detalleDocumentos = new DocumentsDetalleGaf();
        $detalleDocumentos->area_destino = $request->area_destino;
        $detalleDocumentos->siaf = $request->siaf;
        $detalleDocumentos->id_documents_gaf = $request->id;
        $detalleDocumentos->nro_memo = $request->nro_memo;
        $detalleDocumentos->observacion = $request->observacion;
        $detalleDocumentos->estado_documents_detalle_gaf = 1;
        $detalleDocumentos->page = $request->page;
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
        $query=DocumentsGaf::select('documents_gaf.id as documents_id','documents_gaf.expediente','documents_gaf.tipo_documento','documents_gaf.nro_documento',
        'documents_gaf.area_usuaria','documents_gaf.descripcion','documents_gaf.created_at as fecha_ingreso','documents_detalle_gaf.id as detalledocuments_id',
        'documents_detalle_gaf.area_destino','documents_detalle_gaf.siaf','documents_detalle_gaf.nro_memo','documents_detalle_gaf.observacion',
        'documents_detalle_gaf.created_at','documents_detalle_gaf.page')
        ->join('documents_detalle_gaf', 'documents_gaf.id', '=', 'documents_detalle_gaf.id_documents_gaf')
        ->where('documents_detalle_gaf.id_documents_gaf','=',$id);

        $documentos=$query->orderBy('created_at', 'asc')->paginate(10);

        return ['detalledocuments'=>$documentos];
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

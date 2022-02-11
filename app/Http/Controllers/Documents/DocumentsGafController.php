<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentsGaf;
use App\Models\DocumentsDetalleGaf;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class DocumentsGafController extends Controller
{
    public function index(Request $request)
    {
 
        $query=DocumentsGaf::select('documents_gaf.id as documents_id','documents_gaf.expediente','documents_gaf.tipo_documento','documents_gaf.nro_documento',
        'documents_gaf.area_usuaria','documents_gaf.descripcion','documents_gaf.created_at as fecha_ingreso','documents_detalle_gaf.id as detalledocuments_id',
        'documents_detalle_gaf.area_destino','documents_detalle_gaf.siaf','documents_detalle_gaf.nro_memo','documents_detalle_gaf.observacion',
        'documents_detalle_gaf.created_at')
        ->join('documents_detalle_gaf', 'documents_gaf.id', '=', 'documents_detalle_gaf.id_documents_gaf')
        ->where('documents_detalle_gaf.estado_documents_detalle_gaf', '=', 1);
        ($request->siaf!='') ? $documentos=$query->where('documents_detalle_gaf.siaf','=',$request->siaf):"";
        ($request->expediente!='') ? $documentos=$query->where('documents_gaf.expediente','=',$request->expediente):"";

        $documentos=$query->orderBy('fecha_ingreso', 'desc')->paginate(10);

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
        DB::transaction()(function () {
            $documentos = new DocumentsGaf();
            $documentos->expediente = $request->expediente;
            $documentos->tipo_documento =  $request->tipo_documento;
            $documentos->nro_documento =  $request->nro_documento;
            $documentos->area_usuaria = $request->area_usuaria;
            $documentos->descripcion = $request->descripcion;
            if($request->fecha_ingreso!=null){
            $documentos->created_at = $request->fecha_ingreso;
            }
            $documentos->save();
    
            $detalleDocumentos = new DocumentsDetalleGaf();
            $detalleDocumentos->area_destino = $request->area_destino;
            $detalleDocumentos->siaf = $request->siaf;
            $detalleDocumentos->nro_memo = $request->nro_memo;
            $detalleDocumentos->id_documents_gaf = $documentos->id;
            $detalleDocumentos->observacion = $request->observacion;
            $detalleDocumentos->estado_documents_detalle_gaf = 1;
            $detalleDocumentos->created_at = $request->fecha_salida;
            $detalleDocumentos->updated_at = $request->updated_at;
            $detalleDocumentos->page = 0;
            $detalleDocumentos->save();
        }, 2);
    }

    public function show($id)
    {
        $documentos=DocumentsGaf::select('documents_gaf.id as documents_id','documents_gaf.expediente','documents_gaf.tipo_documento','documents_gaf.nro_documento',
        'documents_gaf.area_usuaria','documents_gaf.descripcion','documents_gaf.created_at as fecha_ingreso','documents_detalle_gaf.id as detalledocuments_id',
        'documents_detalle_gaf.area_destino','documents_detalle_gaf.siaf','documents_detalle_gaf.nro_memo','documents_detalle_gaf.observacion',
        'documents_detalle_gaf.created_at','documents_detalle_gaf.page')
        ->join('documents_detalle_gaf', 'documents_gaf.id', '=', 'documents_detalle_gaf.id_documents_gaf')
        ->where([['documents_gaf.id','=',$id],['documents_detalle_gaf.estado_documents_detalle_gaf','=',1]])->first();

        return ['filtrodocuments'=>$documentos];
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

        $documentos = DocumentsGaf::where('id','=',$request->id)->first();
        $documentos->expediente = $request->expediente;
        $documentos->tipo_documento =  $request->tipo_documento;
        $documentos->nro_documento =  $request->nro_documento;
        $documentos->area_usuaria = $request->area_usuaria;
        $documentos->descripcion = $request->descripcion;
        $documentos->update();

        $detalleDocumentos = DocumentsDetalleGaf::where([['id_documents_gaf','=',$request->id],['estado_documents_detalle_gaf','=',1]])->first();
        $detalleDocumentos->area_destino = $request->area_destino;
        $detalleDocumentos->siaf = $request->siaf;
        $detalleDocumentos->id_documents_gaf = $request->id;
        $detalleDocumentos->nro_memo = $request->nro_memo;
        $detalleDocumentos->observacion = $request->observacion;
        $detalleDocumentos->estado_documents_detalle_gaf = 1;
        $detalleDocumentos->page = $request->page;
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

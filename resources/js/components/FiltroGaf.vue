<template>
    <div>
        <div class="row">
            <div class="col-md-10 mx-auto p-5">
                <div class="card">
                   <div class="card-header"><h3 class="text-center text-dark"> FILTRO DE GERENCIA DE ADMINISTRACION </h3>  </div>
                        <div class="card-header">
                            <form class="form-inline" autocomplete="off">
  
                                    <div class="form-group">
                                        <input id="searchtxt" type="searchtxt" class="form-control" required placeholder="Siaf a Buscar" v-model="siafsearch">
                                    </div>
                            
                                    <div class="form-group">
                                        <input id="searchtxt" type="searchtxt" class="form-control" required placeholder="Expediente a Buscar" v-model="expedientesearch">
                                    </div>

                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearPersonas" @click.prevent="getFiltro">Buscar</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#CrearPersonas" @click.prevent="refresh">Limpiar</button>  
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CrearDocumentos">Nuevo</button>  
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Expediente</th>
                                    <th scope="col">Fecha Ingreso</th>
                                    <th scope="col">Tipo Documento</th>
                                    <th scope="col">Nro Documento</th>
                                    <th scope="col">A. Usuaria</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">A. Destino</th>
                                    <th scope="col">Siaf</th>
                                    <th scope="col">Nro Memo</th>
                                    <th scope="col">Fecha Salida</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                        
                                <tbody v-for="(item, index) in documentos" :key="item.id">
                            
                                    <tr>
                                    <th scope="row">{{index+paginate.current_page*paginate.per_page-(paginate.per_page-1)}}</th>
                                    <td>{{item.expediente}}</td>
                                    <td>{{item.fecha_ingreso}}</td>
                                    <td>{{item.tipo_documento}}</td>
                                    <td>{{item.nro_documento}}</td>
                                    <td>{{item.area_usuaria}}</td>
                                    <td>{{item.descripcion}}</td>
                                    <td>{{item.area_destino}}</td>
                                    <td>{{item.siaf}}</td>
                                    <td>{{item.nro_memo}}</td>
                                    <td>{{item.created_at}}</td>    
                                    <td>{{item.observacion}}</td>         
                                    <td>
                                        <button class="btn btn-primary" @click="preNewDocumentsDetalle(item)" data-toggle="modal" data-target="#NewDetalleDocumentos"><i class="fas fa-arrow-alt-circle-right"></i></button>
                                        <button class="btn btn-danger" @click="showDetalle(item)" data-toggle="modal" data-target="#DetalleDocumentos"><i class="fas fa-eye"></i></button>
                                         <button class="btn btn-warning" @click="editarDocuments(item)" data-toggle="modal" data-target="#EditarDocumentos"><i class="fas fa-edit"></i></button>
                                    </td>
                                    </tr>
                    
                                </tbody>
                            </table>
                        </div>
                    
                </div>
                <nav>
                        <ul class="pagination" aria-label="Page navigation example">
                            <li class="page-item" v-if="paginate.current_page > 1">
                                <a href="#" class="page-link" @click.prevent="changePage(paginate.current_page - 1)">
                                    <span>Atras</span>
                                </a>
                            </li>

                            <li class="page-item" v-for="page in pagesNumber" :key="page.id" v-bind:class="[ page == isActived ? 'active' : '']">
                                <a href="#" class="page-link" @click.prevent="changePage(page)">
                                    {{ page }}
                                </a>
                            </li>

                            <li class="page-item" v-if="paginate.current_page < paginate.last_page">
                                <a href="#" class="page-link" @click.prevent="changePage(paginate.current_page + 1)">
                                    <span>Siguiente</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
            </div>
        </div>


<!-----Crear Documentos ---->
            <div class="modal fade" id="CrearDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
                data-keyboard="false">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Documento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form v-on: click.prevent.self>
                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Expediente :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.expediente">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Tipo Documento :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.tipo_documento">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Nro Documento :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.nro_documento">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Area Usuaria :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.area_usuaria">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Descripcion :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.descripcion">
                                    </div>       

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Area Destino :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.area_destino">
                                    </div>

                                   <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Siaf :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.siaf">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Nro Memo :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.nro_memo">
                         
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Fecha Ingreso (2022-11-29):</label>
                                        <input type="date" class="col-sm-8 form-control" id="birthday" name="birthday" v-model="newdocumentosgaf.fecha_ingreso">
                                        </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Observacion :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdocumentosgaf.observacion">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click.prevent.self="newFiltroDocuments">Guardar</button>
                            </div>
                        </div>
                    </div>
            </div>
<!----- Fin Crear Documentos ---->

<!-----Editar Documentos ---->
            <div class="modal fade" id="EditarDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
                data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Documento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  @submit.prevent="editar">
                                   
                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Expediente :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.expediente">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Tipo Documento :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.tipo_documento">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Nro Documento :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.nro_documento">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Area Usuaria :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.area_usuaria">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Descripcion :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.descripcion">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Hoja de Cuaderno Cargo :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.page">
                                    </div>       

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Area Destino :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.area_destino">
                                    </div>

                                   <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Siaf :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.siaf">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Nro Memo :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.nro_memo">
                         
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Fecha Salida :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.fecha_salida">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Observacion :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="updatedocumentos.observacion">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click.prevent="updateDocumentsDetalle">Guardar</button>
                            </div>
                        </div>
                    </div>
            </div>
<!----- Fin Editar Documentos ---->

<!-----New Detalle Documentos ---->
            <div class="modal fade" id="NewDetalleDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
                data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Envio De Documentos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  @submit.prevent="editar">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label" >Expediente :{{newdetalledocumentosgaf.expediente}}</label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Cuaderno de Cargo Hoja :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdetalledocumentosgaf.page">
                                    </div>   

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Area Destino :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdetalledocumentosgaf.area_destino">
                                    </div>

                                   <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Siaf :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdetalledocumentosgaf.siaf">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Nro Memo :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdetalledocumentosgaf.nro_memo">
                         
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Fecha Salida :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdetalledocumentosgaf.fecha_salida">
                                    </div>

                                    <div class="form-group row">
                                        <label for="recipient-name" class="col-sm-4 col-form-label">Observacion :</label>
                                        <input type="text" class="col-sm-8 form-control" id="recipient-name" v-model="newdetalledocumentosgaf.observacion">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click.prevent="newDocumentsDetalle">Guardar</button>
                            </div>
                        </div>
                    </div>
            </div>
<!-----Fin New Detalle Documentos ---->

<!-----Show Detalle Documentos ---->
            <div class="modal fade" id="DetalleDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
                data-keyboard="false">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalle Documento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            <table class="table table-hover table-responsive">
                                 <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Expediente</th>
                                    <th scope="col">Fecha Ingreso</th>
                                    <th scope="col">Tipo Documento</th>
                                    <th scope="col">Nro Documento</th>
                                    <th scope="col">A. Usuaria</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">A. Destino</th>
                                    <th scope="col">Siaf</th>
                                    <th scope="col">Nro Memo</th>
                                    <th scope="col">Fecha Salida</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Hoja</th>
                                    </tr>
                                </thead>
                        
                                <tbody v-for="(item, index) in documentos_detalle_gaf" :key="item.id">
                            
                                    <tr>
                                    <th scope="row">{{index+paginate.current_page*paginate.per_page-(paginate.per_page-1)}}</th>
                                    <td>{{item.expediente}}</td>
                                    <td>{{item.fecha_ingreso}}</td>
                                    <td>{{item.tipo_documento}}</td>
                                    <td>{{item.nro_documento}}</td>
                                    <td>{{item.area_usuaria}}</td>
                                    <td>{{item.descripcion}}</td>
                                    <td>{{item.area_destino}}</td>
                                    <td>{{item.siaf}}</td>
                                    <td>{{item.nro_memo}}</td>
                                    <td>{{item.created_at}}</td>    
                                    <td>{{item.observacion}}</td>        
                                    <td>{{item.page}}</td>    
                                    </tr>
                    
                                </tbody>
                            </table>

                            </div>

                        </div>
                    </div>
            </div>
<!-----Fin Show Detalle Documentos ---->

    </div>
</template>
<script>
import User from '../User';
export default {
    data(){
        return{
            documentos: [],
            newdocumentosgaf: {id:'',expediente:'',tipo_documento:'',area_usuaria:'',
            descripcion:'',area_destino:'',nro_memo:'',fecha_ingreso:'',observacion:''},

            updatedocumentos: {id:'',expediente:'',tipo_documento:'',nro_documento:'',
            area_usuaria:'',descripcion:'',page:'',area_destino:'',nro_memo:'',fecha_salida:'',
            observacion:''},

            newdetalledocumentosgaf: {id:'',expediente:'',tipo_documento:'',area_usuaria:'',
            descripcion:'',page:'',area_destino:'',nro_memo:'',fecha_salida:'',observacion:''},

            documentos_detalle_gaf: [],
            documentos_Detalle_gaf: {id:''},

            siafsearch:'',
            expedientesearch: '',
            inactiveid:'',

            validateCheck:0,

            offset:3,
            paginate:{
            'total':0,
            'current_page':0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0}
        }
    },
    computed:{
        isActived:function(){
            return this.paginate.current_page;
        },
        pagesNumber:function(){
            if(!this.paginate.to){
                return [];
            }
            var from= this.paginate.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset*2);
            if (to >= this.paginate.last_page)
            {
                to = this.paginate.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    }
    ,
    mounted(){
        this.getFiltro();
    },
    methods:{
        getFiltro: function(page){
            console.log(this.expedientesearch);
            /*axios.get('/api/normas?page='+page+'&ano='+this.ano+'&tipo_documento='+this.tipo_documento+'&searchtxt='+this.searchtxt)*/
            User.filtroDocumentsGaf(page,this.siafsearch,this.expedientesearch).then((res)=>{
            this.documentos= res.data.filtrodocuments.data,
            console.log(res);
            this.year= res.data.year,
            this.paginate = res.data.paginate
        }).catch(function (error) {
                       localStorage.removeItem("auth-token");
                     alert('No se Realizo esta accion '+error);
  
        });
        },

        changePage: function(page){
            this.paginate.current_page = page;
            this.getFiltro(page);
        },

        select_año(event){
        this.ano=event.target.value;
        }, 

        closemodal(){
              $('#CrearDocumentos').modal('hide');
        },
        newFiltroDocuments(){
            this.validateCheck+=1;
            if(this.validateCheck==1){ 
 console.log(this.newdocumentosgaf);
                User.postFiltroDocumentsGaf(this.newdocumentosgaf).then((res) =>{
                console.log(res);
                this.closemodal();
                swal("Registro Exitoso!", this.newdocumentosgaf.expediente , "success");
                this.selected='';
                this.newdocumentosgaf={id:'',expediente:'',tipo_documento:'',area_usuaria:'',
                descripcion:'',area_destino:'',nro_memo:'',fecha_ingreso:'',observacion:''};
                this.changePage(this.page);
                this.validateCheck=0;
            }).catch(function (error) {
            swal("Registro no Se Completo!", error.response.data.message, "error"); 
            });
            }
            else{
                this.validateCheck-=1;
                this.changePage(this.page); 
            }
        },
        editarDocuments(item){
            User.GetByIdFiltroDocumentsGaf(item.documents_id).then(res=>{
                 console.log(item);
                console.log(res);
                this.updatedocumentos.id=res.data.filtrodocuments.documents_id;
                this.updatedocumentos.expediente=res.data.filtrodocuments.expediente;
                this.updatedocumentos.siaf=res.data.filtrodocuments.siaf;
                this.updatedocumentos.tipo_documento=res.data.filtrodocuments.tipo_documento;
                this.updatedocumentos.nro_documento=res.data.filtrodocuments.nro_documento;
                this.updatedocumentos.area_usuaria=res.data.filtrodocuments.area_usuaria;
                this.updatedocumentos.descripcion=res.data.filtrodocuments.descripcion;
                this.updatedocumentos.page=res.data.filtrodocuments.page;
                this.updatedocumentos.area_destino=res.data.filtrodocuments.area_destino;
                this.updatedocumentos.nro_memo=res.data.filtrodocuments.nro_memo;
                this.updatedocumentos.fecha_salida=res.data.filtrodocuments.fecha_salida;
                this.updatedocumentos.observacion=res.data.filtrodocuments.observacion;
        })
        },
        preNewDocumentsDetalle(item){
            User.GetByIdFiltroDocumentsGaf(item.documents_id).then(res=>{
                 console.log(item);
                console.log(res);
                this.newdetalledocumentosgaf.id=res.data.filtrodocuments.documents_id;
        })
        },
        updateDocumentsDetalle(){
            console.log(this.updatedocumentos);
            User.UpdateFiltroDocumentsGaf(this.updatedocumentos).then((res) =>{

            $('#EditarDocumentos').modal('hide');
            swal("Registro Actualizado Exitoso!", this.updatedocumentos.id +"" , "success");

            this.updatedocumentos= {id:'',expediente:'',tipo_documento:'',nro_documento:'',
            area_usuaria:'',descripcion:'',area_destino:'',nro_memo:'',fecha_salida:'',
            observacion:''},

            this.changePage(this.page);

            }).catch(function (error) {
            swal("Registro no Se Completo!", error.response.data.message, "error"); 
        });
        },
        newDocumentsDetalle(){
        this.validateCheck+=1;
        if(this.validateCheck==1)
        {
            console.log(this.newdetalledocumentosgaf);
            User.postDocumentsDetalleGaf(this.newdetalledocumentosgaf).then((res) =>{

            $('#NewDetalleDocumentos').modal('hide');
            swal("Registro Actualizado Exitoso!", this.newdetalledocumentosgaf.id +"" , "success");

            this.newdetalledocumentosgaf= {id:'',expediente:'',tipo_documento:'',area_usuaria:'',
            descripcion:'',page:'',area_destino:'',nro_memo:'',fecha_salida:'',observacion:''},

            this.changePage(this.page);
             this.validateCheck=0;
            }).catch(function (error) {
            swal("Registro no Se Completo!", error.response.data.message, "error"); 
        });
        }
        else{
            this.validateCheck-=1;
            this.changePage(this.page); 
            }

        },
        showDetalle(item){
            console.log(item);
            User.GetByIdDetalleDocumentsGaf(item.documents_id).then(res=>{
                console.log(res);
            this.documentos_detalle_gaf = res.data.detalledocuments.data;
            this.inactiveid = item.id;
        })
        },
        refresh(item){
            console.log(item);
            this.siafsearch='',
            this.expedientesearch= '',
            this.changePage(this.page)
        }
        ,
        inactiveDetalle(item){
        this.changePage(this.page);
        this.validateCheck+=1;
        
        if(this.validateCheck==1){
        User.InactiveDetalleDocuments(item.id).then(res=>{
                 swal("Registro Actualizado Exitoso!", item.id +"" , "success"); 

                User.GetByIdDetalleDocuments(this.inactiveid).then(res=>{
                    this.documentos_detalle = res.data.detalledocuments.data;
                                 this.validateCheck=0;
                })
            })

        }
        else{        
        this.validateCheck-=1;
        this.changePage(this.page);  }
        }
        

     }
     
}
</script>
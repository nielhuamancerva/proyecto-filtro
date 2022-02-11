<template>
    <div>
        <div class="row">
            <div class="col-md-10 mx-auto p-5">
                <div class="card">
                   <div class="card-header"><h3 class="text-center text-dark"> FILTRO DE DOCUMENTOS </h3>  </div>
                        <div class="card-header">
                            <form class="form-inline" autocomplete="off">
  
                                    <div class="form-group">
                                        <input id="searchtxt" type="searchtxt" class="form-control" required placeholder="Siaf a Buscar" v-model="siafsearch">
                                    </div>
                            
                                    <div class="form-group">
                                        <input id="searchtxt" type="searchtxt" class="form-control" required placeholder="Expediente a Buscar" v-model="expedientesearch">
                                    </div>

                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearPersonas" @click.prevent="getFiltro">Buscar</button>  
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CrearDocumentos">Nuevo</button>  
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Expediente</th>
                                    <th scope="col">N° Siaf</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">A. Usuaria</th>
                                    <th scope="col">Responsable</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                        
                                <tbody v-for="(item, index) in documentos" :key="item.id">
                            
                                    <tr>
                                    <th scope="row">{{index+paginate.current_page*paginate.per_page-(paginate.per_page-1)}}</th>
                                    <td>{{item.expediente}}</td>
                                    <td>{{item.siaf}}</td>
                                     <td>{{item.estado_documents}}</td>
                                     <td>{{item.name_proveedor}}</td>
                                     <td>{{item.area_usuaria}}</td>
                                     <td>{{item.responsable}}</td>
                                     <td>{{item.created_at}}</td>
                                    <td>{{item.referencia}}</td>                
                                    <td>
                                        <button class="btn btn-primary" @click="editarDocuments(item)" data-toggle="modal" data-target="#ActualizarDocumentos"><i class="fas fa-arrow-alt-circle-right"></i></button>
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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Documento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form v-on: click.prevent.self>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Expediente :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newdocumentos.expediente">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Siaf :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newdocumentos.siaf">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Monto :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newdocumentos.monto">
                                    </div>

                                    <div class="form-group" >
                                        <label for="exampleFormControlSelect1">Tipo de Documento</label>
                                        <select class="custom-select" aria-label="Default select example" v-model="newdocumentos.tipo_documento">
                                            <option selected>Selecciona un Tipo de Documento</option>
                                            <option value="SERVICIO">SERVICIO</option>
                                            <option value="COMPRA">COMPRA</option>
                                            <option value="PLANILLA">PLANILLA</option>
                                            <option value="RENDICION">RENDICION</option>
                                            <option value="REEMBOLSO">REEMBOLSO</option>
                                            <option value="VALORIZACION">VALORIZACION</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Ruc Proveedor:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newdocumentos.ruc_proveedor">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nombre Proveedor:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newdocumentos.name_proveedor">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Area Usuaria:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newdocumentos.area_usuaria">
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
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Expediente :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="updatedocumentos.expediente">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Siaf :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="updatedocumentos.siaf">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Monto :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="updatedocumentos.monto">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tipo de Documento</label>
                                        <select class="custom-select" aria-label="Default select example" v-model="updatedocumentos.tipo_documento">
                                            <option selected>Selecciona un Tipo de Documento</option>
                                            <option value="SERVICIO">SERVICIO</option>
                                            <option value="COMPRA">COMPRA</option>
                                            <option value="PLANILLA">PLANILLA</option>
                                            <option value="RENDICION">RENDICION</option>
                                            <option value="REEMBOLSO">REEMBOLSO</option>
                                            <option value="VALORIZACION">VALORIZACION</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Ruc Proveedor:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="updatedocumentos.ruc_proveedor">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nombre Proveedor:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="updatedocumentos.name_proveedor">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Area Usuaria:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="updatedocumentos.area_usuaria">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Referencia :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="updatedocumentos.referencia">
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
            <div class="modal fade" id="ActualizarDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
                data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Actualizar Documento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  @submit.prevent="editar">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label" >Expediente :{{updatedocumentos.expediente}}</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tipo de Acccion</label>
                                        <select class="custom-select" aria-label="Default select example" v-model="documentos_Detalle.estado_documents">
                                            <option selected>Selecciona un Tipo de Acccion</option>
                                            <option value="OBSERVADO">OBSERVADO</option>
                                            <option value="DEVENGADO">DEVENGADO</option>
                                            <option value="GAF">GAF</option>
                                            <option value="TESORERIA">TESORERIA</option>
                                            <option value="PRESUPUESTO">PRESUPUESTO</option>
                                            <option value="LOGISTICA">LOGISTICA</option>
                                        </select>
                                    </div>

                                    <div class="form-group" v-if="documentos_Detalle.estado_documents=='OBSERVADO'">
                                        <label for="recipient-name" class="col-form-label">Referencia :</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="documentos_Detalle.referencia">
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
                                    <th scope="col">N° Siaf</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">A. Usuaria</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Responsable</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                        
                                <tbody v-for="(item, index) in documentos_detalle" :key="item.id">
                            
                                    <tr>
                                    <th scope="row">{{index+paginate.current_page*paginate.per_page-(paginate.per_page-1)}}</th>
                                    <td>{{item.expediente}}</td>
                                    <td>{{item.siaf}}</td>
                                    <td>{{item.estado_documents}}</td>
                                    <td>{{item.name_proveedor}}</td>
                                    <td>{{item.area_usuaria}}</td>
                                    <td>{{item.monto}}</td>
                                    <td>{{item.responsable}}</td>
                                    <td>{{item.created_at}}</td>
                                    <td>{{item.referencia}}</td>
                                    <td>
                                        <button class="btn btn-danger" @click="inactiveDetalle(item)"><i class="fas fa-edit"></i></button></td>                
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
            newdocumentos: {id:'',expediente:'',estado:'',siaf:'',name_proveedor:'',responsable:'',
            monto:'',tipo_documento:'',ruc_proveedor:'',area_usuaria:''},

            updatedocumentos: {id:'',expediente:'',estado:'',siaf:'',name_proveedor:'',responsable:'',
            monto:'',tipo_documento:'',ruc_proveedor:'',area_usuaria:'',referencia:''},

            documentos_detalle: [],
            documentos_Detalle: {id:'',estado_documents:'',referencia:'-'},

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
            User.filtroDocuments(page,this.siafsearch,this.expedientesearch).then((res)=>{
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

           if(this.newdocumentos.expediente.trim() === '' || this.newdocumentos.name_proveedor === '' || this.newdocumentos.monto === ''
           || this.newdocumentos.tipo_documento === '' || this.newdocumentos.ruc_proveedor === ''){
                swal("Debes completar todos los campos antes de guardar!", "", "error");

                return;
            }

            if(this.validateCheck==1){
            User.postFiltroDocuments(this.newdocumentos).then((res) =>{
            console.log(res);
            this.closemodal();
            swal("Registro Exitoso!", this.newdocumentos.expediente , "success");
            this.selected='';
            this.newdocumentos={id:'',expediente:'',estado:'',siaf:'',name_proveedor:'',responsable:'',
            monto:'',tipo_documento:'',ruc_proveedor:'',area_usuaria:''};
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
            User.GetByIdFiltroDocuments(item.id).then(res=>{
                console.log(res);
                this.updatedocumentos.id=res.data.filtrodocuments.id;
                this.updatedocumentos.expediente=res.data.filtrodocuments.expediente;
                this.updatedocumentos.estado=res.data.filtrodocuments.estado;
                this.updatedocumentos.siaf=res.data.filtrodocuments.siaf;
                this.updatedocumentos.name_proveedor=res.data.filtrodocuments.name_proveedor;
                this.updatedocumentos.responsable=res.data.filtrodocuments.responsable;
                this.updatedocumentos.monto=res.data.filtrodocuments.monto;
                this.updatedocumentos.tipo_documento=res.data.filtrodocuments.tipo_documento;
                this.updatedocumentos.ruc_proveedor=res.data.filtrodocuments.ruc_proveedor;
                this.updatedocumentos.area_usuaria=res.data.filtrodocuments.area_usuaria;
                this.updatedocumentos.referencia=res.data.filtrodocuments.referencia;
        })
        },
        updateDocumentsDetalle(){
            User.UpdateFiltroDocuments( this.updatedocumentos).then((res) =>{

            $('#EditarDocumentos').modal('hide');
            swal("Registro Actualizado Exitoso!", this.updatedocumentos.id +"" , "success");
            this.updatedocumentos= {id:'',expediente:'',estado:'',siaf:'',name_proveedor:'',responsable:'',
            monto:'',tipo_documento:'',ruc_proveedor:'',area_usuaria:'',referencia:''};
            this.changePage(this.page);

            }).catch(function (error) {
            swal("Registro no Se Completo!", error.response.data.message, "error"); 
        });
        },
        newDocumentsDetalle(){
        this.validateCheck+=1;

        if(this.validateCheck==1)
        {
         this.documentos_Detalle.id=this.updatedocumentos.id;
            User.postDocumentsDetalle(this.documentos_Detalle).then((res) =>{

            $('#ActualizarDocumentos').modal('hide');
            swal("Registro Actualizado Exitoso!", this.documentos_Detalle.id +"" , "success");
            this.documentos_Detalle= {id:'',estado_documents:'',referencia:'-'},
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
            User.GetByIdDetalleDocuments(item.id).then(res=>{
            this.documentos_detalle = res.data.detalledocuments.data;
            this.inactiveid = item.id;
        })
        },
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
        else
        {                  this.validateCheck-=1;
                           this.changePage(this.page);  }

        }

     }
     
}
</script>
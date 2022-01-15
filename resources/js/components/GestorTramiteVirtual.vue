<template>
    <div>
        <div class="row">
        <div class="col-md-10 mx-auto">
            <h3 class="text-center"> LISTA DE DOCUMENTOS A TRAMITAR </h3>  
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Nuevo Operacion en DUC</button>  
             <button type="button" class="btn btn-danger" @click.prevent="dashboard">Atras</button>   
            <form class="form-inline" autocomplete="off">
                        <div class="form-group">
                                    <select class="custom-select" aria-label="Default select example">
                                        <option selected>Selecciona Al Tipo de Persona</option>
                                        <option value="1">Persona Natural</option>
                                        <option value="2">Persona Juridica</option>
                                    </select>
                                <input id="email" type="text" class="form-control" name="nrodocumento" placeholder="Nro de Documento" value="" required autocomplete="email">
                         

                        </div>
                        <div class="form-group">
                                     <label for="email" class="col-md-4 col-form-label text-md-right">Documento Unico Virtual</label>
                                <input id="email" type="text" class="form-control" name="asunto" placeholder="NRO DUC" value="" required autocomplete="email">
                        </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearPersonas" @click.prevent="getNoticias">Buscar</button>  
              </form> 
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Codigo Unico Documento</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Area</th>
                        <th scope="col">Fecha de Ingreso</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>CUD-TV-00001</td>
                                <td>Solicito Licencia de Funcionamiento</td>
                                <td>Gerencia de Servicios Publicos</td>
                                <td>01/10/2021</td>
                                <td>ACEPTADO</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" @click="editar(item)" data-toggle="modal" data-target="#exampleModal">Aceptar</button>
                                     <button class="btn btn-danger btn-sm" @click="editar(item)" data-toggle="modal" data-target="#exampleModal">Derivar</button>
                                </td>
                            </tr>
                    </tbody>
                </table>

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

              
    </div>
</template>
<script>
export default {
    data(){
        return{
            documentos: [],
            cargar_select_documento: [],   
            ano:'',
            tipo_documento:'',
            year: [],
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
       this.getNoticias();
        this.getDocumentos();
    },
    methods:{
        getNoticias: function(page){

            axios.get('/api/normas?page='+page+'&ano='+this.ano+'&tipo_documento='+this.tipo_documento).then((res)=>{
                console.log(this.ano);
                 console.log(this.tipo_documento);
            this.documentos= res.data.documentos.data,
            this.year= res.data.year,
            this.paginate = res.data.paginate
        }).catch(function (error) {
                     alert('No se Realizo esta accion '+error);
        });
        },

        getDocumentos(){
            axios.get('/api/tipodocumentos').then(res=>{
            this.cargar_select_documento = res.data
        })
        },

         dashboard(){
            this.$router.push({path: '/dashboard'})

        },

        changePage: function(page){
            this.paginate.current_page = page;
            this.getNoticias(page);
        },

        select_año(event){
        this.ano=event.target.value;
        }, 

        select_documento(event){
        this.tipo_documento=event.target.value;
        },

        editar(item){
            window.open(`/api/download/${item.id}`);
        },

        buscarnormas(){
   
        }
     }
}
</script>
<template>
    <div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header"><h3 class="text-center"> CONVOCATORIA CAS-2021 </h3></div>
                    <form class="form-inline" autocomplete="off"></form> 
                    <div class="card-body">
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Descargas</th>
                                <th scope="col">Accion</th>
                                </tr>
                            </thead>
                        
                            <tbody v-for="(item, index) in cas" :key="item.id">
                        
                                <tr>
                                <th scope="row">{{index+paginate.current_page*paginate.per_page-(paginate.per_page-1)}}</th>
                                <td>{{item.descripcion}} </td>
                                <td>{{item.archivo}}</td>               
                                <td>
                                <button class="btn btn-danger btn-xs" @click="descargar(item)"><i class="fas fa-file-download"></i></button>
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

    </div>
</template>
<script>
export default {
   data(){
        return{
            cas: [],
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
       this.getCas();
        this.getDocumentos();
    },
    methods:{
        getCas: function(page){
            axios.get('/api/cas?page='+page).then((res)=>{
            this.cas= res.data.cas.data,
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

        descargar(item){
            window.open(`/api/downloads/${item.id}`);
        },

        buscarnormas(){
   
        }
     }
}
</script>
<template>
    <div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center">GESTOR USUARIOS </h3>  
                <button type="button" class="btn btn-success" data-toggle="modal" @click.prevent="buttonnewuser">Nuevo Usuario</button>  
                <button type="button" class="btn btn-danger" @click.prevent="dashboard">Atras</button>   
                    <form class="form-inline" autocomplete="off"></form> 
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Estado</th>
                        </tr>
                    </thead>
                  
                    <tbody v-for="(item, index) in user" :key="item.id">
                        <tr>
                        <th scope="row">{{index+paginate.current_page*paginate.per_page-(paginate.per_page-1)}}</th>
                        <td>{{item.name}} </td>
                        <td>{{item.email}}</td>
                        <td>{{item.role}}</td>   
                        <td>{{item.estado}}</td>                  
                        <td style="white-space:nowrap;">
                            <button class="btn btn-warning btn-xs" @click="editar(item)" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit"></i></button>
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

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
                data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Normatividad</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                 <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus v-model="newuser.name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" v-model="newuser.email">
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Roles</label>
                            <div class="col-md-6">
                                <select class="custom-select" aria-label="Default select example" v-model="newuser.role">
                                    <option selected>Selecciona un Rol</option>
                                    <option value="ROLE_SUPERADMIN">ROLE_SUPERADMIN</option>
                                    <option value="ROLE_ADMIN">ROLE_ADMIN</option>
                                    <option value="ROLE_USER">ROLE_USER</option>
                                    <option value="ROLE_GAT">ROLE_GAT</option>
                                    <option value="ROLE_SGTI">ROLE_SGTI</option>
                                    <option value="ROLE_GPSDH">ROLE_GPSDH</option>
                                    <option value="ROLE_GIDUR">ROLE_GIDUR</option>
                                    <option value="ROLE_GDE">ROLE_GDE</option>
                                    <option value="ROLE_GAF">ROLE_GAF</option>
                                    <option value="ROLE_GDE">ROLE_GEPPI</option>
                                    <option value="ROLE_GAF">ROLE_TRAMITE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" v-model="newuser.password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="newuser.password_confirmation">
                            </div>
                        </div>
                    </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click.prevent="saveupdate">Guardar</button>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
    
</template>
<script>
import User from '../User';
export default {
   data(){
        return{
            user: [],
            nombrefile:null,
            newuser: {id:'',name: '',email: '',role:'',password:'',password_confirmation:''},
            cargar_select_documento: [],   
            ano:'',
            tipo_documento:'',
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
       this.GetAllUser();
        this.getDocumentos();
    },
    methods:{
        clickbutton(){
            $('#boton-descarga').click()
        },
        select_file(event){
          this.newcas.archivo=event.target.files[0];
           this.nombrefile=this.newcas.archivo.name;
        }, 
        GetAllUser: function(page){
             User.GetUserAll(page).then((res)=>{
                console.log(res);
            this.user= res.data.user.data,
            console.log(this.user);
            this.paginate = res.data.paginate
        }).catch(function (error) {
                     alert('No hay ninguno registro '+error);
        });
        },
        dashboard(){
            this.$router.push({path: '/dashboard'})

        },

        getDocumentos(){
            axios.get('/api/tipodocumentos').then(res=>{
            this.cargar_select_documento = res.data
        })
        },

        buttonnewuser(){
            this.$router.push({ path: '/register' })
        },

        changePage: function(page){
            this.paginate.current_page = page;
            this.getNoticias(page);
            this.page=page;
        },

        select_año(event){
        this.ano=event.target.value;
        }, 

        select_documento(event){
        this.tipo_documento=event.target.value;
        },

        editar(item){
            User.GetByIdUser(item.id).then(res=>{
                console.log(res.data.user);
                this.newuser.id=res.data.user.id;
                this.newuser.name=res.data.user.name;
                this.newuser.role=res.data.user.role;
                this.newuser.email=res.data.user.email;
                this.newuser.password=res.data.user.password;
                this.newuser.password_confirmation=res.data.user.password;
        })
        },
        saveupdate(){
            console.log(this.newuser);
             User.UpdateUser(this.newuser).then(() =>{
                console.log('saved');
               swal("Se Actualizo Exitoso!", this.newuser.name, "success");
            this.closemodal();
               this.GetAllUser();
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        },
        closemodal(){
            this.newuser={id:'',name: '',email: '',role:'',password:'',password_confirmation:''},
            this.nombrefile='',
            this.selected='',
              $('#exampleModal').modal('hide');
        },

        descargar(item){
            window.open(`/api/downloads/${item.id}`);
        },

        buscarnormas(){
   
        },
        crearcas(){
            let newcas = new FormData();
                for(let key in this.newcas){ 
                    newcas.append(key, this.newcas[key]);
                }

            User.PostCas(newcas).then((res) =>{
                $('#exampleModal').modal('hide');

                if(this.newcas.id===''){
                    swal("Registro Exitoso!", this.newcas.descripcion, "success");
                    this.changePage(this.page);
                }
                else{
                    const index = this.cas.findIndex(item => item.id === this.newcas.id);
                    this.cas[index] = res.data;
                    swal("Se Actualizo el Registro!", this.newcas.descripcion, "success");
                }
                    this.selected='';
                    this.newcas= {id:'',descripcion:'',archivo:null};
                    this.nombrefile='';
                }).catch(function (error) {
                    swal("Registro no Se Completo!",error.response.data.message, "error");
             
                });  
        },
     }
}
</script>
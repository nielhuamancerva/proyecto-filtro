<template>
     <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">REGISTRAR NUEVO USUARIO</div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus v-model="form.name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" v-model="form.email">
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Roles</label>
                            <div class="col-md-6">
                                <select class="custom-select" aria-label="Default select example" v-model="form.role">
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
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" v-model="form.password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="form.password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="saveForm"  type="submit" class="btn btn-primary">
                                    Register
                                </button>

                                  <button type="button" class="btn btn-danger" @click.prevent="atras">Atras</button>  
                            </div>
                        </div>
                    </form>
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
            form:{
                name: '',
                email: '',
                role:'',
                password:'',
                password_confirmation:''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
                
                User.register(this.form).then(() =>{
                console.log('saved');
                 this.$router.push({path: '/users'})
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        },
    atras(){
               this.$router.push({path: '/users'})
        }
    }
}
</script>
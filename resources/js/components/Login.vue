
<template>
    <div class="container">
    <div class="row justify-content-center">
            <div class="card" style="height: 100%;
                margin-top: 5%;
                margin-bottom: auto;
                width: 400px;
                background-color: rgba(0,0,0,0.5) !important;">
                <div class="card-header">
                    <h3 class="text-center">Control de Tramite Documentario</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                    </div>
                </div>

                <div class="card-body">
                    <form>
                        <div class="input-group form-group">
                                          <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>


                                <input id="email" v-model="form.email" type="email" class="form-control" name="email" required autocomplete="email" placeholder="email">
                 
                        </div>

                        <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                            <input id="password" v-model="form.password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="password">
                        </div>

                  
                            <div class="row col-auto align-items-center justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" >

                                    <label class="form-check-label text-white" for="remember">
                                       Recordar el Ingreso
                                    </label>
                                </div>
                            </div>
                 
                

                    <div class="card-footer">

                            <div class="row col-auto align-items-center justify-content-center">
                                <button @click.prevent="loginUser" type="submit" class="btn btn-primary">
                                 Login
                                </button>

                            </div>
                                                       <div class="row col-auto align-items-center justify-content-center">
                            <a class="btn btn-link" href="">
                                     Forgot Your Password?
                                    </a>
                                                       </div>
                     
                    </div>
                    </form>

                </div>
        </div>
    </div>
    
    </div>
  
</template>
<style>
           html,body{
                    background-image: url("/imagenes/fondo1.jpg");
                    background-size: cover;
                    background-repeat: no-repeat;
                    height: 100%;
                    font-family: 'Numans', sans-serif;
                    }



                .social_icon span{
                font-size: 60px;
                margin-left: 10px;
                color: #FFC312;
                }

                .social_icon span:hover{
                color: white;
                cursor: pointer;
                }

                .card-header h3{
                color: white;
                }

                .social_icon{
                position: absolute;
                right: 20px;
                top: -45px;
                }

                .input-group-prepend span{
                width: 50px;
                background-color: #FFC312;
                color: black;
                border:0 !important;
                }

                input:focus{
                outline: 0 0 0 0  !important;
                box-shadow: 0 0 0 0 !important;

                }

                .remember{
                color: white;
                }

                .remember input
                {
                width: 20px;
                height: 20px;
                margin-left: 15px;
                margin-right: 5px;
                }

                .login_btn{
                color: black;
                background-color: #FFC312;
                width: 100px;
                }

                .login_btn:hover{
                color: black;
                background-color: white;
                }

                .links{
                color: white;
                }

                .links a{
                margin-left: 4px;
                }
       
        </style>

<script>
import User from "../User";
export default {
    data(){
        return{
            form:{
                email: '',
                password: '',
                device_name:'browser'

            },
            errors: []
        }
    },
    methods:{
         loginUser(){
           User.login(this.form).then(response =>{
                 localStorage.setItem("auth-token",response.data.Body.auth_token);
                 const params = {id:response.data.Body.user.id, name:response.data.Body.user.name, 
                 email:response.data.Body.user.email, role:response.data.Body.user.role};

                    User.auth().then((res)=>{
                    this.user = res.data;
                    console.log(res.data.areas_id);
                    switch(res.data.areas_id) {
                        case 1 : return this.$router.push({ name: 'Normas',params}); 
                        case 2 : return this.$router.push({ name: 'FiltroGaf' });
                    }
                
                    });    
                
             }).catch((error) =>{
                  swal("Usuario o Contraseña Incorrecta!", error.response.data.message, "error");
            })
         }
    }
}
</script>
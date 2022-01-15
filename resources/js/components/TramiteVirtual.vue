<template>
     <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">MESA DE PARTES VIRTUAL</div>

                <div class="card-body">
                    <form>
                        
                        <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Tipo de Persona</label>
                            <div class="col-md-6">
                                <select class="custom-select" aria-label="Default select example">
                                    <option selected>Selecciona Al Tipo de Persona</option>
                                    <option value="1">Persona Natural</option>
                                    <option value="2">Persona Juridica</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nro. DNI / RUC</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nro" placeholder="Nro. DNI / RUC" value="" required autocomplete="nro" autofocus v-model="form.name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Apellidos y Nombres / Titular</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="titular" placeholder="Apellidos y Nombres / Titular" value="" required autocomplete="email" v-model="form.email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Correo Electronico" value="" required autocomplete="email" v-model="form.email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Numero de Celular</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="celular" placeholder="Nro de Celular" value="" required autocomplete="email" v-model="form.email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Nª de Folios del Documento</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="folios" placeholder="0" value="" required autocomplete="email" v-model="form.email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Asunto del Documento</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="asunto" placeholder="Asunto" value="" required autocomplete="email" v-model="form.email">
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Destino del Documento</label>
                            <div class="col-md-6">
                                <select class="custom-select" aria-label="Default select example">
                                    <option selected>Selecciona a La Gerencia </option>
                                    <option value="1">Gerencia de Administracion y Finanzas</option>
                                    <option value="2">Gerencia de Administracion Tributaria</option>
                                    <option value="3">Gerencia de Servicios Publicos</option>
                                    <option value="4">Gerencia de Promocion Social y Desarrollo Humano</option>
                                    <option value="5">Gerencia de Infraestructura Desarrollo Urbano</option>
                                    <option value="6">Gerencia de Estudios y Proyectos</option>
                                    <option value="7">Gerencia Municipal</option>
                                    <option value="8">Gerencia de Presupuesto y Racionalizacion</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Cargar Documento</label>
                            <div class="col-md-6">
                                <input v-show="false" id="boton-descarga" type="file" @change="select_file" >
                                <input type="button" @click.prevent="clickbutton" value="Seleccionar Archivo Local">
                                    <span id="glosaArchivos">{{nombre}}</span>
                            </div>
                        </div>

                         <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Verifique su Identidad</label>
                              <div class="col-md-6">
                                    <input type="checkbox" value="">
                              </div>
                          
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="saveForm"  type="submit" class="btn btn-primary">
                                    Registrar Documento
                                </button>
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

export default {
    data(){
        return{
            form:{
                name: '',
                email: '',
                password:'',
                password_confirmation:''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
            axios.post('/api/register', this.form).then(() =>{
                console.log('saved');
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>
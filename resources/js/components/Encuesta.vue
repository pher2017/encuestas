<template>
    <main class="main">
        <div class="container">
            <div class="row alert alert-primary ">
            <div class="col-md-12" role="alert">
                
                <h3><img src='images/logo1.png' class="rounded" alt="Sinof"> &nbsp;&nbsp;  Encuestas Sinof 2020 </h3>
            </div>
            </div>
                <template>
                    <div class="card-body" style="font-size: 10pt">
                        <div v-show="errorIngreso !== 0">
                            <div
                                class="form-group row row justify-content-md-center"
                            >
                                <div class="col-md-6">
                                    <h6>
                                        Ingrese su RUT sin puntos y sin digito verificador
                                        (ejemplo: 12345678)
                                    </h6>
                                    <div class="input-group">
                                        <input
                                             type="number"
                                            v-model.number="buscar"
                                            @keyup.enter="
                                                listarUsuarios(buscar)
                                            "
                                            class="form-control"
                                            placeholder="Ingrese su RUT"
                                        />
                                        &nbsp;
                                        <button
                                            type="submit"
                                            @click.stop.prevent="listarUsuarios(buscar),getParticipacion()"
                                            class="btn btn-primary"
                                        >
                                            Buscar Socio
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div
                                class="form-group row row justify-content-md-center"
                            >
                                <div v-if="nombre !== ''" class="col-md-6">
                                    <div class="form-group input-group mb-3">

                                        <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    >Nombre</span
                                                >
                                            </div>
                                        <input
                                            
                                            type="text"
                                            class="form-control"
                                            disabled
                                            placeholder="Nombre Socio"
                                            v-model="nombre"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="form-group row row justify-content-md-center"
                            >
                                <div v-if="nombre !== '' " class="col-md-6">
                                    <div v-if="arrayGet===null " class="form-group">
                                        <label
                                            ><h5>
                                                <small
                                                    >Antes de ingresar a la
                                                    encuesta, actualize sus
                                                    datos por favor
                                                </small>
                                            </h5></label
                                        >
                                    </div>
                                </div>
                            </div>
                            <div
                                class="form-group row row justify-content-md-center "
                            >
                                <div  v-if="nombre !== ''" class="col-md-6">
                                    <div v-if="arrayGet===null" class="form-group input-group mb-3">
                                       
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    >Correo</span
                                                >
                                            </div>
                                            <input
                                                id="email"
                                                type="email"
                                                name="email"
                                                class="form-control"
                                                placeholder="Por favor Ingrese un Correo"
                                                v-model="email"
                                            />
                                       
                                    </div>
                                </div>
                            </div>
                            <div
                                class="form-group row row justify-content-md-center"
                            >
                                <div v-if="nombre !== ''" class="col-md-6">
                                    <div v-if="arrayGet===null" class="form-group input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    >Telefono</span
                                                >
                                            </div>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Por favor Ingrese un N° Telefono"
                                            v-model="telefono"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="text-center text-error row justify-content-md-center"
                            >
                                <div class="col-md-6">
                                    <h6>
                                        <small>
                                            <div
                                                class="alert alert-danger"
                                                v-for="error in errorUsuario"
                                                :key="error"
                                                v-text="error"
                                            >
                                                {{ error }}
                                            </div>
                                        </small>
                                    </h6>
                                </div>
                            </div>
                            <div
                                class="form-group row row justify-content-md-center"
                            >
                                <div v-if="nombre !== ''" class="col-md-6">
                                    <div class="form-group">
                                        <button
                                            class="btn btn-info form-control btnagregar"
                                            @click="validaUsuario()"
                                        >
                                            Validar Datos
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card text-justify" v-if="errorIngreso !== 1 && idusers2===0">
                            <div class="card-header">
                                <div v-if="errorIngreso !== 1">
                                    <h5><small>{{ encuesta }}</small></h5>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div v-if="errorIngreso !== 1">
                                    <h6 lass="card-title">{{ pregunta }}</h6>
                                </div>
                            </div>
                            <div v-if="errorIngreso !== 1" class="card-body text-center">
                                <h6>
                                    <label
                                        class="form-check-label"
                                        for="radio1"
                                    >
                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            id="radio1"
                                            name="optradio"
                                            v-model="valor"
                                            value="1"
                                        />&nbsp;SI
                                    </label>
                                    &nbsp;&nbsp;
                                    <label
                                        class="form-check-label"
                                        for="radio2"
                                    >
                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            id="radio2"
                                            name="optradio"
                                            value="2"
                                            v-model="valor"
                                        />&nbsp;NO
                                    </label>
                                </h6>
                                <br />
                                <p></p>
                                <div
                                class="text-center text-error row justify-content-md-center"
                            >
                                <div class="col-md-6">
                                    <h6>
                                        <small>
                                            <div
                                                class="alert alert-danger"
                                                v-for="opcion in errorRespuesta"
                                                :key="opcion"
                                                v-text="opcion"
                                            >
                                                {{ opcion }}
                                            </div>
                                        </small>
                                    </h6>
                                </div>
                            </div>
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    @click="
                                        registrarIngreso(), actualizarUsers()
                                    "
                                >
                                    Enviar Encuesta
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            
        </div>
    </main>
</template>

<script>
import Vue from "vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
export default {
    data() {
        return {
            idusers: 0,
            idusers2:0,
            idregion: 0,
            arrayUsers: [],
            arrayUsers1: [],
            arrayIngreso: [],
            arrayPregunta: [],
            arrayRespuesta: [],
            arrayEncuesta: [],
            arrayParticipacion:[],
            arrayGet:null,
            nombre: "",
            rut: "",
            email: "",
            telefono: "",
            buscar: '',
            pregunta: "",
            encuesta: "",
            valor: 0,
            errorUsuario: [],
            errorRespuesta: [],
            errorIngreso: 1,
            errorOpcion:0,
            idencuesta: 0,
            idpregunta: 0,
            actualizar: 0,
            encontrar:0
        };
    },
    components: {
        vSelect
    },
    methods: {
        listarUsuarios: function listarUsuarios(buscar) {
            this.nombre= "",
            this.arrayUsers1=[];
            let me = this;
            var url = "users?buscar=" + buscar;
            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    me.arrayUsers1 = respuesta.users.data;
                    
                    if (me.arrayUsers1.length === 0 ) {
                        swal({
                            type: "error",
                            title: "Valida Socio",
                            text:
                                "el RUT Ingresado no existe en nuestra Base de datos, favor comunicarse con su Delegado"
                        });
                    } else {
                        
                        for (var i = 0; i < me.arrayUsers1.length; i++) {
                            me.nombre = me.arrayUsers1[i].nombre;
                            me.email = me.arrayUsers1[i].correo;
                            me.telefono = me.arrayUsers1[i].telefono;
                            me.idusers = me.arrayUsers1[i].id;
                            me.idregion = me.arrayUsers1[i].idregion;
                        }
                        me.getParticipacion();
                        me.validaRut();
                       
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        selectUser(search, loading) {
            let me = this;
            loading(true);

            var url = "users/get?filtro=" + search;
            axios
                .get(url)
                .then(function(response) {
                    let respuesta = response.data;
                    q: search;
                    me.arrayUsers = respuesta.user;
                    loading(false);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getDatosUser(val) {
            let me = this;
            me.loading = true;
            me.idusers = val.id;
            me.nombre = val.full;
            me.rut = val.rut;
        },
        selectReporte() {
            let me = this;
            var url = "reporte";
            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    me.arrayIngreso = respuesta.reportes.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        selectPregunta() {
            let me = this;
            var url = "pregunta";
            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    me.arrayPregunta = respuesta.preguntas;
                    me.pagination = respuesta.pagination;

                    for (var i = 0; i < me.arrayPregunta.length; i++) {
                        me.pregunta = me.arrayPregunta[i].pregunta;
                        me.idpregunta = me.arrayPregunta[i].id;
                        me.idencuesta = me.arrayPregunta[i].idencuensta;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        selectEncuesta() {
            let me = this;
            var url = "encuesta";
            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    me.arrayEncuesta = respuesta.encuestas;
                    me.pagination = respuesta.pagination;

                    for (var i = 0; i < me.arrayEncuesta.length; i++) {
                        me.encuesta = me.arrayEncuesta[i].descripcion;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        selectRespuesta() {
            let me = this;
            var url = "respuesta";
            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    me.arrayRespuesta = respuesta.respuestas.data;
                    for (var i = 0; i < me.arrayRespuesta.length; i++) {}
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        getParticipacion() {
           let me = this;
            var url = "get/user";
            axios
                .get(url, { params: { j: this.idusers } })
                .then(function(response) {
                    let respuesta = response.data;
                    me.arrayGet = respuesta.users;
                    
                   
                    
                })
                
                .catch(function(error) {
                    console.log(error);
                });
                
        },

        validaRut(){
              if(this.arrayGet === null ){
                  this.rut="ok";
               }else{
                    this.idusers2=this.arrayGet.iduser;
               console.log(this.idusers2);
               }
               
                     
                     
        },

        validEmail: function(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },

        validaUsuario() {
            this.validaRut();
            this.errorIngreso = 0;
            this.errorUsuario = [];
           

            if (this.email == "" || this.email == null) {
                this.errorUsuario.push("Ingrese Un correo");
            } else if (!this.validEmail(this.email)) {
                this.errorUsuario.push("Ingrese Un correo Valido");
            }
            if (this.telefono == "" || this.telefono == null) {
                this.errorUsuario.push("Ingrese Un Telefono");
            }
            if (this.idusers2 == this.idusers ) {
                swal({
                            type: "error",
                            title: "Valida Votación",
                            text:
                                "el RUT Ingresado ya ha realizado una votación para esta encuesta"
                                
                        }).then(function(){
                        location.reload();
                    })
                
            }


            if (this.errorUsuario.length) this.errorIngreso = 1;

            return this.errorIngreso;
        },
        registrarIngreso() {
            if (this.validarRespuesta()) {
				return;
			}

            let me = this;

            axios
                .post("registrar", {
                    idencuesta: this.idencuesta,
                    idpregunta: this.idpregunta,
                    idusers: this.idusers,
                    idregion: this.idregion,
                    idrespuesta: this.valor
                })
                .then(function(response) {
                    me.idregion = 0;
                    idencuesta = 0;
                    idpregunta = 0;
                    me.arrayPregunta = [];
                    me.arrayRespuesta = [];
                    me.arrayDetalle = [];
                    me.errorUsuario = [];
                   
                })
                .catch(function(error) {
                    console.log(error);
                });
                Swal({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Encuesta Enviada',
                        showConfirmButton: false,
                        timer: 1500
                    })
            location.reload();
        },
        actualizarUsers() {
            let me = this;

            axios
                .put("actualizar", {
                    email: me.email,
                    telefono: me.telefono,
                    id: me.idusers
                })
                .then(function(response) {})
                .catch(function(error) {
                    console.log(error);
                });
        },
        validarRespuesta(){
            
            this.errorOpcion = 0;
            this.errorRespuesta = [];

            if (this.valor == 0 || this.valor == "") 
                this.errorRespuesta.push("Seleccione una Opcion");
           
            

            if (this.errorRespuesta.length) this.errorOpcion = 1;

            return this.errorOpcion;

			
		}
    },
    mounted() {
        
        this.selectPregunta();
        this.selectRespuesta();
        this.selectEncuesta();
    
       
    }
};
</script>

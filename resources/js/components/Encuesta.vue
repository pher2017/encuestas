<template>
  <main class="main">
    <div class="alert alert-success" role="alert">
      <h3>Encuestas Sinof 2020</h3>
    </div>

    <div class="container-fluid">
      <div class="card">
        <template>
          <div class="card-body" style="font-size: 10pt">
            <div class="form-group row">
              <div class="col-md-6">
                <h6>
                  Ingrese su RUT sin puntos ni guion (ejemplo:
                  12345678)
                </h6>
                <div class="input-group">
                  <input
                    type="text"
                    v-model="buscar"
                    @keyup.enter="listarUsuarios(buscar)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  &nbsp;
                  <button
                    type="submit"
                    @click="listarUsuarios(buscar)"
                    class="btn btn-primary"
                  >Buscar Socio</button>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    v-if="nombre !== ''"
                    type="text"
                    class="form-control"
                    disabled
                    placeholder="Nombre Socio"
                    v-model="nombre"
                  />
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    id="email"
                    v-if="nombre !== ''"
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Por favor Ingrese su Correo"
                    v-model="email"
                  />
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div v-if="nombre !== ''" class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="telefono" v-model="telefono" />
                </div>
              </div>
            </div>
            <div class="text-center text-error">
              <h6><div class="alert alert-danger" v-for="error in errorUsuario" :key="error" v-text="error">{{error}}</div></h6>
            </div>
            <div class="form-group row">
              <div v-if="nombre!== ''" class="col-md-6">
                <div class="form-group">
                  <button class="btn btn-info form-control btnagregar" @click="validaUsuario()">Validar</button>
                </div>
              </div>
            </div>
            {{errorIngreso}}
            <div class="form-group row">
              <div v-if="errorIngreso !== 1" class="col-md-6">
                <div class="form-group">
                  <h4>{{ pregunta }}</h4>
                </div>
              </div>
            </div>
            <div v-if="errorIngreso !== 1" class="form-check-inline">
              <label class="form-check-label" for="radio1">
                <input
                  type="radio"
                  class="form-check-input"
                  id="radio1"
                  name="optradio"
                  v-model="valor"
                  value="SI"
                />SI
              </label>
            </div>
            <div v-if="errorIngreso !== 1" class="form-check-inline">
              <label class="form-check-label" for="radio2">
                <input
                  type="radio"
                  class="form-check-input"
                  id="radio2"
                  name="optradio"
                  value="NO"
                  v-model="valor"
                />NO
              </label>
            </div>
          </div>
        </template>
      </div>
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
      idusers: "",
      arrayUsers: [],
      arrayUsers1: [],
      arrayIngreso: [],
      arrayPregunta: [],
      arrayRespuesta: [],
      nombre: "",
      rut: "",
      email: "",
      telefono: "",
      buscar: "",
      pregunta: "",
      valor: "",
      errorUsuario : [],
      errorIngreso: 1
    };
  },
  components: {
    vSelect,
  },
  methods: {
    listarUsuarios: function listarUsuarios(buscar) {
      let me = this;
      var url = "users?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayUsers1 = respuesta.users.data;
          var j = 0;
          if (Object.entries(me.arrayUsers1).length === 0) {
            swal({
              type: "error",
              title: "Valida Socio",
              text:
                "el RUT Ingresado no existe en nuestra Base de datos, favor comunicarse con su Delegado",
            });
            console.log(me.arrayUsers1);
          } else {
            for (var i = 0; i < me.arrayUsers1.length; i++) {
              me.nombre = me.arrayUsers1[i].nombre;
              me.email = me.arrayUsers1[i].correo;
              me.telefono = me.arrayUsers1[i].telefono;
            }
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    selectUser(search, loading) {
      let me = this;
      loading(true);

      var url = "users/get?filtro=" + search;
      axios
        .get(url)
        .then(function (response) {
          let respuesta = response.data;
          q: search;
          me.arrayUsers = respuesta.user;
          loading(false);
        })
        .catch(function (error) {
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
        .then(function (response) {
          var respuesta = response.data;
          me.arrayIngreso = respuesta.reportes.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    selectPregunta() {
      let me = this;
      var url = "pregunta";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayPregunta = respuesta.preguntas;
          me.pagination = respuesta.pagination;

          for (var i = 0; i < me.arrayPregunta.length; i++) {
            me.pregunta = me.arrayPregunta[i].pregunta;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    selectRespuesta() {
      let me = this;
      var url = "respuesta";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayRespuesta = respuesta.respuestas.data;
          for (var i = 0; i < me.arrayRespuesta.length; i++) {}
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    checkForm: function (e) {
      this.errors = [];

      if (!this.name) {
        this.errors.push("El nombre es obligatorio.");
      }
      if (!this.email) {
        this.errors.push("El correo electrónico es obligatorio.");
      } else if (!this.validEmail(this.email)) {
        this.errors.push("El correo electrónico debe ser válido.");
      }

      if (!this.errors.length) {
        return true;
      }

      e.preventDefault();
    },
    validaUsuario(){

        this.errorIngreso = 0;
            this.errorUsuario = [];
           

            if (this.email == '' || this.email== null){
                this.errorUsuario.push("Ingrese Un correo");
            }
            else if (!this.validEmail(this.email)) {
                  this.errorUsuario.push("Ingrese Un correo Valido");
            }  
			 if (this.telefono == '' || this.telefono== null){
				  this.errorUsuario.push("Ingrese Un Telefono");
             }

			if (this.errorUsuario.length) this.errorIngreso = 1;

			return this.errorIngreso;


    }
  },
  mounted() {
    this.selectReporte();
    this.selectPregunta();
    this.selectRespuesta();
  },
};
</script>

<template>
    <main class="main">
        <div class="alert alert-success" role="alert">
            <h3>Encuestas Sinof 2020</h3>
        </div>

        <div class="container-fluid">
            <div class="card">
                <template>
                    <div class="card-body" style="font-size: 10pt">
                        <div class="form-group row border">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for>
                                        <h6>Socio2131321</h6>
                                    </label>
                                    <v-select
                                        :on-search="selectUser"
                                        label="full"
                                        :options="arrayUsers"
                                        v-bind:value="idusers"
                                        placeholder="Ingrese Su RUT"
                                        :onChange="getDatosUser"
                                        v-model="nombre"
                                    >
                                    </v-select>
                                </div>
                            </div>
                        </div>

                        <div>usuarios</div>

                        <br />

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Encuesta</div>

                                <div class="card-body">Pregunta</div>
                                <hr />
                                <div class="card-body">respuestas</div>
                            </div>
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
import 'vue-select/dist/vue-select.css';
export default {
    data(){
        return {
            idusers: "",
            arrayUsers: [],
            nombre: "",
            rut:""
        };
    },
    components: {
        vSelect
    },
    methods: {
        listarUsuarios: function listarUsuarios(){
            let me = this;
			var url =
				"users";
			axios
				.get(url)
				.then(function(response) {
					var respuesta = response.data;
					me.arrayUsers = respuesta.users;
					
				})
				.catch(function(error) {
					console.log(error);
				});

        },
        selectUser: function selectUser(search, loading) {
            let me = this;
            loading(true);

            var url = "users/get?filtro=" + search;
            axios
                .get(url)
                .then(function (response) {
                    let respuesta = response.data;
                    q: search;
                    me.arrayUsers = respuesta.users;
                    loading(false);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getDatosUser: function getDatosUser(val) {
            let me = this;
            me.loading = true;
            me.idusers = val.id;
            me.nombre=val.full;
            me.rut=val.rut;
        },
    },

    mounted() {
      this.listarUsuarios();
        console.log("Component mounted.");
    }
};
</script>

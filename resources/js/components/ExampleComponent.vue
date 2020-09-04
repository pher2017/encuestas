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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for>
                                        <h6>Socio</h6>
                                    </label>
                                    <v-select
                                        :on-search="selectUsers"
                                        label="nombre"
                                        :options="arrayUsers"
                                        v-bind:value="idusers"
                                        placeholder="Ingrese Su RUT"
                                        :onChange="getDatosUsers"
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
import vSelect from "vue-select";
import 'vue-select/dist/vue-select.css';
export default {
    data(){
        return {
            idusers: "",
            arrayUsers: [],
            nombre: "",
        };
    },
    components: {
        vSelect
    },
    methods: {
        selectUsers(search, loading) {
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
        getDatosUsers(val) {
            let me = this;
            me.loading = true;
            me.idusers = val.id;
            me.nombre=val.nombre;
        },
    },

    mounted() {
        console.log("Component mounted.");
    }
};
</script>

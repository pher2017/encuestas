<template>
   <main class="main">
        <div class="container">
            <div class="row ">
            <div class="col-md-12" role="">
                
                <h3><img src='images/logo1.png' class="rounded" alt="Sinof"> &nbsp;&nbsp;  Resultados Encuestas Sinof 2021 </h3>
            </div>
            </div>
                      
                <template>
                    <div class="card-body" style="font-size: 10pt">
                         <table class="table table-responsive table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Centro Gestor</th>
                            <th>Nombre Centro</th>
                            <th>Descripción Jardin</th>
                            <th>Cod. Ubic. SAP</th>
                            <th>Ubicacion SAP</th>
                            <th>Cod. Nivel SAP</th>
                            <th>Nivel SAP</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="nivel in arrayNivel" :key="nivel.id">
                            <td>
                               
                            </td>
                            <td v-text="nivel.id"></td>
                            <td v-text="nivel.cege"></td>

                            <td v-text="nivel.nombre"></td>
                            <td v-text="nivel.descripcion"></td>
                            <td v-text="nivel.codubic"></td>
                            <td v-text="nivel.descubic"></td>
                            <td v-text="nivel.codnivel"></td>
                            <td v-text="nivel.descnivel"></td>
                            <td>
                                <div v-if="nivel.condicion">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
                        
                    </div>
                </template>
            
        </div>
    </main>

</template>
<script>
import Vue from "vue";
export default {
      data() {
          return{

          }

      },
      methods:{

      }
    
}
</script>

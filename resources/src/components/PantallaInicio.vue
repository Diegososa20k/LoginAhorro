<template>

                    <div class="row">
                        <div class="form-floating mb-3">
                            <input v-model="nombre" type="text" class="form-control" placeholder="CantidadParaagregar" id="nombreInput">
                            <label for="nombreInput">Nombre del campo</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-floating mb-3">
                            <input v-model="porcentaje" type="number" class="form-control" placeholder="CantidadParaagregar" id="porcentajeInput">
                            <label for="porcentajeInput">Porcentaje destinado</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="descripcionInput">Descripcion</label>
                            <textarea rows="3" v-model="descripcion" class="form-control" type="text" placeholder="Descripcion" required id="descripcionInput" ></textarea>

                        </div>
                    </div>

                    <div class="form-check">
                        <input v-model="ahorro" class="form-check-input" type="checkbox" id="checkboxAhorro" required>
                        <label for="checkboxAhorro">Ahorro</label>
                    </div>

                    <div class="form-check">
                        <input v-model="gasto" class="form-check-input" type="checkbox" id="checkboxGasto" required >
                        <label for="checkboxGasto">Gasto</label>
                    </div>

                    <div class="modal-footer">


                    <button @click="saveAhorro()" type="button" class="btn btn-success" >Guardar cambios</button>
                </div>

  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        nombre: '',
        porcentaje: 0,
        descripcion: '',
        ahorro: false,
        gasto: false,
        // Agrega más variables para los otros campos según sea necesario
        ahorros: []
      };
    },
    mounted() {
      this.loadAhorros();
    },
    methods: {
      loadAhorros() {
        axios.get('/user/ahorros')
          .then(response => {
            this.ahorros = response.data;
            console.log(this.ahorros)
          })
          .catch(error => {
            console.error('Error al obtener ahorros:', error);
          });
      },
      saveAhorro() {
        const newAhorro = {
          nombre: this.nombre,
          porcentaje: this.porcentaje,
          descripcion: this.descripcion,
          ahorro : this.ahorro,
          gasto: this.gasto
          // Agrega más campos para los otros datos
        };

        axios.post('/user/ahorros', newAhorro)
          .then(response => {
            this.loadAhorros();
          })
          .catch(error => {
            console.error('Error al guardar el ahorro:', error);
          });
      }
    }
  };
  </script>

  <style scoped>
  /* Estilos específicos del componente si es necesario */
  </style>

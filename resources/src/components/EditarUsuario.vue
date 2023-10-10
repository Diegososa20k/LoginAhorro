<template>
    <div class="container">
        <div class="col-6">
            <div class="form-floating mb-3 me-3">
                <input type="text" class="form-control" placeholder="Nombre" v-model="Acampos.name">
                <label for="floatingInput">Nombre</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mb-3 me-3">
                <input type="text" class="form-control" placeholder="Correo" v-model="Acampos.email">
                <label for="floatingInput">Correo</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mb-3 me-3">
                <input type="text" class="form-control" placeholder="Contrasena" v-model="Acampos.password">
                <label for="floatingInput">Contrasena</label>
            </div>
        </div>


        <div>
            <button @click="updateUserData()" class="btn btn-primary">Guardar</button>
        </div>
    </div>




    <!-- <div>
      <div >
        <label for="name">Nombre:</label>
        <input type="text" id="name" v-model="Acampos.name" />

        <label for="email">Email:</label>
        <input type="email" id="email" v-model="Acampos.email" />

        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="Acampos.password" />
      </div>

      <button @click="updateUserData">Guardar Cambios</button>
    </div> -->
</template>

<script>
export default {
    data() {
        return {
        Acampos: []
        };
    },
    name: 'EditarUsuario',

    mounted() {
        this.getDialog();
    },

    methods: {
        getDialog() {
            axios
            .get('/user-data')
            .then(response => {
            this.Acampos = response.data.user;
            })
            .catch(error => {
            console.error('Error al obtener datos de usuario', error);
            });
        },

        updateUserData() {
            axios
            .put('/user-data', this.Acampos)
            .then(response => {
                console.log('Usuario actualizado con éxito:', response.data.message);
            })
            .catch(error => {
                console.error('Error al actualizar usuario', error);
            });

            console.log('Guardar cambios:', this.Acampos);
        }
    }
};
</script>


<!--
Codigo para mi put lol

axios
                    .put(`/api/ahorros/${this.tarjetaSeleccionada.id}`, data)
                    .then(response => {
                        console.log('Tarjeta actualizada correctamente');
                        this.CancelarDialog();
                        this.getDialog();
                    })
                    .catch(error => {
                        console.error('Error al actualizar la tarjeta', error);
                    }); -->

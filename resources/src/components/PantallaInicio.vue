<template>
    <div class="container">

        <div class="d-flex align-items-center">
            <div class="form-floating mb-3 me-3">
                <input type="number" class="form-control" placeholder="CantidadParaagregar" v-model="cantidadAgregar">
                <label for="floatingInput">Cantidad a Agregar</label>
            </div>

            <button @click="CantidadAgregar()" type="button" class="btn btn-agregar me-3">Agregar</button>

            <button @click="Guardar()" class="btn btn-agregar ms-auto"><i class="mdi mdi-content-save me-0" style="color: white; font-size: 30px;"></i></button>
        </div>

        <div class="row">
            <div v-for="campo in ahorros" :key="campo" class="col-6">
                <div :class="{'card': true, 'card-ahorro': campo.ahorro, 'card-gasto': campo.gasto}">
                    <h1 class="editTitulo">{{ campo.nombre }}</h1>
                    <h3 class="editTitulo">{{ campo.porcentaje }}%</h3>
                    <h4 class="editTitulo" v-if="mostrarResultado">C. Previa: ${{ campo.resultadoPrevio }}</h4>
                    <h4 class="editTitulo">Total: ${{ campo.resultadoAcumulado }}</h4>
                    <footer>
                        <button data-toggle="tooltip" title="Eliminar"  @click="DeleteDialog(campo.id)" type="button" class="btn btn-footer-eliminar float-end">
                            <i class="mdi mdi-delete"></i>
                        </button>
                        <button data-toggle="tooltip" title="Editar Contenido" @click="EditarTarjeta(campo)" type="button" class="btn  btn-footer float-end" data-bs-toggle="modal" data-bs-target="#miModal">
                            <i class="mdi mdi-pencil-box-outline"></i>
                        </button>
                        <button data-toggle="tooltip" title="Agrear Manualmente un monto" @click="EditarManual(campo.id, campo.resultadoAcumulado)" type="button" class="btn float-end btn-footer" data-bs-toggle="modal" data-bs-target="#miModal2">
                            <i class="mdi mdi-square-inc-cash"></i>
                        </button>
                    </footer>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-margen  btn-agregar btn-cuadrangular position-fixed bottom-0 end-0"
        data-bs-toggle="modal" data-bs-target="#miModal">
            <i class="mdi mdi-plus-box-outline"></i>
        </button>

        <div class="modal fade" id="miModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Datos de los Cards para control de ahorro</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input v-model="tarjetaSeleccionada.nombre" type="text" class="form-control" placeholder="CantidadParaagregar" id="nombreInput">
                                <label for="nombreInput">Nombre del campo</label>
                                <div v-if="!tarjetaSeleccionada.nombre" class="invalid-feedback">
                                    Nombre es obligatorio.
                                </div>
                                <div v-if="tarjetaSeleccionada.nombre" class="valid-feedback">
                                    Es Correcto, pero no funciono este mensaje
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-floating mb-3">
                                <input v-model="tarjetaSeleccionada.porcentaje" type="number" class="form-control" placeholder="CantidadParaagregar" id="porcentajeInput">
                                <label for="porcentajeInput">Porcentaje destinado</label>
                                <div v-if="!tarjetaSeleccionada.porcentaje" class="invalid-feedback">
                                    Porcentaje es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label for="descripcionInput">Descripcion</label>
                                <div v-if="!tarjetaSeleccionada.descripcion" class="invalid-feedback">
                                    descripcion es obligatorio.
                                </div>
                                <textarea rows="3" v-model="tarjetaSeleccionada.descripcion" class="form-control" type="text" placeholder="Descripcion" required id="descripcionInput" ></textarea>
                            </div>
                        </div>
                        <div class="form-check">
                            <input v-model="tarjetaSeleccionada.ahorro" class="form-check-input" type="checkbox" id="checkboxAhorro" required>
                            <label for="checkboxAhorro">Ahorro</label>
                            <div v-if="tarjetaSeleccionada.ahorro && tarjetaSeleccionada.gasto" class="invalid-feedback">
                                Solo puedes seleccionar un check.
                            </div>
                        </div>
                        <div class="form-check">
                            <input v-model="tarjetaSeleccionada.gasto" class="form-check-input" type="checkbox" id="checkboxGasto" required >
                            <label for="checkboxGasto">Gasto</label>
                            <div v-if="tarjetaSeleccionada.ahorro && tarjetaSeleccionada.gasto" class="invalid-feedback">
                                Solo puedes seleccionar un check.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="CancelarDialog()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button @click="saveAhorro()" data-bs-dismiss="modal" type="button" class="btn btn-success" >Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="miModal2" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agrega cantidad de forma normal (importante no tener % en el card)</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input readonly v-model="cantidadAnterior" class="form-control" type="number" placeholder="Cantidad Anterior" required>
                                <label for="CantidadAnterior">Cantidad Anterior</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-floating mb-3">
                                <input v-model="nuevaCantidad" class="form-control" type="number" placeholder="Nueva Cantidad" required>
                                <label for="NuevaCantidad">Agregar Cantidad</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-floating mb-3">
                                <button @click="CalcularTotal" type="button" class="btn btn-primary">Calcular</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-floating mb-3">
                                <input readonly v-model="resultadoAcumulado" class="form-control" type="number" placeholder="Nuevo Total" required id="nuevoTotal">
                                <label for="nuevoTotal">Nuevo Total</label>
                                <div v-if="!resultadoAcumulado > 0" class="invalid-feedback">
                                        La cantidad debe ser mayor a 0
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="CancelarManual()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button @click="GuardarManual()" type="button" class="btn btn-success" data-bs-dismiss="modal">Guardar Manual</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                tarjetaSeleccionada:{
                        id:null,
                        nombre:'',
                        porcentaje: 0,
                        ahorro: false,
                        gasto:false,
                        descripcion:'',

                    },
                    esEdicion: false,
                    cantidadAnterior: 0,
                    nuevaCantidad: 0,
                    resultadoAcumulado: 0,
                    idSeleccionado: null,
                    cantidadAgregar: 0,
                    mostrarResultado: false,
                // Agrega más variables para los otros campos según sea necesario
                ahorros: [],

            };
        },
        mounted() {
        this.loadAhorros();
        },
        methods: {
            Guardar() {
    //              // Calcular la suma de los porcentajes
    //         const sumaPorcentajes = this.Acampos.reduce((total, campo) => total + parseFloat(campo.porcentaje), 0);

    // // Verificar si la suma es mayor al 100%
    // if (sumaPorcentajes > 100) {
    //     alert('La suma de los porcentajes no puede ser mayor al 100%.');
    //     return; // Detener la ejecución si la validación falla
    // }
                const actualizaciones = this.ahorros.map(campo => ({
                    id: campo.id,
                    resultadoAcumulado: campo.resultadoAcumulado
                }));

                axios
                    .post('/user/ahorros/actualizar-resultado-acumulado', { actualizaciones })
                    .then(response => {
                        Swal.fire({
                                icon: 'success',
                                title: 'Se guardaron los nuevos totales',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        console.log('Campos resultadoAcumulado actualizados correctamente');
                    })
                    .catch(error => {
                        console.error('Error al actualizar campos resultadoAcumulado', error);
                    });
            },




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
                if (!this.tarjetaSeleccionada.nombre) {
                        // Agrega la clase 'is-invalid' al campo correspondiente
                        document.getElementById('nombreInput').classList.add('is-invalid');
                        return; // Detiene la ejecución si hay errores de validación
                    } else if (!this.tarjetaSeleccionada.porcentaje) {
                        document.getElementById('porcentajeInput').classList.add('is-invalid');
                        return;
                    } else if (!this.tarjetaSeleccionada.descripcion) {
                        document.getElementById('descripcionInput').classList.add('is-invalid');
                        return;
                    } else if (this.tarjetaSeleccionada.ahorro && this.tarjetaSeleccionada.gasto) {
                        document.getElementById('checkboxGasto').classList.add('is-invalid');
                        return;
                    }

                    // Calcular la suma de los porcentajes
                    let sumaPorcentajes = this.ahorros.reduce((total, campo) => {
                        if (this.esEdicion && campo.id === this.tarjetaSeleccionada.id) {
                            // Si estamos en edición, restamos el porcentaje anterior de la tarjeta editada
                            return total;
                        }
                        return total + parseFloat(campo.porcentaje);
                    }, 0);

                    // Sumar el porcentaje actual
                    sumaPorcentajes += parseFloat(this.tarjetaSeleccionada.porcentaje);

                    // Verificar si la suma es mayor al 100%
                    if (sumaPorcentajes > 100) {
                        Swal.fire(
                                    'Error',
                                    'La suma de los porcentajes de las tarjetas no puede ser mayor al 100%',
                                    'error'
                                );
                                return;
                    }

                    const data = {
                        nombre: this.tarjetaSeleccionada.nombre,
                        porcentaje: this.tarjetaSeleccionada.porcentaje,
                        ahorro: this.tarjetaSeleccionada.ahorro,
                        gasto: this.tarjetaSeleccionada.gasto,
                        descripcion: this.tarjetaSeleccionada.descripcion,
                        resultadoAcumulado: this.resultadoAcumulado || 0,
                    };

                    if (this.esEdicion) {
                        // Si ya tienes una id y estamos en edición, es una actualización (PUT)
                        axios.put(`/user/ahorros/${this.tarjetaSeleccionada.id}`, data)
                            .then(response => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Se actualizo la tarjeta con exito',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                console.log('Tarjeta actualizada correctamente');
                                this.CancelarDialog();
                                this.loadAhorros();
                                this.resultadoAcumulado = '';
                            })
                            .catch(error => {
                                console.error('Error al actualizar la tarjeta', error);
                            });
                    } else {
                        // Si no tienes una id, es una creación (POST)
                        axios.post('/user/ahorros', data)
                            .then(response => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Se guardo la tarjeta con exito',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                console.log('Tarjeta creada correctamente');
                                this.CancelarDialog();
                                this.loadAhorros();
                            })
                            .catch(error => {
                                console.error('Error al crear la tarjeta', error);
                            });
                    }

                // Reinicializar la bandera de edición después de guardar
                this.esEdicion = false;
            },

            calcularSumaPorcentajes() {
                const sumaPorcentajes = this.ahorros.reduce((total, campo) => total + parseFloat(campo.porcentaje), 0);
                return sumaPorcentajes;
            },

            CancelarManual(){
                this.resultadoAcumulado = 0
            },

            EditarManual(id, resultadoAcumulado) {
                // Almacena el ID seleccionado y la cantidad anterior
                this.idSeleccionado = id;
                this.cantidadAnterior = resultadoAcumulado;
                // Limpia los campos de nueva cantidad y resultado acumulado
                this.nuevaCantidad = 0;
                this.resultadoAcumulado = 0;
            },
            CalcularTotal() {
                // Verifica si las cantidades son numéricas antes de hacer el cálculo
                const nuevaCantidad = parseFloat(this.nuevaCantidad);
                const cantidadAnterior = this.cantidadAnterior === null ? 0 : parseFloat(this.cantidadAnterior);

                if (isNaN(nuevaCantidad) || isNaN(cantidadAnterior)) {
                    console.error('Las cantidades no son numéricas.');
                    return;
                }

                // Realiza el cálculo y actualiza el resultado acumulado
                if (this.resultadoAcumulado === null) {
                    this.resultadoAcumulado = nuevaCantidad;
                } else {
                    this.resultadoAcumulado = cantidadAnterior + nuevaCantidad;
                }
            },

            CancelarDialog(){
                this.tarjetaSeleccionada.id = null;
                this.tarjetaSeleccionada.ahorro = false;
                this.tarjetaSeleccionada.gasto = false;
                this.tarjetaSeleccionada.nombre = '';
                this.tarjetaSeleccionada.porcentaje = 0;
                this.tarjetaSeleccionada.descripcion = '';
            },

            CantidadAgregar() {
                const cantidad = parseFloat(this.cantidadAgregar);

                if (!isNaN(cantidad)) {
                    this.mostrarResultado = true;
                    this.ahorros.forEach(campo => {
                        campo.resultadoPrevio = ((campo.porcentaje / 100) * cantidad).toFixed(2);
                        if(!campo.resultadoAcumulado){
                            campo.resultadoAcumulado = ((campo.porcentaje / 100) * cantidad).toFixed(2);
                        }else{
                            campo.resultadoAcumulado = (parseFloat(campo.resultadoPrevio) + parseFloat(campo.resultadoAcumulado)).toFixed(2);
                        }

                    });
                }
            },

            EditarTarjeta(tarjeta) {
                this.tarjetaSeleccionada = {
                    id: tarjeta.id,
                    nombre: tarjeta.nombre,
                    porcentaje: tarjeta.porcentaje,
                    ahorro: tarjeta.ahorro === 1 ? true : false,
                    gasto: tarjeta.gasto === 1 ? true : false,
                    descripcion: tarjeta.descripcion,
                };
                this.esEdicion = true;
                console.log('EditarTarjeta', this.tarjetaSeleccionada);
            },

            DeleteDialog(id) {
                Swal.fire({
                icon: 'warning',
                title: 'Seguro quieres eliminar esta tarjeta  ?',
                showDenyButton: true,
                confirmButtonText: 'OK',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Eliminado!', '', 'success')
                        if (this.ahorros.some(ahorro => ahorro.id === id)) {
                            axios
                    .delete(`/user/ahorros/${id}`)
                    .then(response => {
                    console.log('Tarjeta eliminada correctamente');
                    // Aquí puedes actualizar tu vista para reflejar el cambio
                    // Por ejemplo, podrías eliminar la tarjeta de tu lista de tarjetas
                    this.ahorros = this.ahorros.filter(campo => campo.id !== id);
                    })
                    .catch(error => {
                    console.error('Error al eliminar la tarjeta', error);
                    });
                        } else {
                            Swal.fire('no se pudo eliminar', '', 'info')
                        }
                    } else if (result.isDenied) {
                        Swal.fire('no se elimino', '', 'info')
                    }
                })

            },


            GuardarManual() {

                if (this.resultadoAcumulado > 0) {
                    const cantidad = this.resultadoAcumulado;

                // Realiza una llamada a tu API para actualizar la cantidad de la tarjeta
                axios.post(`/user/ahorros/actualizar-resultado-acumulado/${this.idSeleccionado}`, { resultadoAcumulado: cantidad })
                    .then(response => {
                        this.loadAhorros();
                        console.log('Cantidad guardada exitosamente.');
                        this.resultadoAcumulado = '';
                        Swal.fire({
                            icon: 'success',
                            title: 'Se actualizo el total con exito',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        // Cerrar la modal después de guardar
                        //$('#miModal2').modal('hide');
                    })
                    .catch(error => {
                        console.error('Error al guardar la cantidad:', error);
                    });

                // Resetea el ID seleccionado después de guardar
                this.idSeleccionado = null;
                }else{
                    Swal.fire({
                            icon: 'error',
                            title: 'No se puede guardar si el Nuevo Total es 0',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    document.getElementById('nuevoTotal').classList.add('is-invalid');
                    return;
                    console.error('La cantidad debe ser mayor que 0. No se puede guardar.');
                }
            },
        }
    };
</script>

<style>

.btn-agregar:hover {
    background-color: #28a745; /* Cambia este color al color deseado */
    color: white; /* Cambia el color del texto al color deseado */
}

  /* Estilo para el botón al hacer clic (active) */
.btn-agregar:active {
    background-color: #28a745 !important; /* Cambia este color al color deseado (naranja) */
    color: white; /* Cambia el color del texto al color deseado */
}


.card{
    margin: 10px;
}
.editTitulo{
    margin-left: 10px;
}

.card-ahorro{
    background: linear-gradient(to bottom, #10a817	, #64DF85);
}

.card-gasto{
    background: linear-gradient(to bottom, #e03d2b, #FE7276);
}
/* .btn {
    color: aliceblue;
    background-color: #21DE4A;
    border-color: black;
} */

.btn-agregar{
    background-color: #205D07;
    color: azure;
}

.btn-margen {
    margin-right: 20px;
    margin-bottom: 20px;
    line-height: 1;
    border-radius: 2;
    border-radius: 100%;
}

.btn-footer{
    color: white;
    /* margin-block-end: 5px;
    margin-right: 5px; */
    background: linear-gradient(to bottom, #008500, #269926);
}

.btn-footer-eliminar{
    background: linear-gradient(to bottom, #A62300, #BF4E30);
    color: white;
}

.mdi-plus-box-outline{
    font-size: 50px;

}

.editTitulo{
    color: white;
}

.btn-footer:hover {
    background-color: #28a745; /* Cambia este color al color deseado */
    color: white; /* Cambia el color del texto al color deseado */
}

  /* Estilo para el botón al hacer clic (active) */
.btn-footer:active {
    background-color: #28a745 !important; /* Cambia este color al color deseado (naranja) */
    color: white; /* Cambia el color del texto al color deseado */
}


.btn-footer-eliminar:hover {
    background-color: #28a745; /* Cambia este color al color deseado */
    color: white; /* Cambia el color del texto al color deseado */
}

  /* Estilo para el botón al hacer clic (active) */
.btn-footer-eliminar:active {
    background-color: #28a745 !important; /* Cambia este color al color deseado (naranja) */
    color: white; /* Cambia el color del texto al color deseado */
}



</style>

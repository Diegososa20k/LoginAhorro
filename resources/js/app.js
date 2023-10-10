import './bootstrap';
import { createApp } from 'vue';
import PantallaInicio from '../src/components/PantallaInicio.vue';
import GraficaAhorroGasto from '../src/components/GraficaAhorroGasto.vue';
import PantallaInversion from '../src/components/PantallaInversion.vue';
import EditarUsuario from '../src/components/EditarUsuario.vue';



const app = createApp({
    components: {
        'pantalla-inicio': PantallaInicio,
        'grafica-ahorrogasto': GraficaAhorroGasto,
        'pantalla-inversion': PantallaInversion,
        'editar-usuario': EditarUsuario,


    }
});

app.mount('#app');

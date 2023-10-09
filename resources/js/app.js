import './bootstrap';
import { createApp } from 'vue';
import PantallaInicio from '../src/components/PantallaInicio.vue';


const app = createApp({
    components: {
        'pantalla-inicio': PantallaInicio,

    }
});

app.mount('#app');

import ClienteCuentaInfo from './components/Clients/ClienteCuentaInfo';
import TransaccionModal from './components/Clients/TransaccionModal';
import CerrarCuentaModal from './components/Clients/CerrarCuentaModal';

export const singleClinet = new Vue({
    el: '#singleClient',
    components: {
        ClienteCuentaInfo,
        TransaccionModal,
        CerrarCuentaModal
    },
    data: {
        selectedId: 0
    },
    methods: {
        activarCuenta(id){
            this.selectedId = id
            this.$eventHub.$emit('activar-cuenta', this.selectedId);
        }
    }
});
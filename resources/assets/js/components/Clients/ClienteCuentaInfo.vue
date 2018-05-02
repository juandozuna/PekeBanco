<template>
    <div v-show="titleVisible">
        <h2  class="text-center">Cuenta: <span class="text-secondary theme-font">{{cuenta.numero_cuenta}}</span> </h2>
        <hr>
        <div class="history">
            <table class="table table-bordered table-striped table-sm bg-info">
                <thead>
                    <tr class="text-center">
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tr in cuenta.transacciones">
                        <td>{{formatDate(tr.created_at)}}</td>
                        <td>{{tr.tipo}}</td>
                        <td>{{tr.amount}}</td>
                        <td>{{tr.balance}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>

        <!-- TODO: add buttons to make operations-->
        <div class="text-center mt-auto">
            <button class="btn btn-outline-primary" @click="retirar">Retirar</button>
            <button class="btn btn-outline-danger" @click="depositar">Depositar</button>
            <button class="btn btn-outline-secondary" @click="cerrar">Cerrar Cuenta</button>
        </div>

        <h2 class="text-center theme-font" v-if="cuenta != null">Balance Real: {{Number(cuenta.balance).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')}} PEKOS</h2>
    </div>
</template>

<script>
    export default {
        name: "cliente-cuenta-info",
        props: ['id'],
        data(){
            return{
                cuenta: {}
            }
        },
        computed: {
            titleVisible(){
                if(this.cuenta.hasOwnProperty('numero_cuenta'))
                    return true;
                else
                    return false;
            }
        },
        methods:{
            getCuenta(id){
                let self = this;
                axios.get('/api/cuenta/'+id)
                    .then(resp => {
                        self.cuenta = resp.data;
                    })
                    .catch(err => console.log(JSON.stringify(err)));

                console.log(this.cuenta);
            },
            formatDate(d){
                let dat = new Date(d);
                let options = {
                    year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit'
                }
                return dat.toLocaleTimeString("es", options);
            },
            retirar(){
                this.$eventHub.$emit('transaccion', {
                    tipo: 'Retiro',
                    num: this.cuenta.numero_cuenta,
                    id: this.cuenta.id
                });
            },
            depositar(){
                this.$eventHub.$emit('transaccion', {
                    tipo: 'Deposito',
                    num: this.cuenta.numero_cuenta,
                    id: this.cuenta.id
                });
            },
            cerrar(){

            }

        },
        mounted(){
            this.$eventHub.$on('activar-cuenta', this.getCuenta);
        }
    }
</script>

<style scoped>
    .history{
        height: 26vh;
        overflow-y: auto;
    }
</style>
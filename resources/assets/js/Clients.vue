<template>
    <div>
        <br>
        <h1 class="display-2 theme-font text-center text-color">Clientes</h1>
        <hr>
        <table class="table table-border table-stripped text-center bg-white" id="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Tarjeta</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(c,key) in clients" :key="key">
                    <td>{{c.nombre}}</td>
                    <td>{{c.apellido}}</td>
                    <td>{{edad(c.fecha_nacimiento)}}</td>
                    <td class="cuentaHolder"><div><span>{{creditCard(c)}} </span></div></td>
                    <td><a :href="'clientes/'+c.hashed_id+'/perfil'" class="btn btn-primary">Editar</a></td>
                    <td><a href="#" class="btn btn-secondary">Borrar</a></td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>

    export default {
        name: "clientes",
        data(){
            return{
                clients: [],
                allClients: [],
            }
        },
        methods:{
            edad(fecha){
                let dt = new Date(fecha);
                let year = dt.getFullYear();
                let now = new Date().getFullYear();
                return now-year;
            },
            cuentas(arr){
                return arr.length;
            },
            creditCard(c){
                if(c.tarjeta != null)
                    return c.tarjeta.codigoTarjeta.replace(/[^a-z0-9]+/gi, '').replace(/(.{4})/g, '$1 ');
                else
                    return "Sin tarjeta";

            }
        },
        created(){
            axios.get('api/clientes/all')
                .then((resp) => {
                    this.allClients = resp.data;

                    this.allClients.forEach(c => {
                        if(!c.trashed) this.clients.push(c);
                    });
                })
                .catch(err=>{
                    console.log("There was an error");
                    console.log(err);
                });

            $(document).ready(function(){
                setTimeout(() => {




                    $('#table').DataTable();
                }, 800)
            });
        },
        mounted(){

        }
    }
</script>

<style scoped>
    .text-color{
        color: #d06300;
    }

    .cuentaHolder{
        overflow-y: none;
        overflow-x: auto;
        width: 25%;
    }

    .cuentaHolder div{
        white-space: nowrap;
    }
</style>
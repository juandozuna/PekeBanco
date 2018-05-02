<template>
    <div class="modal fade" id="transaccion-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{texto}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">{{tipo}}</h2>
                    <div class="form-group">
                        <label>{{cantidadLabelText}}</label>
                        <input type="number" v-model="cantidad">
                        <small class="form-text text-danger" style="margin-left: 140px">{{cantidadFormatted}} PEKOS</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "transaccion-modal",
        data(){
            return{
                texto: '',
                tipo: '',
                idCuenta: '',
                numCuenta: '',
                cantidad: 4
            }
        },
        computed: {
          cantidadLabelText(){
              if(this.tipo == 'Retiro')
                  return "Cantidad a Retirar";
              else
                  return "Cantidad a Depositar";
          },
          cantidadFormatted: {
              get(){
                  return Number(this.cantidad).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
              },
              set(value){
                  this.cantidad = value;
              }
          }
        },
        methods:{
            abrir(obj){
                if(obj.tipo == 'Retiro')
                    this.texto = "Retiro de Cuenta Bancaria: " + obj.num;
                else
                    this.texto = "Deposito a Cuenta Bancaria: " + obj.num;

                this.numCuenta = obj.num;
                this.tipo = obj.tipo;
                this.idCuenta = obj.id;
                $('#transaccion-modal').modal('show');
            },
            submit(){

            }
        },
        created(){
            this.$eventHub.$on('transaccion', this.abrir);
        }
    }
</script>

<style scoped>

</style>
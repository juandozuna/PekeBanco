<template>
    <div class="modal fade" id="cerrar-cuenta-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Cerrar Cuenta: {{cuenta.numero_cuenta}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center"> Esta seguro de que quiere cerrar esta cuenta?</h2>
                    <br>
                    <h3 class="text-center theme-font text-primary">La cuenta tiene un balance de <span class="text-secondary">{{ Number(cuenta.balance).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') }} PEKOS </span></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="reset">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="submit">Cerrar Cuenta</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'cerrar-cuenta-modal',
        data(){
          return {
            cuenta: {}
          };
        },
        methods: {
            showModal(){
                $('#cerrar-cuenta-modal').modal('show');
            },
            hideModal(){
                $('#cerrar-cuenta-modal').modal('hide');
            },
            loadModal(obj){
                this.cuenta = obj;
                this.showModal();
            },
            reset(){
                this.cuenta = {};
                this.hideModal();
            },
            submit(){
                axios.delete(`/api/cuenta/${this.cuenta.id}/cerrar`)
                    .then( resp => {
                        this.hideModal();
                        this.$emit('cerrada-exitosa');
                        location.reload();
                    })
                    .catch( err => console.log(err.data));
            }
        },
        created(){
            this.$eventHub.$on('show-cerrar-cuenta-modal', this.loadModal)
        }
    }
</script>

<style scoped>

</style>
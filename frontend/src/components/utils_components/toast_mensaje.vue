<template>
   
        <div id="toast" class="alert alert-icon" :class="tipo_mensaje" role="alert">
                <button @click="mostrar=false" class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                    </button>
                <div class="alert-icon-aside">
                    <i data-feather="feather"></i>
                </div>
                <div class="alert-icon-content">
                    <h6 class="alert-heading strong"> {{mensaje}}</h6>
                </div>
        </div>
 
</template>

<script>

export default {
    name: 'toast',
    props:["mensaje","tipo_mensaje","mostrar"],
    data(){
        return{


        }
    },
    methods:{
        
    }
}
</script>

<style>

</style>
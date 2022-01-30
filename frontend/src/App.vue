<template>
  <div id="app">
      <router-view/>
  </div>
</template>

<script>
import Login from './components/seguridad_components/Login.vue';
import Create_user from './components/seguridad_components/Create_user.vue';
import Inicio_tutor from './components/tutor_components/Inicio_tutor.vue';
export default {
  name: 'app',
  components: {
    Login,
  },
  data(){
    return{
      
    }
  },
  props: {
    
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>

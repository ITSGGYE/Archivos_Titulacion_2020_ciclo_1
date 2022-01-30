import Vue from 'vue'
import Router from 'vue-router'
import Inicio_tutor from '@/components/tutor_components/Inicio_tutor'
import ExperienciaTutor from '@/components/tutor_components/ExperienciaTutor'
import EducacionTutor from '@/components/tutor_components/EducacionTutor'
import ValorPorHoraTutor from '@/components/tutor_components/ValorPorHoraTutor'
import Perfil_tutor from '@/components/tutor_components/Perfil_tutor'
import HorariosTutor from '@/components/tutor_components/HorariosTutor'
import MateriasTutor from '@/components/tutor_components/MateriasTutor'
import Inicio_estudiante from '@/components/estudiantes_components/Inicio_estudiante'
import MisTutores from '@/components/estudiantes_components/MisTutores'
import Create_user from '@/components/seguridad_components/Create_user'
import CreateUserEstudiante from '@/components/seguridad_components/CreateUserEstudiante'
import CreateUserProfesor from '@/components/seguridad_components/CreateUserProfesor'
import Login from '@/components/seguridad_components/Login'
import Perfil_estudiante from '@/components/estudiantes_components/Perfil_estudiante'
import pagos_estudiante from '@/components/estudiantes_components/pagos_estudiante'
import buscar_tutor from '@/components/estudiantes_components/buscar_tutor'
import niveles_academicos from '@/components/estudiantes_components/niveles_academicos'
import interes from '@/components/estudiantes_components/interes'
import toast_mensaje from '@/components/utils_components/toast_mensaje'




Vue.use(Router)


const routers = new Router({
  mode: 'history',
  hashbang: false,
  readonly: false,
  routes: [
    
    {
      path: '/CreateUserEstudiante',
      name: 'CreateUserEstudiante',
      component: CreateUserEstudiante,
    },

    {
      path: '/toast_mensaje',
      name: 'toast_mensaje',
      component: toast_mensaje,
    },
    
    {
      path: '/PagosProfesor/',
      name: 'PagosProfesor',
      component: () => import('@/components/tutor_components/PagosProfesor.vue')
    },
      
    {
      path: '/MisTutores',
      name: 'MisTutores',
      component: MisTutores,
    },

    {
      path: '/CreateUserProfesor',
      name: 'CreateUserProfesor',
      component: CreateUserProfesor,
    },
    {
      path: '/HorariosTutor',
      name: 'HorariosTutor',
      component: HorariosTutor,
    },
    {
      path: '/',
      name: 'Login',
      component: Login,
    },
    {
      path: '/ValorPorHoraTutor',
      name: 'ValorPorHoraTutor',
      component: ValorPorHoraTutor,
    },
    {
      path: '/MateriasTutor/',
      name: 'MateriasTutor',
      component: MateriasTutor,
    },
    {
      path: '/Create_user/',
      name: 'Create_user',
      component: Create_user
    },
    {
      path: '/Inicio_tutor/',
      name: 'inicio_tutor',
      component: Inicio_tutor,
    },
    {
      path: '/Inicio_estudiante/',
      name: 'inicio_estudiante',
      component: Inicio_estudiante,
    },

    {
      path: '/perfil_tutor/',
      name: 'Perfil_tutor',
      component: () => import('@/components/tutor_components/Perfil_tutor.vue')
    },

    {
      path: '/estudiantes/',
      name: 'Estudiantes',
      component: () => import('@/components/tutor_components/Estudiantes.vue')
    },

    {
      path: '/pagos_estudiante/',
      name: 'pagos_estudiante',
      component: pagos_estudiante
    },

    {
      path: '/ExperienciaTutor/',
      name: 'ExperienciaTutor',
      component: ExperienciaTutor,
    },
    {
      path: '/EducacionTutor/',
      name: 'EducacionTutor',
      component: EducacionTutor,
    },
    {
      path: '/perfil_estudiante/',
      name: 'perfil_estudiante',
      component: Perfil_estudiante,
    },
    {
      path: '/buscar_tutor/',
      name: 'buscar_tutor',
      component: buscar_tutor,
    },
    {
      path: '/niveles_academicos/',
      name: 'niveles_academicos',
      component: niveles_academicos,
    },
    {
      path: '/interes/',
      name: 'interes',
      component: interes,
    }

  ]
});

export default routers;


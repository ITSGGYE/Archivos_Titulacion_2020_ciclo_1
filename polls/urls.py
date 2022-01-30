"""
from django.urls import path, include
from django.conf import settings
from django.conf.urls.static import static
from polls.views import *

from polls import views

urlpatterns = [
    # ex: /polls/
    path('', views.index, name='index'),
    path('accounts/', include('allauth.urls')),
    ################## login con su salidad #########################

    path('login/', login, name='login'),
    path('inicio/', inicio,name='inicio'),
    path('salir/', salir, name='salir'),

    ########################  crear usuarios de estudiante y tutor ####################

    path('usuario_estudiante/', UsuarioEstudiante.as_view(), name='usuario_estudiante'),
    path('usuario_tutor/', UsuarioTutor.as_view(), name='usuario_tutor'),

   ######################### crear los datos de perfiles #######################

    path('perfil_tutor/',  ListarTutor.as_view(), name='perfil_tutor'),
    path('perfil_estudiante/', ListarEstudiante.as_view(), name='perfil_estudiante'),
    path('crear_niveles/', CrearNiveles.as_view(), name='crear_niveles'),
    path('editar_niveles/<int:pk>', EditarNiveles.as_view(), name='editar_niveles'),
    path('crear_intereses/', CrearIntereses.as_view(), name='crear_intereses'),
    path('editar_intereses/<int:pk>', EditarIntereses.as_view(), name='editar_intereses'),
    path('crear_experiencia/', CrearExperiencia.as_view(), name='crear_experiencia'),
    path('editar_experiencia/<int:pk>', EditarExperiencia.as_view(), name='editar_experiencia'),
    path('crear_educacion/', CrearEducacion.as_view(), name='crear_educacion'),
    path('editar_educacion/<int:pk>', EditarEducacion.as_view(), name='editar_educacion'),
    path('crear_certificacion/', CrearCertificacion.as_view(), name='crear_certificacion'),
    path('editar_certificacion/<int:pk>', EditarCertificacion.as_view(), name='editar_certificacion'),
    path('crear_materia/', CrearMateria.as_view(), name='crear_materia'),
    path('editar_materia/<int:pk>', EditarMateria.as_view(), name='editar_materia'),
    path('crear_valor/', CrearValor.as_view(), name='crear_valor'),
    path('editar_valor/<int:pk>', EditarValor.as_view(), name='editar_valor'),

   ################################ opciones de estudiate ########################

    path('buscar_tutor/', BusquedaTutor.as_view(), name='buscar_tutor'),

   ################################### opciones de  Tutor ############################

    path('horarios_tutor/', HorariosTutor.as_view(), name='horarios_tutor'),

 # ex: /polls/5/

    path('<int:question_id>/', views.detail, name='detail'),
    # ex: /polls/5/results/
    path('<int:question_id>/results/', views.results, name='results'),
    # ex: /polls/5/vote/
    path('<int:question_id>/vote/', views.vote, name='vote'),

] + static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
"""
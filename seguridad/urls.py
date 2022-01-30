from django.urls import path, include
from django.conf import settings
from django.conf.urls.static import static
from .views import *
from .Api import *
from rest_framework import routers

router = routers.SimpleRouter()
router.register('PaisApi',PaisApi)
router.register('CiudadApi',CiudadApi)
router.register('RolesApi',RolesApi)
router.register('UsuariosApi',UsuariosApi)
router.register('PersonaApi',PersonaApi,basename='PersonaApi')


urlpatterns = [
    path('base/',base,name='base'),
    path('login/',login,name='login'),
    path('UsuariosDataApi/',UsuariosDataApi.as_view(),name='UsuariosDataApi'),
    path('IniciarSesion/',IniciarSesion.as_view(),name='IniciarSesion'),
    path('PersonaApiLocation/',PersonaApiLocation.as_view(),name='PersonaApiLocation'),
  	path('GoogleSesion/',GoogleSesion.as_view(),name='GoogleSesion'),
  	path('Correos_electronicos/',Correos_electronicos.as_view(),name='Correos_electronicos'),
  	path('GuardarFotoPerfil/',GuardarFotoPerfil.as_view(),name='GuardarFotoPerfil')
  ]

urlpatterns += router.urls
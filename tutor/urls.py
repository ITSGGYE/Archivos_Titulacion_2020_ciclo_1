from django.urls import path, include
from django.conf import settings
from django.conf.urls.static import static
from .views import *
from .Api import *
from rest_framework import routers

router = routers.SimpleRouter()
router.register('PerfilTutorApi',PerfilTutorApi)
router.register('MateriasApi',MateriasApi)
urlpatterns = [
	path('GuardarInformacionTutor/',GuardarInformacionTutor.as_view(),name='GuardarInformacionTutor'),
	path('ExperienciaApi/',ExperienciaApi.as_view(),name='ExperienciaApi'),	
	path('Educacion_tutorApi/',Educacion_tutorApi.as_view(),name='Educacion_tutorApi'),
	path('Certificacion_tutorApi/',Certificacion_tutorApi.as_view(),name='Certificacion_tutorApi'),
	path('ValorPorHoraApi/',ValorPorHoraApi.as_view(),name='ValorPorHoraApi'),
	path('MateriasTutorApi/',MateriasTutorApi.as_view(),name='MateriasTutorApi'),
	path('HorariosTutorApi/',HorariosTutorApi.as_view(),name='HorariosTutorApi'),
	path('RealizarPAgo/',RealizarPAgo.as_view(),name='RealizarPAgo')
	#RealizarPAgo
]
urlpatterns += router.urls
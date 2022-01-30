from django.urls import path, include
from django.conf import settings
from django.conf.urls.static import static
from .views import *
from .api import *
from rest_framework import routers



router = routers.SimpleRouter()
router.register('EstudianteApi',EstudianteApi)
router.register('RepresentanteApi',RepresentanteApi)
router.register('MateriasEApi',MateriasEApi)

urlpatterns = [
	path('GuardarInformacionEstudiante/',GuardarInformacionEstudiante.as_view(),name='GuardarInformacionEstudiante'),
	path('NivelesApi/',NivelesApi.as_view(),name='NivelesApi'),
	path('MateriasEstudianteApi/', MateriasEstudianteApi.as_view(), name='MateriasEstudianteApi'),
	path('Buscar/', Buscar.as_view(), name='Buscar'),
	path('AsignarTutor/',AsignarTutor.as_view(),name='AsignarTutor'),
	path('EvaluacionEstudianteApi/',EvaluacionEstudianteApi.as_view(),name='EvaluacionEstudianteApi')

]
urlpatterns += router.urls

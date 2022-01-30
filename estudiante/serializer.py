from rest_framework import serializers
from .models import *
from seguridad.Serializers import *
from tutor.models import *
from tutor.serializers import * 


class transacciones_logSerializer(serializers.ModelSerializer):
	class Meta:
		model = transacciones_log
		fields = ('id_tutor','valor_pagado','comision','valor_total','fechora_trx','secuencial','cod_resultado','mensaje_log')
	id_tutor = PerfilTutorSerializer()

class transacciones_Serializer(serializers.ModelSerializer):
	class Meta:
		model = transacciones_log
		fields = "__all__"

class MateriasESerializer(serializers.ModelSerializer):
	class Meta:
		model = MateriasAfines
		fields = "__all__"

class EvaluacionEstudianteSerializer(serializers.ModelSerializer):
	class Meta:
		model =  EvaluacionEstudiante
		fields = "__all__"
		

class RepresentanteSerializer(serializers.ModelSerializer):
	class Meta:
		model = Representante
		fields = ('id_representante','nombresr','apellidosr','identificacionr','correor','fecha_nacimientor','generor','paisr','ciudadr')

	ciudadr = CiudadSerializers()
	paisr = PaisSerializers()

class NivelesSerializer(serializers.ModelSerializer):
    class Meta:
        model = Nivel_Academico
        fields = '__all__'

class EstudianteSerializer(serializers.ModelSerializer):
	class Meta:
		model = Estudiante
		fields = ('id_usuario','id_estudiante','id_representante','tutoria_online','tutoria_prescencial')


	id_usuario = UsuarioSerializer()
	id_representante = RepresentanteSerializer()

class MateriasEstudianteSerializer(serializers.ModelSerializer):
	class Meta:
		model = Estudiante
		fields = ('id_estudiante','id_usuario','id_materias_afines')


class RepresentanteEstudianteSerializer(serializers.ModelSerializer):
	class Meta:
		model = Estudiante
		fields = ('id_estudiante', 'id_usuario', 'id_representante')



class TutorBuscarSerializer(serializers.ModelSerializer):
	#id_materias_afines = MateriasESerializer(many=True,source="materias_muestra")
	class Meta:
		model=Tutor
		fields = ('id_tutor','id_usuario','id_materias_afines','horario','educacion','calificacion','comentarios_negativos','comentarios_positivos')
	
	id_usuario = UsuarioSerializer()

	horario = serializers.SerializerMethodField('get_horario')
	educacion = serializers.SerializerMethodField('get_educacion')

	comentarios_positivos = serializers.SerializerMethodField('get_comentarios_positivos')
	comentarios_negativos = serializers.SerializerMethodField('get_comentarios_negativos')

	def get_comentarios_negativos(self,obj):
		return EvaluacionEstudiante.objects.filter(id_tutor=obj.id_tutor).values('comentario_negativo')


	def get_comentarios_positivos(self,obj):
		return EvaluacionEstudiante.objects.filter(id_tutor=obj.id_tutor).values('comentario')

	def get_educacion(self,obj):
		return Educacion_tutor.objects.filter(id_tutor=obj.id_tutor).values('universidad','titulacion','nota')

	def get_horario(self,obj):
		return Horarios_tutor.objects.filter(tutor=obj.id_tutor,estado=True).values('dias','hora_inicio','hora_fin')

class AsignarTutorSerializer(serializers.ModelSerializer):
	class Meta:
		model = TutorAsignado
		fields = ('id_tutor','fecha_contacto','estado')

	id_tutor = PerfilTutorSerializer()


class EstudiantesAsignadosSerializer(serializers.ModelSerializer):
	class Meta:
		model = TutorAsignado
		fields = ('id_estudiante','fecha_contacto','estado')

	id_estudiante = EstudianteSerializer()

class SegSerializer(serializers.ModelSerializer):
	class Meta:
		model = SeguimientoClases
		fields = '__all__'
from rest_framework import serializers
from .models import *
from seguridad.Serializers import *

#transacciones_log



	


class HorariosSerializers(serializers.ModelSerializer):
	class Meta:
		model = Horarios_tutor
		fields = "__all__"

class MateriasSerializer(serializers.ModelSerializer):
	class Meta:
		model = MateriasAfines
		fields = "__all__"

class PersonaSerializer(serializers.ModelSerializer):
	class Meta:
		model = Persona
		fields = ('id_persona','nombres','apellidos','identificacion','latitud','longitud','genero','fecha_nacimiento','ciudad','pais','foto')

	#pais = serializers.SerializerMethodField('get_pais')
	ciudad = CiudadSerializers()
	pais = PaisSerializers()


class ExperienciaTutorSerializer(serializers.ModelSerializer):
	class Meta:
		model = Experiencia_tutor
		fields = "__all__"

class ValorPorHoraSerializer(serializers.ModelSerializer):
	class Meta:
		model = ValorPorHora
		fields = "__all__"

class EducacionTutorSerializer(serializers.ModelSerializer):
	class Meta:
		model = Educacion_tutor
		fields = "__all__"

class Certificacion_tutorSerializer(serializers.ModelSerializer):
	class Meta:
		model = Certificacion_tutor
		fields = "__all__"

class UsuarioSerializer(serializers.ModelSerializer):
	class Meta:
		model = Usuario
		fields = ('id_persona','correo','rol','id_usuario')

	id_persona = PersonaSerializer()
	rol = serializers.SerializerMethodField('get_rol')

	def get_rol(self,obj):
		return obj.id_rol.nombre

class PerfilTutorSerializer(serializers.ModelSerializer):
    class Meta: 
    	model = Tutor
    	fields = ('id_usuario','id_tutor','sintesis_cv')
    id_usuario = UsuarioSerializer()


class MateriasTutorSerializer(serializers.ModelSerializer):
	class Meta:
		model = Tutor
		fields = ('id_tutor','id_usuario','id_materias_afines') 

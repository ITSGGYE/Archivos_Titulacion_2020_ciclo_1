from rest_framework import serializers
from seguridad.models import *

class PaisSerializers(serializers.ModelSerializer):
    id_pais = serializers.IntegerField(read_only=True)
    class Meta:
        model = Pais
        fields = ('id_pais','nombre')


class CiudadSerializers(serializers.ModelSerializer):
    id_ciudad = serializers.IntegerField(read_only=True)
    class Meta:
        model = Ciudad
        fields = ('id_ciudad','nombre')


class RolesSerializers(serializers.ModelSerializer):
    class Meta: 
        model = Rol
        fields = '__all__'

class UsuariosSerializer(serializers.ModelSerializer):
    class Meta:
        model = Usuario
        fields = ('id_usuario','correo','clave','identificacion','rol','nombres','apellidos')

    nombres = serializers.SerializerMethodField('get_nombres')
    apellidos = serializers.SerializerMethodField('get_apellidos')
    identificacion = serializers.SerializerMethodField('get_identificacion')
    rol = serializers.SerializerMethodField('get_rol')

    def get_rol(self, obj):
        return obj.id_rol.nombre

    def get_identificacion(self, obj):
        return obj.id_persona.identificacion

    def get_nombres(self,obj):
        return obj.id_persona.nombres

    def get_apellidos(self,obj):
        return obj.id_persona.apellidos
    
class UsuarioDataSerializer(serializers.ModelSerializer):
	class Meta:
		model = Usuario
		fields = '__all__'


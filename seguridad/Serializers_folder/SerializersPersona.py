from rest_framework import serializers
from seguridad.models import *




class PersonaSerializers(serializers.ModelSerializer):
	class Meta:
	    model = Persona
	    fields = ('id_persona','nombres','apellidos','foto','identificacion')

	id_persona = serializers.IntegerField(read_only=True)


	def create(self, validated_data):
	    pais_instance = Pais.objects.get(nombre=validated_data.pop('pais').get('nombre'))
	    ciudad_instance = Ciudad.objects.get(nombre=validated_data.pop('ciudad').get('nombre'))
	    #Traer toda la data de la instancia es con: **validated_data si solo quieres una se usa validated_data('campo')
	    instance = Persona.objects.create(nombres=validated_data.pop('nombres'),apellidos=validated_data.pop('apellidos'),identificacion=validated_data.pop('identificacion'),genero=validated_data.pop('genero'),fecha_nacimiento=validated_data.pop('fecha_nacimiento'),pais=pais_instance,ciudad=ciudad_instance)	    
	    return instance

class PersonaLocationSerializer(serializers.ModelSerializer):
    class Meta:
        model = Persona
        fields = ('id_persona','latitud','longitud')


class PersonaFotoSerializer(serializers.ModelSerializer):
    class Meta:
        model = Persona
        fields = ('foto',)



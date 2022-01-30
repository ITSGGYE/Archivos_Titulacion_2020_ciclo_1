from rest_framework import viewsets
from .models import *
from .Serializers import *
import hashlib
from django.db.models import Q
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from estudiante.models import Estudiante
from tutor.models import *
from estudiante.models import *

class PaisApi(viewsets.ModelViewSet):
    serializer_class = PaisSerializers
    queryset = Pais.objects.all()

class CiudadApi(viewsets.ModelViewSet):
    serializer_class = CiudadSerializers
    queryset = Ciudad.objects.all()

class RolesApi(viewsets.ModelViewSet):
    serializer_class = RolesSerializers
    queryset = Rol.objects.all()


class UsuariosApi(viewsets.ModelViewSet):
    serializer_class = UsuariosSerializer
    queryset = Usuario.objects.all()

    def get_queryset(self):
        correo = self.request.query_params.get('correo')
        clave = self.request.query_params.get('clave')
        if not correo:
            queryset = Usuario.objects.all()
        else:
            queryset = Usuario.objects.filter(Q(correo=correo) | Q(clave=clave))
        return queryset



import json
import urllib.request
from django.core.mail import EmailMessage
from django.conf import settings
from django.template.loader import render_to_string
from django.template.loader import get_template 
from email.mime.text import MIMEText
from smtplib import *
import random
import smtplib
import email.message


class GuardarFotoPerfil(APIView):
    def post(self,request):
        id_persona = request.data.get('id_persona')
        foto = request.data.get('foto')
        persona = None
        print(id_persona)
        print(foto)
        if foto:
            persona = Persona.objects.get(id_persona = id_persona)
            persona.foto = foto
            persona.save()
            serializer = {'foto':persona.foto.name}
            print(persona.foto.name)
            return Response(serializer,status= status.HTTP_200_OK)
        return Response({'no_content':'no_content'},status= status.HTTP_202_ACCEPTED)



class Correos_electronicos(APIView):

    def post(self,request):
        tipo = request.data.get('tipo')
        content = ''
        template = None
        alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
        code = None
        
        try:
            if tipo == 'codigo_verificacion':
                client = SMTP_SSL(settings.EMAIL_HOST,int(465))
                client.login(str(settings.EMAIL_HOST_USER),str(settings.EMAIL_HOST_PASSWORD))
                code = ''.join(random.choice(alphabet) for i in range(6))
                correo = request.data.get('correo')
                nombre = request.data.get('nombres')
                template = get_template('plantillas_correos/codigo_verificacion.html')
                content = template.render({'code':code,'nombre':nombre})
                mine_message = MIMEText(content,"html",_charset='utf-8')
                mine_message['Subject'] = 'Codigo Verificación'
                mine_message['From'] = 'Human Mind Set'
                mine_message['To'] = 'Crear cuenta'
                client.sendmail(settings.EMAIL_HOST_USER,correo,mine_message.as_string())
                return Response({'codigo':code},status=status.HTTP_200_OK)

            if tipo == 'notificacion_seleccion_tutor':
                client = SMTP_SSL(settings.EMAIL_HOST,int(465))
                client.login(str(settings.EMAIL_HOST_USER),str(settings.EMAIL_HOST_PASSWORD))
                tutor_instance = Usuario.objects.get(usuario_tutor=Tutor.objects.get(id_tutor=request.data.get('id_tutor')))
                usuario = Usuario.objects.get(id_usuario=request.data.get('id_usuario'))
                estudiante_instance = Estudiante.objects.get(id_usuario=usuario)
                template = get_template("plantillas_correos/notificacion_seleccion_tutor.html")
                content = template.render({'usuario':usuario,'tutor':tutor_instance,'estudiante':estudiante_instance})
                mine_message = MIMEText(content,"html",_charset='utf-8')
                client.sendmail(settings.EMAIL_HOST_USER,tutor_instance.correo,mine_message.as_string())
                return Response({'mensaje_enviado':'ok'},status=status.HTTP_200_OK)

            client.quit()
        except SMTPException as e:
            print(e)
            return Response({'error':'error'},status=status.HTTP_204_NO_CONTENT)
        return Response({'correo':correo},status=status.HTTP_204_NO_CONTENT)
        



class UsuariosDataApi(APIView):
    
    def post(self,request):
        contra = request.data.get('clave')
        #print(ident)
       	queryset=None
       	serializacion=None
        try:
            per_instancia = Persona.objects.create(nombres=request.data.get('nombres'),
                                                   apellidos=request.data.get('apellidos'),
                                                   latitud=request.data.get('latitud'),
                                                   longitud=request.data.get('longitud')
                                                   )
            rol_instance = Rol.objects.get(nombre=request.data.get('rol_nombre'))
            h = hashlib.new("sha1")
            contra = str.encode(contra)
            h.update(contra)
            if request.data.get('tipo_sesion') == 'default':
                queryset = Usuario.objects.create(correo=request.data.get('correo'),
                                              clave=h.hexdigest(),
                                              id_persona=per_instancia,
                                              id_rol=rol_instance)
            if request.data.get('tipo_sesion') == 'google':
                queryset = Usuario.objects.create(correo=request.data.get('correo'),
                                                  clave=h.hexdigest(),
                                                  id_persona=per_instancia,
                                                  id_rol=rol_instance)

            
            
            if rol_instance.nombre == 'Estudiante':
                estudiante = Estudiante.objects.create(id_usuario=queryset)
                representante_instance = Representante.objects.create()
                
                estudiante.id_representante = representante_instance
                estudiante.save()
            else:
                tutor = Tutor.objects.create(id_usuario=queryset)
                ValorPorHora.objects.create(id_tutor=tutor,valor='5.00')
                tutor.id_materias_afines.set(request.data.get('materias_afines'))
                Horarios_tutor.objects.create(tutor=tutor,estado=False,dias="Lunes")
                Horarios_tutor.objects.create(tutor=tutor,estado=False,dias="Martes")
                Horarios_tutor.objects.create(tutor=tutor,estado=False,dias="Miercoles")
                Horarios_tutor.objects.create(tutor=tutor,estado=False,dias="Jueves")
                Horarios_tutor.objects.create(tutor=tutor,estado=False,dias="Viernes")
                Horarios_tutor.objects.create(tutor=tutor,estado=False,dias="Sabado")
                Horarios_tutor.objects.create(tutor=tutor,estado=False,dias="Domingo")
            serializacion = UsuariosSerializer(queryset)
            return Response(data=serializacion.data,status=status.HTTP_200_OK)

        except Exception as e:
        	print(e)
        	return Response(data={"error":"Error sistema"},status=status.HTTP_500_INTERNAL_SERVER_ERROR)

class IniciarSesion(APIView):
    def post(self,request):
        tipo_sesion = request.data.get('tipo_sesion')
        ident = request.data.get('correo')
        try:
            if tipo_sesion  == 'default':
                contra = request.data.get('clave')
                h = hashlib.new("sha1")
                contra = str.encode(contra)
                h.update(contra)
                if Usuario.objects.filter(Q(clave= h.hexdigest() ) & Q( correo=ident )).exists():
                    usuario = Usuario.objects.get(clave=h.hexdigest(),correo=ident)
                    data_serializer = UsuariosSerializer(usuario)
                    return Response(data=data_serializer.data,status=status.HTTP_200_OK)             
                else:
                    return Response(data={"usuario_exists":"Error"},status=status.HTTP_200_OK)
            else:
                pass
                #if Usuario.objects.filter(Q(correo=ident)).exists():

        except Exception as e:
            print(e)
            return Response(data={"error":"Error sistema"},status=status.HTTP_500_INTERNAL_SERVER_ERROR)




class PersonaApi(viewsets.ModelViewSet):
    serializer_class = PersonaSerializers

    def get_queryset(self):
    	ident = self.request.query_params.get('identificacion')
    	if not ident:
    		queryset = Persona.objects.all()
    	else:
    		queryset = Persona.objects.filter(Q(identificacion=ident))
    	return queryset

class PersonaApiLocation(APIView):
    def get(self,request):
        id_usuario = request.query_params.get('id')
        persona = Persona.objects.get(persona_usuario__id_usuario=id_usuario)
        serializer = PersonaLocationSerializer(persona,many=False)
        return Response(data=serializer.data,status=status.HTTP_200_OK)

    def put(self,request):
        id_persona = request.data.get('id_persona')
        persona = Persona.objects.get(id_persona=id_persona)
        ubicacion = request.data.get('ubicacion')
        persona.latitud = ubicacion[0]
        persona.longitud = ubicacion[1]
        persona.save()
        serializer = PersonaLocationSerializer(persona,many=False)
        return Response(data=serializer.data,status=status.HTTP_200_OK)

class GoogleSesion(APIView):

	def get(self,request):
		correo = request.query_params.get('correo')
		if Usuario.objects.filter(correo=correo).exists():
			usuario = Usuario.objects.get(correo=correo)
			data_serializer = UsuariosSerializer(usuario)
			return Response(data=data_serializer.data,status=status.HTTP_226_IM_USED)  
		else:
			return Response(data={"No content":"No content"},status=status.HTTP_204_NO_CONTENT)

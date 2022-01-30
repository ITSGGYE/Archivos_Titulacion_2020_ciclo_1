
from rest_framework import viewsets
from .models import *
from .serializers import *
import hashlib
from django.db.models import Q
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from seguridad.models import *
import stripe

class RealizarPAgo(APIView):
	def post(self,request):
		dominio = "http://localhost:8080/Inicio_tutor"
		stripe.api_key = 'sk_test_51HuLBVK5dxREg61m9jd9ZchH0BwAChUOQ1OtiipiTt5L52kmMKdleWWRADfYIY1CuLI2pVXM0Q1wRWKFncH9kcgc00Jd236ETQ'
		try:
			checkout_session = stripe.checkout.Session.create(
				payment_method_types=['card'],
					line_items=[
					{
					'price_data': {
                        'currency': 'usd',
                        'unit_amount': 2000,
                        'product_data': {
                            'name': 'Stubborn Attachments',
                            'images': ['https://i.imgur.com/EHyR2nP.png'],
                        },
                    },
                    'quantity': 1,
                    },
                 ],
                 mode='payment',
                 success_url=dominio,
                 cancel_url=dominio,
                )

			return Response({'id': checkout_session.id},status=status.HTTP_200_OK)
		except Exception as e:
			print(e);
			return Response(data={'error':'error'},status= status.HTTP_403_FORBIDDEN )

class PerfilTutorApi(viewsets.ModelViewSet):
    serializer_class = PerfilTutorSerializer
    queryset = Tutor.objects.filter()

    def get_queryset(self):
        id_tutor = self.request.query_params.get('id')
        queryset = Tutor.objects.filter(id_usuario=id_tutor)
        return queryset

class MateriasApi(viewsets.ModelViewSet):
    serializer_class = MateriasSerializer
    queryset = MateriasAfines.objects.filter()


        
class Educacion_tutorApi(APIView):
	def get(self,request):
		if not request.query_params.get('id_experiencia_tutor'):
			tutor = Tutor.objects.get(id_usuario=request.query_params.get('id'))
			lista = Educacion_tutor.objects.filter(id_tutor=tutor.id_tutor)
			serializer = EducacionTutorSerializer(lista,many=True)
			return Response(data=serializer.data, status=status.HTTP_200_OK)
		else:
			experiencia = Educacion_tutor.objects.get(id_experiencia_tutor=request.query_params.get('id_experiencia_tutor'))
			serializer = EducacionTutorSerializer(experiencia,many=False)
			return Response(data=serializer.data, status=status.HTTP_200_OK)

	def post(self,request):
		serializer = EducacionTutorSerializer(data=request.data)
		try:
			if serializer.is_valid():
				serializer.save()
				return Response(data=serializer.data,status=status.HTTP_200_OK)
			else:
				return Response(data=serializer.errors, status=status.HTTP_400_BAD_REQUEST)
		except Exception as e:
			print(e)
			return Response({"error":"error"}, status=status.HTTP_400_BAD_REQUEST)

	def put(self, request):        
		instance = Educacion_tutor.objects.get(id_experiencia_tutor = request.data['id_experiencia_tutor'])
		serializer = EducacionTutorSerializer(instance,data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request):
		experiencia = Educacion_tutor.objects.get(id_experiencia_tutor = request.query_params.get('id'))
		experiencia.delete()
		return Response(data={"elemento eliminado":"Eliminado completo"}, status=status.HTTP_202_ACCEPTED)





class Certificacion_tutorApi(APIView):

	def get(self,request):
		if not request.query_params.get('id_certificado_tutor'):
			tutor = Tutor.objects.get(id_usuario=request.query_params.get('id'))
			lista = Certificacion_tutor.objects.filter(id_tutor=tutor.id_tutor)
			serializer = Certificacion_tutorSerializer(lista,many=True)
			return Response(data=serializer.data, status=status.HTTP_200_OK)
		else:
			experiencia = Certificacion_tutor.objects.get(id_certificado_tutor=request.query_params.get('id_certificado_tutor'))
			serializer = Certificacion_tutorSerializer(experiencia,many=False)
			return Response(data=serializer.data, status=status.HTTP_200_OK)

	def post(self,request):
		serializer = Certificacion_tutorSerializer(data=request.data)
		try:
			if serializer.is_valid():
				serializer.save()
				return Response(data=serializer.data,status=status.HTTP_200_OK)
			else:
				return Response(data=serializer.errors, status=status.HTTP_400_BAD_REQUEST)
		except Exception as e:
			print(e)
			return Response({"error":"error"}, status=status.HTTP_400_BAD_REQUEST)

	def put(self, request):        
		instance = Certificacion_tutor.objects.get(id_certificado_tutor = request.data['id_certificado_tutor'])
		serializer = Certificacion_tutorSerializer(instance,data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request):
		experiencia = Certificacion_tutor.objects.get(id_certificado_tutor = request.query_params.get('id'))
		experiencia.delete()
		return Response(data={"elemento eliminado":"Eliminado completo"}, status=status.HTTP_202_ACCEPTED) 






class ExperienciaApi(APIView):

	def get(self,request):
		if not request.query_params.get('id_experiencia'):
			tutor = Tutor.objects.get(id_usuario=request.query_params.get('id'))
			lista = Experiencia_tutor.objects.filter(id_tutor=tutor.id_tutor)
			serializer = ExperienciaTutorSerializer(lista,many=True)
			return Response(data=serializer.data, status=status.HTTP_200_OK)
		else:
			experiencia = Experiencia_tutor.objects.get(id_experiencia=request.query_params.get('id_experiencia'))
			serializer = ExperienciaTutorSerializer(experiencia,many=False)
			return Response(data=serializer.data, status=status.HTTP_200_OK)
		
	def post(self,request):
		serializer = ExperienciaTutorSerializer(data=request.data)
		try:
			if serializer.is_valid():
				serializer.save()
				return Response(data=serializer.data,status=status.HTTP_200_OK)
			else:
				print("no valido")
				return Response(data=serializer.errors, status=status.HTTP_400_BAD_REQUEST)
		except Exception as e:
			print(e)
			return Response({"error":"error"}, status=status.HTTP_400_BAD_REQUEST)


	def put(self, request):        
		experiencia = Experiencia_tutor.objects.get(id_experiencia = request.data['id_experiencia'])
		serializer = ExperienciaTutorSerializer(experiencia,data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request):
		experiencia = Experiencia_tutor.objects.get(id_experiencia = request.query_params.get('id'))
		experiencia.delete()
		return Response(data={"elemento eliminado":"Eliminado completo"}, status=status.HTTP_202_ACCEPTED)


class GuardarInformacionTutor(APIView):
	def post(self,request):
		id_tutor = request.data.get("id_tutor")
		id_usuario = request.data.get("id_usuario")
		id_persona = request.data.get("id_persona")
		try:
			tutor_instancia = Tutor.objects.get(id_tutor=id_tutor) 
			tutor_instancia.sintesis_cv = request.data.get("sintesis_cv")
			tutor_instancia.save()
			persona = Persona.objects.get(id_persona=id_persona)
			persona.nombres = request.data.get("nombres")
			persona.apellidos = request.data.get("apellidos")
			persona.identificacion = request.data.get("identificacion")
			#persona.foto = request.data.get("nueva_foto")
			persona.genero = request.data.get("genero")
			#validar ciudad y pais
			if Ciudad.objects.filter(nombre=request.data.get("ciudad")).exists():
				persona.ciudad = Ciudad.objects.get(nombre=request.data.get("ciudad"))
			if Pais.objects.filter(nombre=request.data.get("pais")).exists():
				persona.pais = Pais.objects.get(nombre=request.data.get("pais"))
			persona.fecha_nacimiento = request.data.get("fecha_nacimiento")
			persona.save()			
			
			usuario = Usuario.objects.get(id_usuario=id_usuario)
			usuario.correo = request.data.get("correo") 
			usuario.save()

			return Response(data={"Usuario_edited":"ok"},status=status.HTTP_200_OK)
		except Exception as e:
			print(e)
			return Response(data={"error":"error"},status=status.HTTP_200_OK)
		
		
class ValorPorHoraApi(APIView):

	def get(self,request):
		if not request.query_params.get('idValorPorHora'):
			tutor = Tutor.objects.get(id_usuario=request.query_params.get('id'))
			lista = ValorPorHora.objects.filter(id_tutor=tutor.id_tutor)
			serializer = ValorPorHoraSerializer(lista,many=True)
			return Response(data=serializer.data, status=status.HTTP_200_OK)
		else:
			experiencia = ValorPorHora.objects.get(idValorPorHora=request.query_params.get('idValorPorHora'))
			serializer = ValorPorHoraSerializer(experiencia,many=False)
			return Response(data=serializer.data, status=status.HTTP_200_OK)

	def post(self,request):
		
		serializer = ValorPorHoraSerializer(data=request.data)
		try:
			if serializer.is_valid():
				serializer.save()
				return Response(data=serializer.data,status=status.HTTP_200_OK)
			else:
				return Response(data=serializer.errors, status=status.HTTP_400_BAD_REQUEST)
		except Exception as e:
			print(e)
			return Response({"error":"error"}, status=status.HTTP_400_BAD_REQUEST)

	def put(self, request):        
		instance = ValorPorHora.objects.get(idValorPorHora = request.data['idValorPorHora'])
		serializer = ValorPorHoraSerializer(instance,data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request):
		experiencia = ValorPorHora.objects.get(idValorPorHora = request.query_params.get('id'))
		experiencia.delete()
		return Response(data={"elemento eliminado":"Eliminado completo"}, status=status.HTTP_202_ACCEPTED) 

class MateriasTutorApi(APIView):

	def get(self,request):
		tutor = Tutor.objects.get(id_usuario=request.query_params.get('id'))
		serializer = MateriasTutorSerializer(tutor,many=False)
		return Response(data=serializer.data, status=status.HTTP_200_OK)


	def put(self,request):
		instance = Tutor.objects.get(id_tutor =request.data["id_tutor"])
		serializer= MateriasTutorSerializer(instance,data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
		return Response(serializers.errors,status=status.HTTP_400_BAD_REQUEST)

class HorariosTutorApi(APIView):

	def get(self,request):
		tutor = Tutor.objects.get(id_usuario=request.query_params.get('id'))
		serializer = HorariosSerializers(tutor.generar_horarios(),many=True)
		return Response(data=serializer.data, status=status.HTTP_200_OK)


	def put(self,request):
		instance = Horarios_tutor.objects.get(id_horario=request.data["id_horario"])
		serializer= HorariosSerializers(instance,data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
		return Response(serializers.errors,status=status.HTTP_400_BAD_REQUEST)



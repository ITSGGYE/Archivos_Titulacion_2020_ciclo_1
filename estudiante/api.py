from rest_framework import viewsets
from .models import *
from .serializer import *
import hashlib
from django.db.models import Q
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from seguridad.models import *
from tutor.models import *
import datetime
from decimal import Decimal


class RepresentanteApi(viewsets.ModelViewSet):
    serializer_class = RepresentanteSerializer
    queryset = Representante.objects.filter()

class MateriasEApi(viewsets.ModelViewSet):
    serializer_class = MateriasESerializer
    queryset = MateriasAfines.objects.filter()

class EstudianteApi(viewsets.ModelViewSet):
    serializer_class = EstudianteSerializer
    queryset = Estudiante.objects.filter()

    def get_queryset(self):
        id_estudiante = self.request.query_params.get('id')
        queryset = Estudiante.objects.filter(id_usuario=id_estudiante)
        return queryset

class Trx_log(APIView):
    def get(self,request):
        if request.query_params.get('id_tutor'):
            lista  = transacciones_log.objects.filter(id_tutor=request.query_params.get('id_tutor'))
            serializer = transacciones_logSerializer(lista,many=True)
            return Response(data=serializer.data,status=status.HTTP_200_OK)
        else:
            lista  = transacciones_log.objects.all()
            serializer = transacciones_logSerializer(lista,many=True)
            return Response(data=serializer.data,status=status.HTTP_200_OK)
    def post(self, request):
        serializer = transacciones_Serializer(data=request.data)
        try:
            if serializer.is_valid():
                serializer.save()
                return Response(data=serializer.data, status=status.HTTP_200_OK)
            else:
                return Response(data=serializer.errors, status=status.HTTP_400_BAD_REQUEST)
        except Exception as e:
            print(e)
            return Response({"error": "error"}, status=status.HTTP_400_BAD_REQUEST)



class EvaluacionEstudianteApi(APIView):
    
    def get(self,request):
        estudiante = None
        if not request.query_params.get('id_usuario') and request.query_params.get('ident'):
            evaluacion = EvaluacionEstudiante.objects.all()
            serializer = EvaluacionEstudianteSerializer(evaluacion,many=True) 
            return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
        else:
            estudiante = Estudiante.objects.get(id_usuario=int(request.query_params.get('id_usuario')))

        if EvaluacionEstudiante.objects.filter(id_estudiante=estudiante.id_estudiante).exists():
            print(request.query_params.get('ident'))
            evaluacion = EvaluacionEstudiante.objects.get(id_estudiante=estudiante.id_estudiante,id_tutor__id_usuario__id_persona__identificacion=request.query_params.get('ident'))
            serializer = EvaluacionEstudianteSerializer(evaluacion,many=False)
            return Response(data=serializer.data,status=status.HTTP_200_OK)
        else:
            return Response(data={'no_content':'no_content'},status=status.HTTP_204_NO_CONTENT)

    def post(self,request):
        estudiante = Estudiante.objects.get(id_usuario=request.data.get('id_estudiante'))
        tutor = Tutor.objects.get(id_tutor=request.data.get('id_tutor'))
        evaluacion = None
        serializer = None
        divisor = 0
        dividendo = 0
        cociente = 0
        try:
            if EvaluacionEstudiante.objects.filter(Q(id_estudiante=estudiante.id_estudiante) & Q(id_tutor=tutor.id_tutor)).exists():
                evaluacion = EvaluacionEstudiante.objects.get(Q(id_estudiante=estudiante.id_estudiante) & Q(id_tutor=tutor.id_tutor) & Q(id_tutor__id_usuario__id_persona__identificacion=request.data.get('ident')))
                evaluacion.pregunta_1 = request.data.get('pregunta_1')
                evaluacion.pregunta_2 = request.data.get('pregunta_2')
                evaluacion.pregunta_3 = request.data.get('pregunta_3')
                evaluacion.pregunta_4 = request.data.get('pregunta_4')
                evaluacion.pregunta_5 = request.data.get('pregunta_5')
                evaluacion.comentario = request.data.get('comentario')
                evaluacion.comentario_negativo = request.data.get('comentario_negativo')
                evaluacion.total = request.data.get('total')
                evaluacion.save()
            else:
                evaluacion = EvaluacionEstudiante.objects.create(
                                                         id_estudiante=estudiante,
                                                         id_tutor=tutor,
                                                         pregunta_1=request.data.get('pregunta_1'),
                                                         pregunta_2=request.data.get('pregunta_2'),
                                                         pregunta_3=request.data.get('pregunta_3'),
                                                         pregunta_4=request.data.get('pregunta_4'),
                                                         pregunta_5=request.data.get('pregunta_5'),
                                                         total=request.data.get('total')
                                                         )

            #Aqui realizamos el calculo de la calificacion de este tutor 
            evaluacion = EvaluacionEstudiante.objects.filter(id_tutor=tutor.id_tutor)
            divisor = evaluacion.count()
            for e in evaluacion:
                dividendo += e.total
            cociente = dividendo / divisor
            tutor.calificacion = cociente
            tutor.save()
            
            serializer = EvaluacionEstudianteSerializer(evaluacion,many=False)
            return Response(data=serializer.data,status=status.HTTP_200_OK)
        except Exception as e:
            print(e)
            return Response(data={"error":"Error sistema"},status=status.HTTP_500_INTERNAL_SERVER_ERROR)



class NivelesApi(APIView):

    def get(self, request):
        if not request.query_params.get('id_niveles_academicos'):
            estudiante = Estudiante.objects.get(id_usuario=request.query_params.get('id'))
            lista = Nivel_Academico.objects.filter(id_estudiante=estudiante.id_estudiante)
            serializer = NivelesSerializer(lista, many=True)
            return Response(data=serializer.data, status=status.HTTP_200_OK)
        else:
            nivel = Nivel_Academico.objects.get(id_niveles_academicos=request.query_params.get('id_niveles_academicos'))
            serializer = NivelesSerializer(nivel, many=False)
            return Response(data=serializer.data, status=status.HTTP_200_OK)

    def post(self, request):
        serializer = NivelesSerializer(data=request.data)
        try:
            if serializer.is_valid():
                serializer.save()
                return Response(data=serializer.data, status=status.HTTP_200_OK)
            else:
                return Response(data=serializer.errors, status=status.HTTP_400_BAD_REQUEST)
        except Exception as e:
            print(e)
            return Response({"error": "error"}, status=status.HTTP_400_BAD_REQUEST)

    def put(self, request):
        nivel = Nivel_Academico.objects.get(id_niveles_academicos=request.data['id_niveles_academicos'])
        serializer = NivelesSerializer(nivel, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(data=serializer.data, status=status.HTTP_202_ACCEPTED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

    def delete(self, request):
        nivel = Nivel_Academico.objects.get(id_niveles_academicos=request.query_params.get('id'))
        nivel.delete()
        return Response(data={"elemento eliminado": "Eliminado completo"}, status=status.HTTP_202_ACCEPTED)
import datetime



class GuardarInformacionEstudiante(APIView):
    def post(self, request):
        id_estudiante = request.data.get("id_estudiante")
        id_usuario = request.data.get("id_usuario")
        id_persona = request.data.get("id_persona")
        representante = request.data.get("id_representante")
        ubicacion = request.data.get("ubicacion")
       # print(ubicacion)
        fecha = request.data.get("fecha_nacimiento")
        fecha = datetime.datetime.strptime(fecha,"%Y-%m-%d").strftime("%Y-%m-%d")
        fechar = request.data.get('fecha_nacimientor')
        fechar = datetime.datetime.strptime(fecha,"%Y-%m-%d").strftime("%Y-%m-%d")
       # print(id_estudiante)
       # print(id_usuario)
       # print(id_persona)
       # print(representante)
       # print(request.data.get('tutoria_online'))
       # print(request.data.get('tutoria_prescencial'))
        try:
            estudiante_instancia = Estudiante.objects.get(id_estudiante=int(id_estudiante))
            estudiante_instancia.tutoria_online = request.data.get('tutoria_online')
            estudiante_instancia.tutoria_prescencial = request.data.get('tutoria_prescencial')
            estudiante_instancia.save()


            #GUARDAMOS LA INFORMACION DEL ESTUDIANTE COMO USUARIO
            usuario = Usuario.objects.get(id_usuario=int(id_usuario))
            usuario.correo = request.data.get("correo")
            #print(usuario.clave)
            usuario.save()

            persona = Persona.objects.get(id_persona=int(id_persona))
            # GUARDARMOS LA INFORMACION DEL ESTUDIANTE
            persona.nombres = request.data.get("nombres")
            persona.apellidos = request.data.get("apellidos")
            persona.identificacion = request.data.get("identificacion")
            persona.genero = request.data.get("genero")
            persona.latitud = ubicacion[0]
            persona.longitud = ubicacion[1]
            persona.ciudad = Ciudad.objects.get(nombre=request.data.get("ciudad"))
            persona.pais = Pais.objects.get(nombre=request.data.get("pais"))
            persona.fecha_nacimiento = fecha
            persona.save()
            #GUARDAMOS LA INFORMACION DEL REPRESENTANTE
            representante_instance = Representante.objects.get(id_representante=int(representante))
            representante_instance.nombresr=request.data.get('nombresr')
            representante_instance.apellidosr=request.data.get('apellidosr')
            representante_instance.identificacionr=request.data.get('identificacionr')
            representante_instance.correor=request.data.get('correor')
            representante_instance.fecha_nacimientor=fechar
            representante_instance.generor=request.data.get('generor')
            representante_instance.save()
            if request.data.get('ciudadr') != 'No definido':
                representante_instance.ciudadr = Ciudad.objects.get(nombre=request.data.get('ciudadr'))
                representante_instance.save()
            if request.data.get('paisr') != 'No definido':
                representante_instance.paisr = Pais.objects.get(nombre=request.data.get('paisr'))
                representante_instance.save()

            return Response(data={"Usuario_edited": "ok"}, status=status.HTTP_200_OK)
        except Exception as e:
            print(e)
            return Response(data={"error": "error"}, status=status.HTTP_400_BAD_REQUEST)


class MateriasEstudianteApi(APIView):

    def get(self,request):
        estudiante = Estudiante.objects.get(id_usuario=request.query_params.get('id'))
        serializer = MateriasEstudianteSerializer(estudiante,many=False)
        return Response(data=serializer.data, status=status.HTTP_200_OK)

    def put(self,request):
        instance = Estudiante.objects.get(id_estudiante =request.data["id_estudiante"])
        serializer= MateriasEstudianteSerializer(instance,data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
        return Response(serializers.errors,status=status.HTTP_400_BAD_REQUEST)

class RepresentanteEstudianteApi(APIView):
    def get(self,request):
        estudiante = Estudiante.objects.get(id_usuario=request.query_params.get('id'))
        serializer = RepresentanteEstudianteSerializer(estudiante,many=True)
        return Response(data=serializer.data, status=status.HTTP_200_OK)

    def put(self,request):
        instance = Estudiante.objects.get(id_estudiante =request.data["id_estudiante"])
        serializer= RepresentanteEstudianteSerializer(instance,data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(data=serializer.data,status=status.HTTP_202_ACCEPTED)
        return Response(serializers.errors,status=status.HTTP_400_BAD_REQUEST)


class Buscar(APIView):

    def post(self,request):
        informacion = request.data
        lista_dias_seleccionados = request.data["dias_list"]#LUNES,MARTES
        lista_materias = request.data["materias_buscar"]
        hora_inicio = informacion["hora_inicio"]
        hora_fin = informacion["hora_fin"]

        #print(lista_materias)
        #Si no definio una hora de inicio o fin va a filtrar usando las listas de los dias y materias afines
        if hora_inicio == '' or hora_fin == '':
            tutores = Tutor.objects.filter(
                                              Q(tutor_horarios__dias__in=[x for x in lista_dias_seleccionados],tutor_horarios__estado=True) 
                                            | Q(id_materias_afines__in=[x for x in lista_materias])
                                          ).distinct()[:10]
            serializers = TutorBuscarSerializer(tutores,many=True)
            return Response(data=serializers.data, status=status.HTTP_200_OK)
        #Caso contrario filtrara tambien por hora de inicio y fin
        else:
            tutores = Tutor.objects.filter(Q(tutor_horarios__dias__in=[x for x in lista_dias_seleccionados],tutor_horarios__estado=True) | Q(id_materias_afines__in=[x for x in lista_materias]) | Q(tutor_horarios__hora_inicio=hora_inicio) | Q(tutor_horarios__hora_fin=hora_fin)).distinct()[:10]
            serializers= TutorBuscarSerializer(tutores,many=True)
            return Response(data=serializers.data,status=status.HTTP_200_OK)
        #print(tutores)
        return Response({"ok":"ok"},status=status.HTTP_202_ACCEPTED)

class AsignarTutor(APIView):
    
    def get(self,request):
        usuario = None
        if not request.query_params.get("id_usuario_tutor"):
            usuario =  Estudiante.objects.get(id_usuario=request.query_params.get("id_usuario"))
            lista_tutores = TutorAsignado.objects.filter(id_estudiante=usuario.id_estudiante)
            serializer = AsignarTutorSerializer(lista_tutores,many=True)
            return Response(data=serializer.data,status=status.HTTP_200_OK)
        else:
            usuario = Tutor.objects.get(id_usuario=request.query_params.get("id_usuario_tutor"))
            lista_estudiantes = TutorAsignado.objects.filter(id_tutor=usuario)
            serializer = EstudiantesAsignadosSerializer(lista_estudiantes,many=True)
            return Response(data=serializer.data,status=status.HTTP_200_OK)

    def post(self,request):
        id_tutor = request.data.get('id_tutor')
        id_estudiante = request.data.get('id_estudiante')
        if id_tutor and id_estudiante:
            if TutorAsignado.objects.filter(id_tutor=id_tutor).exists():
                return Response({'tutor_ya_seleccionado':'tutor_ya_seleccionado'},status=status.HTTP_208_ALREADY_REPORTED)
            else:
                asig = TutorAsignado.objects.create(id_tutor=Tutor.objects.get(id_tutor=id_tutor),id_estudiante=Estudiante.objects.get(id_estudiante=id_estudiante),fecha_contacto=datetime.date.today())
                return Response({'asignacion':'ok'},status=status.HTTP_200_OK)
        return Response({"ok":"ok"},status.status.HTTP_202_ACCEPTED)
    
    def delete(self,request):
        total = 0
        id_tutor = request.query_params.get('id_tutor')
        tutor = Tutor.objects.get(id_tutor=id_tutor)
        
        asignacion = TutorAsignado.objects.get(id_tutor = id_tutor)
        evaluacion = EvaluacionEstudiante.objects.get(id_tutor = id_tutor)
        for e in evaluacion:
            total += e.total
        tutor.calificacion = tutor.calificacion - total
        asignacion.delete()
        evaluacion.delete()

        return Response(data={"ok":"ok"},status=status.HTTP_200_OK)


def fecha_procesa(tipo,date):
    value = ''
    if tipo == 'Dia':
        value = date.strftime("%A")
        if value == 'Monday':
            value = 'Lunes'
        if value == 'Thuesday':
            value = 'Martes'
        if value == 'Wednesday':
            value = 'Miercoles'
        if value == 'Thursday':
            value = 'Jueves'
        if value == 'Friday':
            value = 'Viernes'
        if value == 'Saturday':
            value = 'Sabado'
        if value == 'Sunday':
            value = 'Domingo'
    elif tipo == 'Hora':
        value = now.strftime("%H:%M:%S")
    return value



class Seguimiento(APIView):
    def post(self,request):
        try:
            fecha_actual = datetime.datetime.now()
            dia = fecha_procesa('Dia',fecha_actual)
            hora = fecha_procesa('Hora',fecha_actual)
            horario_tutor = Horarios_tutor.objects.filter(
                                                        Q(id_tutor=request.data["id_tutor"])
                                                        &Q(hora_inicio__lte=hora)
                                                        &Q(hora_fin__gt=hora)
                                                        &~Q(hora_inicio='00:00:00')
                                                        &~Q(hora_fin='00:00:00')
                                                        &Q(dias=dia)
                                                      )[0]
            if horario_tutor.exists():
                data = SeguimientoClases.objects.create(
                                                        id_tutor = request.data["id_tutor"],
                                                        id_estudiante = request.data["id_estudiante"],
                                                        dias=dia,
                                                        hora_inicio=hora
                                                       )
                serial = SegSerializer(data,many=False)
                return Response(data=serial.data,status=status.HTTP_200_OK) 

        except Exception as e:
            print("ERROR ====> "+e)
            return Response({"mensaje":"Estamos experimentando problemas tecnicos. Por favor, intentelo mas tarde"},status.status.HTTP_500_INTERNAL_SERVER_ERROR)

from django.db import models
from django.utils.timezone import *
from seguridad.models import *
from tutor.models import *

class Representante(models.Model):
    GENERO_CHOICES = [('M','Masculino'),('F','Femenino')]
    id_representante = models.AutoField(primary_key=True)
    nombresr= models.CharField(blank=True, null=True, max_length=50,default='No definido')
    apellidosr = models.CharField(blank=True, null=True,max_length=50,default='No definido')
    identificacionr = models.CharField(max_length=50, blank=True, null=True, default='No definido', )
    correor = models.EmailField(max_length=100, blank=True, null=True)
    fecha_nacimientor = models.DateField(max_length=50,blank=True,null=True)
    generor = models.CharField(max_length=50, blank=True, null=True,choices=GENERO_CHOICES)
    paisr = models.ForeignKey(Pais, on_delete=models.CASCADE, blank=True, null=True)
    ciudadr = models.ForeignKey(Ciudad, on_delete=models.CASCADE, blank=True, null=True)

    

class Estudiante(models.Model):
    id_estudiante = models.AutoField(primary_key=True)
    id_usuario = models.ForeignKey(Usuario,related_name='usuario_estudiante',on_delete=models.CASCADE,null=True,blank=True)
    id_representante = models.ForeignKey(Representante, on_delete=models.CASCADE, blank=True, null=True)
    id_materias_afines = models.ManyToManyField(MateriasAfines,  db_table="hms_ematerias_det",null=True,blank=True)
    tutoria_online = models.BooleanField(default=True,blank=True,null=True)
    tutoria_prescencial = models.BooleanField(default=True,blank=True,null=True)


    class Meta: 
        verbose_name = 'estudiante',
        verbose_name_plural = 'estudiante',
        db_table = 'hms_estudiante'


class EvaluacionEstudiante(models.Model):
    id_evaluacion = models.AutoField(primary_key=True)
    id_estudiante = models.ForeignKey(Estudiante,related_name='estudiante_evaluacion',on_delete=models.CASCADE,null=True,blank=True)
    id_tutor = models.ForeignKey(Tutor,related_name='tutor_evaluacion',on_delete=models.CASCADE,null=True,blank=True)
    pregunta_1 = models.FloatField(default=0,null=True,blank=True)
    pregunta_2 = models.FloatField(default=0,null=True,blank=True)
    pregunta_3 = models.FloatField(default=0,null=True,blank=True)
    pregunta_4 = models.FloatField(default=0,null=True,blank=True)
    pregunta_5 = models.FloatField(default=0,null=True,blank=True)
    total = models.FloatField(default=0,blank=True,null=True)
    comentario = models.TextField(null=True,blank=True,default='No has realizado ningun comentario aun')
    comentario_negativo = models.TextField(null=True,blank=True,default='No has realizado ningun comentario aun')


class TutorAsignado(models.Model):
    id_tutorAsignado = models.AutoField(primary_key=True)
    id_estudiante = models.ForeignKey(Estudiante,related_name="tutor_asignado",null=True,blank=True,on_delete=models.CASCADE)
    id_tutor = models.ForeignKey(Tutor,related_name="tutor_asignado",null=True,blank=True,on_delete=models.CASCADE)
    fecha_contacto = models.DateField(null=True,blank=True)
    estado = models.BooleanField(default=False,null=True,blank=True)


class Nivel_Academico(models.Model):
    NIVELES_CHOICES = [('Educacion Basica', 'Educacion Basica'), ('Escuela Secundaria', 'Escuela Secundaria'), ('Tecnico Avanzado', 'Tecnico Avanzado'),('Tercer Nivel', 'Tercer Nivel'), ('Postgrado', 'Postgrado')]
    id_niveles_academicos= models.AutoField(primary_key=True)
    id_estudiante = models.ForeignKey(Estudiante, on_delete=models.CASCADE,blank= True, null=True,related_name='nivelesEstudiante')
    nombre = models.CharField(max_length=100, blank=True, null=True, choices=NIVELES_CHOICES)

class SeguimientoClases(models.Model):
    id_seg = models.AutoField(primary_key=True)
    id_tutor = models.ForeignKey(Tutor,on_delete=models.CASCADE,related_name="seg_tutor")
    id_estudiante = models.ForeignKey(Estudiante,on_delete=models.CASCADE,related_name="seg_est")
    dias = models.CharField(max_length=50,null=True,blank=True)
    hora_inicio = models.TimeField(blank=True,null=True,default='00:00:00')
    hora_fin = models.TimeField(blank=True,null=True,default='00:00:00')
    procesado = models.BooleanField(default=False)
    estado = models.BooleanField(default=False)

class transacciones_log(models.Model):
    id_trx = models.AutoField(primary_key=True)
    id_tutor = models.ForeignKey(Tutor,on_delete=models.CASCADE,null=False,blank=False,related_name='trxTutor')
    id_estudiante = models.ForeignKey(Estudiante, on_delete=models.CASCADE,blank= True, null=True,related_name='estudianteTrx')
    fechora_trx = models.DateField(max_length=100,default=datetime.now,blank=True, null=True)
    secuencial = models.DateField(max_length=100, blank=True, null=True)
    cod_resultado = models.CharField(max_length=3,default='000', null=True, blank=True)
    valor_pagado = models.CharField(max_length=4,default='0.00', null=False, blank=False)
    comision = models.CharField(max_length=4,default='0.00', null=False, blank=False)
    valor_total = models.CharField(max_length=4,default='0.00', null=False, blank=False)
    mensaje_log = models.CharField(max_length=150,default='Transacción OK', null=True, blank=True)
    procesado = models.BooleanField(default=False,null=True,blank=True)
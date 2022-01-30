from django.db import models
from datetime import date
from seguridad.models import *


# Create your models here.
class Dias_Horario(models.Model):
    id_dia = models.AutoField(primary_key=True) 
    nombre = models.CharField(max_length=30, blank=False, null=False)

    class Meta:
        verbose_name = 'Dias_Semanal',
        verbose_name_plural = 'Dias',
        db_table = 'hms_Dias_Horario'

    def __str__(self):
        return self.nombre

class MateriasAfines(models.Model):
    id_materias_afines=models.AutoField(primary_key=True)
    tipo=models.CharField(max_length=50, blank=False, null=False)
    nombre= models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Materias Afines',
        verbose_name_plural = 'Materias Afines',
        db_table = 'hms_materias_afiness'



class Tutor(models.Model):
    id_tutor = models.AutoField(primary_key=True)
    id_usuario = models.ForeignKey(Usuario,related_name='usuario_tutor',on_delete=models.CASCADE,null=False,blank=False)
    id_materias_afines = models.ManyToManyField(MateriasAfines, db_table="hms_usuario_materias_detalle",null=True,blank=True)
    sintesis_cv = models.TextField(null=True,blank=True,default='No definido')
    currirrulum = models.FileField(upload_to='anexos_tutor/',null=True,blank=True)
    calificacion = models.FloatField(default=0,null=True,blank=True)

    class Meta:
        verbose_name = 'tutor',
        verbose_name_plural = 'tutor',
        db_table = 'hms_tutor'

    def __int__(self):
        return self.id_tutor

    def generar_horarios(self):
        horarios = Horarios_tutor.objects.filter(tutor=self.id_tutor)
        return horarios

    def materias_muestra(self):
        materias = MateriasAfines.objects.filter(tutor=self.id_tutor).values('tipo','nombre')[:2]
        

#class NivelAcademico(models.Model):
#    id_nivel_academico=models.AutoField(primary_key=True)
#    nombre= models.CharField(max_length=50, blank=False, null=False)
#
#    class Meta:
#        verbose_name = 'Nivel Academico',
#        verbose_name_plural = 'Niveles Academicos',
#        db_table = 'hms_nivel_academico'
#
#    def __str__(self):
#        return self.nombre

    
class Horarios_tutor(models.Model):
    id_horario = models.AutoField(primary_key=True)
    tutor = models.ForeignKey(Tutor,on_delete=models.CASCADE,db_column='id_tutor',related_name="tutor_horarios")
    estado = models.BooleanField(max_length=10,blank=False,null=True,default=True)
    dias = models.CharField(max_length=50,null=True,blank=True)
    hora_inicio = models.TimeField(blank=True,null=True,default='00:00:00')
    hora_fin = models.TimeField(blank=True,null=True,default='00:00:00')
    prescencial = models.BooleanField(default=False,null=True,blank=True)
    virtual = models.BooleanField(default=False,null=True,blank=True)

    class Meta:
        db_table = 'Horarios_tutor'
    

 
class Experiencia_tutor(models.Model):
    TIPO_EMPLEO_CHOICES = [('MT','MEDIO TIEMPO'),('TP','TIEMPO COMPLETO')]
    id_experiencia = models.AutoField(primary_key=True)
    id_tutor = models.ForeignKey(Tutor,on_delete=models.CASCADE,null=False,blank=False,related_name='experienciaTutor')
    cargo = models.CharField(max_length=100, blank=True, null=True)
    tipo_empleo = models.CharField(max_length=100, blank=True,choices=TIPO_EMPLEO_CHOICES, null=True)
    empresa = models.CharField(max_length=100, blank=True, null=True)
    ubicacion = models.CharField(max_length=100, blank=True, null=True)
    estado = models.CharField(max_length=50,blank=True,null=True)
    fecha_inicio = models.DateField(max_length=100,blank=True, null=True)
    fecha_fin = models.DateField(max_length=100, blank=True, null=True)
    

class Educacion_tutor(models.Model):
    id_experiencia_tutor = models.AutoField(primary_key=True)
    id_tutor = models.ForeignKey(Tutor,on_delete=models.CASCADE,null=False,blank=False,related_name='educacionTutor')
    universidad = models.CharField(max_length=50, blank=True, null=True)
    titulacion = models.CharField(max_length=50, blank=True, null=True)
    nota  = models.CharField(max_length=50, blank=True, null=True)
    fecha_inicio = models.DateField(max_length=100, blank=True, null=True)
    fecha_fin = models.DateField(max_length=100, blank=True, null=True)
    estado = models.CharField(max_length=50,blank=True,null=True)

class Certificacion_tutor(models.Model):
    id_certificado_tutor = models.AutoField(primary_key=True)
    id_tutor = models.ForeignKey(Tutor,on_delete=models.CASCADE,null=False,blank=False,related_name='certificadoTutor')
    nombre_certificado = models.CharField(max_length=50, blank=True, null=True)
    origen = models.CharField(max_length=50, blank=True, null=True, default='no definido')
    fecha_inicio = models.DateField(max_length=100, blank=True, null=True)
    fecha_fin = models.DateField(max_length=100, blank=True, null=True)

class ValorPorHora(models.Model):
    idValorPorHora = models.AutoField(primary_key=True)
    id_tutor = models.ForeignKey(Tutor,on_delete=models.CASCADE,null=False,blank=False,related_name='valor_tutor')
    valor = models.CharField(max_length=50, blank=True, null=True)


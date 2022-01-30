from django.db import models
from django.utils.timezone import *
"""
class Pais(models.Model):
    id_pais = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Pais',
        verbose_name_plural = 'Paises',
        db_table = 'hms_pais'

    def __str__(self):
        return self.nombre

class Ciudad(models.Model):
    id_ciudad = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Ciudad',
        verbose_name_plural = 'Ciudades',
        db_table = 'hms_ciudad'

    def __str__(self):
        return self.nombre


class Rol(models.Model):
    id_rol = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=45, blank=False, null=False)

    class Meta:
        verbose_name = 'Rol',
        verbose_name_plural = 'Roles',
        db_table = 'hms_rol'

    def __str__(self):
        return self.nombre

class Permiso(models.Model):
    id_permiso = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=45, blank=False, null=False)
    id_rol = models.ForeignKey(Rol, on_delete=models.CASCADE,db_column='id_rol', blank=False, null=False)

    class Meta:
        verbose_name = 'Permiso',
        verbose_name_plural = 'Permisos',
        db_table = 'hms_permiso'

    def __unicode__(self):
        return self.id_rol

class MateriasAfines(models.Model):
    id_materias_afines=models.AutoField(primary_key=True)
    tipo=models.CharField(max_length=50, blank=False, null=False)
    nombre= models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Materias Afines',
        verbose_name_plural = 'Materias Afines',
        db_table = 'hms_materias_afines'

    def __str__(self):
        return self.nombre

class Usuario(models.Model):
    id_usuario = models.AutoField(primary_key=True)
    nombres = models.CharField(max_length=100, blank=False, null=False)
    apellidos = models.CharField(max_length=100, blank=False, null=False)
    correo = models.CharField(max_length=100, blank=False, null=False)
    clave = models.CharField(max_length=100, null=False, blank=False)
    id_materias_afines = models.ManyToManyField(MateriasAfines, db_table="hms_usuario_materias_det")

    class Meta:
        verbose_name = 'Usuario',
        verbose_name_plural = 'Usuario',
        db_table = 'hms_usuario'

    def __str__(self):
        return self.nombres

class NivelAcademico(models.Model):
    id_nivel_academico=models.AutoField(primary_key=True)
    nombre= models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Nivel Academico',
        verbose_name_plural = 'Niveles Academicos',
        db_table = 'hms_nivel_academico'

    def __str__(self):
        return self.nombre


class Dias_Horario(models.Model):
    id_dia = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Dias_Semanal',
        verbose_name_plural = 'Dias',
        db_table = 'hms_Dias'

    def __str__(self):
        return self.nombre


class Persona(models.Model):
    id_persona = models.AutoField(primary_key=True)
    fecha_nacimiento = models.DateField(max_length=50,blank=True, null=True)
    genero = models.CharField(max_length=50, blank=True, null=True)
    pais = models.ForeignKey(Pais, on_delete=models.CASCADE, blank=True, null=True)
    ciudad = models.ForeignKey(Ciudad, on_delete=models.CASCADE, blank=True, null=True)
    represetante = models.CharField(max_length=50, blank=True, null=True)

    ######################### Estudiante #############################
    nivel_academico = models.ForeignKey(NivelAcademico, on_delete=models.CASCADE, blank=True, null=True)
    id_materias_afines = models.ManyToManyField(MateriasAfines,  db_table="hms_materias_afines_det")

    ######################## Tutor ################################
    cargo = models.CharField(max_length=100, blank=True, null=True)
    tipo_empleo = models.CharField(max_length=100, blank=True, null=True)
    empresa = models.CharField(max_length=100, blank=True, null=True)
    ubicacion = models.CharField(max_length=100, blank=True, null=True)
    nota  = models.CharField(max_length=50, blank=True, null=True)
    lugar_trabajo = models.CharField(max_length=50, blank=True, null=True)
    valor = models.CharField(max_length=50, blank=True, null=True)
    nombre_certificado = models.CharField(max_length=50, blank=True, null=True)
    universidad = models.CharField(max_length=50, blank=True, null=True)
    titulacion = models.CharField(max_length=50, blank=True, null=True)
    institucion_emisora = models.CharField(max_length=50, blank=True, null=True)
    dias_curso = models.ForeignKey(Dias_Horario, on_delete=models.CASCADE, db_column='dias', blank=True, null=True)
    Horas_cursos = models.CharField(max_length=10, blank=True, null=True)
    fecha_inicio = models.DateField(max_length=100, blank=True, null=True)
    fecha_fin = models.DateField(max_length=100, blank=True, null=True)
    

    class Meta:
        verbose_name = 'persona',
        verbose_name_plural = 'personas',
        db_table = 'hms_persona'
"""
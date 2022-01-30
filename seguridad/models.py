from django.db import models
from datetime import datetime





# Create your models here.





class Rol(models.Model):
    id_rol = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=45, blank=False, null=False)

    class Meta:
        verbose_name = 'Rol',
        verbose_name_plural = 'Roles',
        db_table = 'hms_roles'

    def __str__(self):
        return self.nombre

    def generar_persmisos(self):
    	permiso = Permiso.objects.filter(id_rol=self.id_rol)
    	return permiso


class Permiso(models.Model):
    id_permiso = models.AutoField(primary_key=True)
    descripcion = models.CharField(max_length=45, blank=False, null=False)
    id_rol = models.ManyToManyField(Rol,db_table='roles_permisos')

    class Meta:
        verbose_name = 'Permiso',
        verbose_name_plural = 'Permisos',
        db_table = 'hms_permisos'

    def __unicode__(self):
        return self.id_rol

class Pais(models.Model):
    id_pais = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Pais',
        verbose_name_plural = 'Paises',
        db_table = 'hms_paises'

    def __str__(self):
        return self.nombre

class Ciudad(models.Model):
    id_ciudad = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=50, blank=False, null=False)

    class Meta:
        verbose_name = 'Ciudad',
        verbose_name_plural = 'Ciudades',
        db_table = 'hms_ciudades'

    def __str__(self):
        return self.nombre

class Persona(models.Model):
    GENERO_CHOICES = [('M','Masculino'),('F','Femenino')]
    id_persona = models.AutoField(primary_key=True)
    nombres = models.CharField(max_length=50,blank=False,null=False)
    apellidos = models.CharField(max_length=50,blank=False,null=False)
    identificacion = models.CharField(max_length=50,blank=True,null=True,default='No definido')
    foto = models.ImageField(upload_to="fotos_perfil/",default='profile_default.jpg')
    genero = models.CharField(max_length=50, blank=True, null=True,choices=GENERO_CHOICES)
    fecha_nacimiento = models.DateField(max_length=50,blank=True, null=True)
    pais = models.ForeignKey(Pais, on_delete=models.CASCADE, blank=True, null=True)
    ciudad = models.ForeignKey(Ciudad, on_delete=models.CASCADE, blank=True, null=True)
    latitud = models.DecimalField(blank=True,null=True,max_digits=9, decimal_places=6)
    longitud = models.DecimalField(blank=True,null=True,max_digits=9, decimal_places=6)
    
    class Meta:
        verbose_name = 'Persona',
        verbose_name_plural = 'Personas',
        db_table = 'hms_personas'
    
    def __str__(self):
        return self.nombres

class Usuario(models.Model):

    id_usuario = models.AutoField(primary_key=True)
    id_persona = models.ForeignKey(Persona,db_column='id_persona',related_name='persona_usuario',on_delete=models.CASCADE)
    correo = models.CharField(max_length=100, blank=False, null=False)
    clave = models.CharField(max_length=600,default='user_login_google', null=True, blank=True)
    id_rol = models.ForeignKey(Rol,on_delete=models.CASCADE)

    class Meta:
        verbose_name = 'Usuario',
        verbose_name_plural = 'Usuario',
        db_table = 'hms_usuarios'

    def __str__(self):
        return self.correo




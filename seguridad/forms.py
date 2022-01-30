from .models import *
from django import forms
from django.forms import ModelForm
from betterforms.multiform import MultiModelForm

class UsuarioForm(forms.ModelForm):
    class Meta:
        model = Usuario
        fields = ['nombres',
                  'apellidos',
                  'correo',
                  'clave',
                  'id_materias_afines'

                  ]

        labels = {
            'nombres': 'Nombres',
            'apellidos': 'Apellidos',
            'correo': 'Email',
            'clave': 'Contraseña',
            'id_materias_afines': 'Materias Afines',

        }
        widgets = {
            'nombres': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text", "placeholder": "Ingrese Sus Nombres"}),
            'apellidos': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text", "placeholder": "Ingrese Sus Apellidos"}),
            'correo': forms.TextInput(attrs={"class": "form-control text-dark", "type": "email", "placeholder": "Ingrese Su Email"}),
            "clave": forms.TextInput(attrs={"class": "form-control", "type": "password", "placeholder": "Ingrese Su Contraseña"})
        }



class RolForm(forms.ModelForm):
    class Meta:
        model = Rol
        fields = [
                 'nombre',
                 ]

        labels = {
                 'nombre': 'Nombre rol',
                 }   

        widgets = {
            'nombre': forms.TextInput(attrs={"class": "form-control text-dark","id": "nombre_rol"}),
        }

class PermisosForm(forms.ModelForm):
    
    class Meta:
        model = Permiso
        fields = [
                 'descripcion',
                 'id_rol',
                 ]

        labels = {
                 'descripcion': 'Descripcion permiso',
                 'id_rol': 'Roles',
                 }   

        widgets = {
            'descripcion': forms.TextInput(attrs={"class": "form-control text-dark","id":"descripcion","name":"descripcion"}),
        }

class PaisForm(forms.ModelForm):
    
    class Meta:
        model = Pais
        fields = [
                 'nombre',
                 ]

        labels = {
                 'nombre': 'Pais',
                 }   

        widgets = {
            'nombre': forms.TextInput(attrs={"class": "form-control text-dark","id":"pais","name":"pais"}),
        }

class CiudadForm(forms.ModelForm):
    
    class Meta:
        model = Ciudad
        fields = [
                 'nombre',
                 ]

        labels = {
                 'nombre':'Ciudad',
                 }   

        widgets = {
            'nombre': forms.TextInput(attrs={"class": "form-control text-dark","id":"ciudad","name":"ciudad"}),
        }
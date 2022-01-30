from .models import *
from django import forms
from django.forms import ModelForm
from betterforms.multiform import MultiModelForm


##########  USUARIO ######
"""
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



#####################################################################################

class CrearNivelesForm(forms.ModelForm):
    class Meta:
        model = Persona
        fields = ['nivel_academico',

                  ]

        labels = {'nivel_academico': '',

        }

        widgets = {
            'nivel_academico': forms.Select(attrs={"class": "form-control text-dark"}),
        }


class CrearInteresesForm(forms.ModelForm):
    class Meta:
        model = Persona
        fields = ['id_materias_afines',

                  ]

        labels = {'id_materias_afines': '',

        }

class ExperienciaForm(ModelForm):
    class Meta:
        model = Persona
        fields = ['cargo',
                  'tipo_empleo',
                  'empresa',
                  'ubicacion',
                  'fecha_inicio',
                  'fecha_fin',

                  ]
        labels = {
            'cargo': 'Cargo',
            'tipo_empleo': 'Tipo de empleo',
            'empresa': 'Empresa',
            'ubicacion': 'Ubicacion',
            'fecha_inicio': 'Fecha Inicio',
            'fecha_fin': 'Fecha Fin',

        }
        widgets = {
            'cargo': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'tipo_empleo': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'empresa': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'ubicacion': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'fecha_inicio': forms.DateInput(attrs={"class": "form-control text-dark", "type": "date"}),
            'fecha_fin': forms.DateInput(attrs={"class": "form-control text-dark", "type": "date"}),

        }

class EducacionForm(forms.ModelForm):
    class Meta:
        model = Persona
        fields = ['universidad',
                  'titulacion',
                  'nota',
                  'fecha_inicio',
                  'fecha_fin',

                  ]
        labels = {
            'universidad': 'Universidad',
            'titulacion': 'Titulacion',
            'nota': 'Nota',
             'fecha_inicio': 'Fecha Inicio',
            'fecha_fin': 'Fecha Fin',
        }
        widgets = {
            'universidad': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'titulacion': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'nota': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'fecha_inicio': forms.DateInput(attrs={"class": "form-control text-dark", "type": "date"}),
            'fecha_fin': forms.DateInput(attrs={"class": "form-control text-dark", "type": "date"}),

        }


class CertificacionForm(forms.ModelForm):
    class Meta:
        model = Persona
        fields = ['nombre_certificado',
                  'institucion_emisora',
                  'fecha_inicio',
                  'fecha_fin',

                  ]
        labels = {
            'universidad': 'Universidad',
            'institucion_emisora': 'Titulacion',
            'fecha_inicio': 'Fecha Inicio',
            'fecha_fin': 'Fecha Fin',
        }
        widgets = {
            'nombre_certificado': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'institucion_emisora': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text"}),
            'fecha_inicio': forms.DateInput(attrs={"class": "form-control text-dark", "type": "date"}),
            'fecha_fin': forms.DateInput(attrs={"class": "form-control text-dark", "type": "date"}),

        }

class MateriaForm(forms.ModelForm):
    class Meta:
        model = Persona
        fields = ['id_materias_afines',

                  ]
        labels = {
            'id_materias_afines': '',


        }

class ValorForm(forms.ModelForm):
    class Meta:
        model = Persona
        fields = ['valor',

                  ]
        labels = {
            'valor': '$5',
        }
        widgets = {
            'valor': forms.CheckboxInput(),
        }
"""
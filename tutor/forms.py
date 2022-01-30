from .models import *
from django import forms
from django.forms import ModelForm
from betterforms.multiform import MultiModelForm

class TutorForm(forms.ModelForm):
    class Meta:
        model = Tutor
        fields = "__all__"

        labels = {
            'nombres': 'Nombres',
            'apellidos': 'Apellidos',
            'genero':'Genero',
            'pais':'Pais',
            'ciudad':'Ciudad',
            'sintesis_cv':'Descripcion profesional',
            'curriculum':'Hoja de vida'
            'tipo_empleo':'Tipo de empleo( completo/medio tiempo )',
            'id_materias_afines': 'Materias Afines',
        }

        widgets = {
            'nombres': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text", "placeholder": "Ingrese Sus Nombres"}),
            'apellidos': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text", "placeholder": "Ingrese Sus Apellidos"}),
            'correo': forms.TextInput(attrs={"class": "form-control text-dark", "type": "email", "placeholder": "Ingrese Su Email"}),
            "clave": forms.TextInput(attrs={"class": "form-control", "type": "password", "placeholder": "Ingrese Su Contraseña"})
        }



class HorarioForm(forms.ModelForm):
    class Meta:
        model = Horarios_tutor
        fields = "__all__"
        labels = {
            'tutor': 'Tutor',
            'nombre_horario': 'Horario descripcion',
            'dias':'Horario | Días',
            'horario_inicio':'Hora de inicio',
            'hora_fin':'Hora fin'
            }

        widgets = {
            'nombres': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text", "placeholder": "Ingrese Sus Nombres"}),
            'apellidos': forms.TextInput(attrs={"class": "form-control text-dark", "type": "text", "placeholder": "Ingrese Sus Apellidos"}),
            'nombre_horario': forms.dA (attrs={"class": "form-control text-dark", "type": "email", "placeholder": "Ingrese Su Email"}),
            "hora_fin": forms.TextInput(attrs={"class": "form-control", "type": "password", "placeholder": "Ingrese Su Contraseña"})
       		'fecha_inicio': forms.DateInput(attrs={"class": "form-control text-dark", "type": "date"}),
        }

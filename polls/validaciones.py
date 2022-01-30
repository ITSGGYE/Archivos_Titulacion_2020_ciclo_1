from django.utils.translation import ugettext_lazy as _
from rest_framework.exceptions import *
from django.core.exceptions import ValidationError
"""
def validate_codigo(value):
    if value == "":
        raise ValidationError(
            _('{0} No se puede crear un modulo sin codigo. porfavor ingrese uno'.format(value)))
    return value

def longitudPassword(value):
    if len(value) < 8:
        raise ValidationError('La contraseña debe tener al menos 8 caracteres')
        return value
    elif len(value) > 15:
        raise ValidationError('La contraseña debe tener maximo 15 caracteres')
        return value

    else:
        return value

def minuscula(value):
    letras_minuscula = False
    for carac in value:
        if carac.islower() == True:
            letras_minuscula = True
    if not letras_minuscula:
        raise ValidationError('La contraseña debe tener al menos una minuscula')
        return value
    else:
        return value

def mayuscula(value):
    letras_mayuscula = False
    for carac in value:
        if carac.isupper() == True:
            letras_mayuscula = True
    if not letras_mayuscula:
        raise ValidationError('La contraseña debe tener al menos una mayuscula')
        return value
    else:
        return value

def numero(value):
    num = False
    for carac in value:
        if carac.isdigit() == True:
            num = True

    if not num:
        raise ValidationError('La contraseña debe tener numeros')
        return value
    else:
        return value

def espacios(value):
    if value.count(" ") > 0:
        raise ValidationError('La contraseña no puede contener espacios en blanco')
        return value
    else:
        return value

def alfanumericoPassword(value):
    if value.isalnum() == False:
        raise ValidationError('La contraseña puede contener solo letras y numeros')
        return value
    else:
        return value

def letraPassword(value):
    if value.isalpha() == True:
        raise ValidationError('La contraseña debe contener letras')
        return value
    else:
        return value


def numero(value):
    num = False
    for carac in value:
        if carac.isdigit() == True:
            num = True

    if not num:
        raise ValidationError('La contraseña debe tener numeros')
        return value
    else:
        return value

def letra(value):
    num = False
    for carac in value:
        if carac.isalpha() == True:
            num = True

    if not num:
        raise ValidationError('La contraseña debe tener letras')
        return value
    else:
        return value
"""
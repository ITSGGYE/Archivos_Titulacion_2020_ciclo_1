from django.shortcuts import render

# Create your views here.


def base(request):
	return render(request,'plantillas_correos/notificacion_seleccion_tutor.html')

def login(request):
	return render(request,'login.html')
import hashlib
from django.shortcuts import render, redirect
from django.http import HttpResponse, HttpResponseRedirect, request
from django.template import loader
from django.views.generic import *
from django.urls import reverse_lazy
from .forms import *
from django.urls import reverse

"""
#def index(request):
#    return HttpResponse

def index(request):
    latest_tutores = Persona.objects.order_by('-nombres')[:5]
    template = loader.get_template('polls/index.html')
    context = {
        'latest_tutores': latest_tutores,
    }
    return HttpResponse(template.render(context, request))

    #latest_tutores = Tutor.objects.order_by('-nombres')[:5]
    #output = ', '.join([q.apellidos for q in latest_tutores])
    #return HttpResponse(output)

def detail(request, question_id):
    return HttpResponse("You're looking at question %s." % question_id)


def results(request, question_id):
    response = "You're looking at the results of question %s."
    return HttpResponse(response % question_id)


def vote(request, question_id):
    return HttpResponse("You're voting on question %s." % question_id)

###########################3####### login y salir ################################################


def inicio(request):
    if 'usuario' in request.session:
        contexto = {}
        persona = Persona.objects.get(id_persona=request.session.get('correo'))
        rol = Rol.objects.get(id_rol=request.session.get('nombre'))
        usuario = Usuario.objects.get(id_usuario=request.session.get('usuario'))
        contexto['usuario'] = usuario
        contexto['rol'] = rol
        contexto['persona'] = persona
        return render(request, 'polls/perfiles/tutor/perfil_tutor.html', contexto)
    else:
        if 'usuario' in request.session:
            contexto = {}
            usuario = Usuario.objects.get(id_usuario=request.session.get('usuario'))
            contexto['usuario'] = usuario
            return render(request, 'polls/perfiles/estudiante/perfil_estudiante.html', contexto)
        return HttpResponseRedirect('../')

def login(request):
    contexto = {}
    try:
        if request.method == 'POST':
            var_usuario = request.POST.get('usu')
            var_contra = request.POST.get('pass')
            h = hashlib.new("sha1")
            var_contra = str.encode(var_contra)
            h.update(var_contra)
            print(h.hexdigest())
            usu = Usuario.objects.get(correo=var_usuario, clave=h.hexdigest())
            if usu:
                request.session['correo'] = usu.id_usuario
                return redirect("perfil_tutor")
            else:
                usu = Usuario.objects.get(correo=var_usuario, clave=h.hexdigest())
                if usu:
                    request.session['correo'] = usu.id_usuario
                    return redirect("perfil_tutor")

######ods y covid 19

    except Exception as usu:
        contexto['error'] = "Usuario o contraseña incorrectos"
        return render(request, 'polls/login.html', contexto)
    return render(request, 'polls/login.html', contexto)



def salir(request):
    del request.session['usuario']
    return HttpResponseRedirect('.../')


##################################### Usuario de TUTOR Y ESTUDIANTES ###########################

class UsuarioEstudiante(CreateView):
    model = Usuario
    form_class = UsuarioForm
    template_name = 'polls/usuario/usuario_estudiante.html'
    success_url = reverse_lazy('login')

    def post(self, request, *args, **kargs):
        self.object = self.get_object
        form = self.form_class(request.POST)
        if form.is_valid():
            usuario = form.save(commit=False)
            var_contra = usuario.clave
            h = hashlib.new("sha1")
            var_contra = str.encode(var_contra)
            h.update(var_contra)
            usuario.clave = h.hexdigest()
            usuario.save()
            return HttpResponseRedirect(self.get_success_url())
        else:
            return self.render_to_response(self.get_context_data(form=form))


class UsuarioTutor(CreateView):
    model = Usuario
    form_class = UsuarioForm
    template_name = 'polls/usuario/usuario_tutor.html'
    success_url = reverse_lazy('login')

    def get_context_data(self, **kwargs):
        context = super(UsuarioTutor, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context

    def post(self, request, *args, **kargs):
        self.object = self.get_object
        form = self.form_class(request.POST)
        if form.is_valid():
            usuario = form.save(commit=False)
            var_contra = usuario.clave
            h = hashlib.new("sha1")
            var_contra = str.encode(var_contra)
            h.update(var_contra)
            usuario.clave = h.hexdigest()
            usuario.save()
            return HttpResponseRedirect(self.get_success_url())
        else:
            return self.render_to_response(self.get_context_data(form=form))


############################################## Perfiles #################################################


######################################### estudiantes ########################

class ListarEstudiante(ListView):
    model = Persona
    template_name = 'polls/perfiles/estudiante/perfil_estudiante.html'
    context_object_name = 'estudiante'

    def get_context_data(self, **kwargs):
        context = super(ListarEstudiante, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context

class CrearNiveles(CreateView):
    model = Persona
    form_class = CrearNivelesForm
    template_name = 'polls/perfiles/estudiante/crear_niveles.html'
    success_url = reverse_lazy('perfil_estudiante')

class EditarNiveles(UpdateView):
    model = Persona
    form_class = CrearNivelesForm
    template_name = 'polls/perfiles/estudiante/editar_niveles.html'
    success_url = reverse_lazy('perfil_estudiante')
    context_object_name = 'editar_estudiante'

class CrearIntereses(CreateView):
    model = Persona
    form_class = CrearInteresesForm
    template_name = 'polls/perfiles/estudiante/crear_intereses.html'
    success_url = reverse_lazy('perfil_estudiante')

    def get_context_data(self, **kwargs):
        context = super(CrearIntereses, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context

class EditarIntereses(UpdateView):
    model = Persona
    form_class = CrearInteresesForm
    template_name = 'polls/perfiles/estudiante/editar_intereses.html'
    success_url = reverse_lazy('perfil_estudiante')
    context_object_name = 'editar_intereses'

    def get_context_data(self, **kwargs):
        context = super(EditarIntereses, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context
####################################Tutor###########################################
class ListarTutor(ListView):
    model = Persona
    template_name = 'polls/perfiles/tutor/perfil_tutor.html'
    context_object_name = 'tutor'

    def get_context_data(self, **kwargs):
        context = super(ListarTutor, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context

class CrearExperiencia(CreateView):
    model = Persona
    form_class = ExperienciaForm
    template_name = 'polls/perfiles/tutor/crear_experiencia.html'
    success_url = reverse_lazy('perfil_tutor')

class EditarExperiencia(UpdateView):
    model = Persona
    form_class = ExperienciaForm
    template_name = 'polls/perfiles/tutor/editar_experiencia.html'
    success_url = reverse_lazy('perfil_tutor')
    context_object_name = 'editar_experiencia'

class CrearEducacion(CreateView):
    model = Persona
    form_class = EducacionForm
    template_name = 'polls/perfiles/tutor/crear_educacion.html'
    success_url = reverse_lazy('perfil_tutor')

class EditarEducacion(UpdateView):
    model = Persona
    form_class = EducacionForm
    template_name = 'polls/perfiles/tutor/editar_educacion.html'
    success_url = reverse_lazy('perfil_tutor')
    context_object_name = 'editar_educacion'

class CrearCertificacion(CreateView):
    model = Persona
    form_class = CertificacionForm
    template_name = 'polls/perfiles/tutor/crear_certificacion.html'
    success_url = reverse_lazy('perfil_tutor')

class EditarCertificacion(UpdateView):
    model = Persona
    form_class = CertificacionForm
    template_name = 'polls/perfiles/tutor/editar_certificacion.html'
    success_url = reverse_lazy('perfil_tutor')
    context_object_name = 'editar_certificacion'

class CrearMateria(CreateView):
    model = Persona
    form_class = MateriaForm
    template_name = 'polls/perfiles/tutor/crear_materia.html'
    success_url = reverse_lazy('perfil_tutor')

    def get_context_data(self, **kwargs):
        context = super(CrearMateria, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context

class EditarMateria(UpdateView):
    model = Persona
    form_class = MateriaForm
    template_name = 'polls/perfiles/tutor/editar_materia.html'
    success_url = reverse_lazy('perfil_tutor')
    context_object_name = 'editar_certificacion'

    def get_context_data(self, **kwargs):
        context = super(EditarMateria, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context

class CrearValor(CreateView):
    model = Persona
    form_class = ValorForm
    template_name = 'polls/perfiles/tutor/crear_valor.html'
    success_url = reverse_lazy('perfil_tutor')

class EditarValor(UpdateView):
    model = Persona
    form_class = ValorForm
    template_name = 'polls/perfiles/tutor/editar_valor.html'
    success_url = reverse_lazy('perfil_tutor')
    context_object_name = 'editar_valor'



####################################### agregar contenido al perfilEstudiantes ###########################################

class BusquedaTutor(ListView):
    model = Persona
    template_name = 'polls/perfiles/estudiante/buscar_tutor.html'

    def get_context_data(self, **kwargs):
        context = super(BusquedaTutor, self).get_context_data(**kwargs)
        context['matematica'] = MateriasAfines.objects.filter(tipo='matematica')
        context['ciencia'] = MateriasAfines.objects.filter(tipo='ciencia')
        context['economia'] = MateriasAfines.objects.filter(tipo='economia')
        context['computacion'] = MateriasAfines.objects.filter(tipo='computacion')
        return context

class HorariosTutor(TemplateView):
    model = Persona
    template_name = 'polls/perfiles/tutor/horarios_tutor.html'
    success_url = reverse_lazy('perfil_tutor')


"""
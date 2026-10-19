@auth
    <a class="service-action" href="{{ route('citas.create') }}"><i class="bi bi-arrow-right m-2"></i>Agendar ahora</a>
@else
    <a class="service-action" href="{{ route('register') }}"><i class="bi bi-arrow-right m-2"></i>Regístrate para agendar</a>
@endauth
 
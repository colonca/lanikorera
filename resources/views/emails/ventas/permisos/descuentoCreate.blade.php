@component('mail::message')
#Verificación

El usuario {{$user->nombres}} esta intentando realizar un descuento, por la seguridad de tu negocio hemos
decidido realizar un proceso de verificación. Adjunto a este correo tendra los detalles de esta operación.

para aprobar esta transacción debe proveer el siguiente codigo de verificación.

@component('mail::button', ['url' => ''])
{{$code}}
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Bienvenue {{ $user->name }}

Merci de vous être enregistré avec l'adresse {{ $user->email }}
@endcomponent

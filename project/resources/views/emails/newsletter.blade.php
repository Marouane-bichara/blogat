@component('mail::message')
# 📢 Annonce

{!! nl2br(e($content)) !!}

Merci,<br>
L’équipe Blogat
@endcomponent

<div>
    <p>
        Olá <strong>{{$user->name}}</strong>,
        Sua inscrição no evento <strong>{{$event->title}}</strong> foi realizada com sucesso.
        <br>
        Obrigado por sua inscrição!
    </p>
    <hr>
    E-mail enviado em {{date('d/m/Y H:i:s')}} por Events Sistema. <br>
    Não responda a este email.
</div>
@extends('mails.layouts.default')
@section('content')
    <p>Olá {{ $user->first_name }},</p>
    <p>Seja bem-vindo ao {{ config('app.name') }}.</p>
    <p>Por favor, clique no botão abaixo para resetar sua senha.</p>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
        <tbody>
        <tr>
            <td align="left">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td> <a href="{{ config('app.portal_url') }}/resetar-senha?token={{ $token }}" target="_blank">Resetar senha</a> </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@endsection

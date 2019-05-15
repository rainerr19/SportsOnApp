@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica tu Email</div>

                <div class="card-body">
                    {{-- @if (session('in'))
                        <div class="alert alert-success" role="alert">
                            Un link de verificación se ha enviado a tu correo.
                        </div>
                    @endif --}}

                    Antes de continuar, revisa tu Email para poder verificarlo.
                    {{-- {{ route('resendVerify') }} --}}
                    Si no resibiste el Email, has <a href="{{ route('resendVerify') }}">click aqui</a> para enviar otro mensaje.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
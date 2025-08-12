@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Perfil de usuario</h1>
@stop

@section('css')
    @vite(['resources/css/app.css'])
@stop

@section('js')
    @vite(['resources/js/app.js'])
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            <div class="mb-4">
                                @livewire('profile.update-profile-information-form')
                            </div>
                            <hr>
                        @endif

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-4 mb-4">
                                @livewire('profile.update-password-form')
                            </div>
                            <hr>
                        @endif


                        <div class="mt-4">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection